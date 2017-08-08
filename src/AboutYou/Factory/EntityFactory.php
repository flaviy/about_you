<?php

namespace AboutYou\Factory;

use AboutYou\Entity\AbstractEntity;

/**
 * Class EntityFactory
 * @package AboutYou\Factory
 */
class EntityFactory
{

    /** @var  EntityDataModifierFactory $entityDataModifierFactory */
    protected $entityDataModifierFactory;

    /** @var  EntityValidatorFactory $entityValidatorFactory */
    protected $entityValidatorFactory;

    /**
     * EntityFactory constructor.
     * @param EntityDataModifierFactory $entityDataModifierFactory
     * @param EntityValidatorFactory $entityValidatorFactory
     */
    public function __construct(
        EntityDataModifierFactory $entityDataModifierFactory,
        EntityValidatorFactory $entityValidatorFactory
    )
    {
        $this->entityDataModifierFactory = $entityDataModifierFactory;
        $this->entityValidatorFactory = $entityValidatorFactory;
    }

    /**
     * @param $entityClass
     * @param $data
     * @param null $parentEntity
     * @return AbstractEntity
     * @throws \Exception
     */
    public function create($entityClass, $data, $parentEntity = null)
    {
        /** @var AbstractEntity $entity */
        $entity = new $entityClass;
        $dataModifier = $this->entityDataModifierFactory->create($entity);
        if ($dataModifier !== null) {
            $data = $dataModifier->modify($data);
        }
        $reflect = new \ReflectionClass($entity);
        $props = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            if (isset($data->{$prop->getName()})) {
                $entity->{$prop->getName()} = $data->{$prop->getName()};
            }
        }
        if(!empty($entity->getRelations())){
            $this->handleRelations($entity, $data, $parentEntity);
        }
        $validator = $this->entityValidatorFactory->create($entity);
        if($validator!== null && !$validator->validate($entity)){
            throw new \Exception('Invalid row data for entity '.$entityClass);
        }
        return $entity;
    }

    /**
     * @param AbstractEntity $entity
     * @param $data
     * @param AbstractEntity|null $parentEntity
     */
    protected function handleRelations(AbstractEntity $entity, $data, AbstractEntity $parentEntity = null){
        $relations = $entity->getRelations();
        foreach ($relations as $type => $items) {
            switch ($type) {
                case "hasMany" :
                    $this->handleHasMany($entity, $items, $data);
                    break;
                case "belongsTo" :
                    if($parentEntity !== null) {
                        $this->handleBelongsTo($entity, $parentEntity, $items);
                    }
                    break;
                case "hasOne" :
                    $this->handleHasOne($entity, $items, $data);
                    break;
            }
        }
    }

    /**
     * @param $entity
     * @param $hasManyRelations
     * @param $data
     */
    protected function handleHasMany(AbstractEntity $entity, $hasManyRelations, $data)
    {
        foreach ($hasManyRelations as $hasMany) {
            if (!empty($hasMany['class']) && !empty($hasMany['propertyName']) && !empty($data->{$hasMany['propertyName']})) {
                $entity->{$hasMany['propertyName']} = [];
                foreach ($data->{$hasMany['propertyName']} as $dataItem) {
                    $entity->{$hasMany['propertyName']}[] = $this->create($hasMany['class'], $dataItem, $entity);
                }
            }
        }
    }

    /**
     * @param AbstractEntity $entity
     * @param $hasOneRelations
     * @param $data
     */
    protected function handleHasOne(AbstractEntity $entity, $hasOneRelations, $data)
    {
        foreach ($hasOneRelations as $hasOne) {
            if (!empty($hasOne['class']) && !empty($hasOne['propertyName']) && !empty($data->{$hasOne['propertyName']})) {
                $entity->{$hasOne['propertyName']} = $this->create($hasOne['class'], $data->{$hasOne['propertyName']}, $entity);
            }
        }
    }

    /**
     * @param AbstractEntity $entity
     * @param AbstractEntity $parentEntity
     * @param $belongsTo
     */
    protected function handleBelongsTo(AbstractEntity $entity, AbstractEntity $parentEntity, $belongsTo)
    {
        if (!empty($belongsTo['class']) && !empty($belongsTo['propertyName'])) {
            if ($belongsTo['class'] == get_class($parentEntity)) {
                $entity->{$belongsTo['propertyName']} = $parentEntity;
            }
        }
    }
}
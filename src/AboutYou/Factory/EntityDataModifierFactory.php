<?php

namespace AboutYou\Factory;

use AboutYou\Entity\AbstractEntity;
use AboutYou\Helper\RowDataModifierInterface;

/**
 * Class EntityDataModifierFactory
 * @package AboutYou\Factory
 */
class EntityDataModifierFactory
{
    /**
     * @param AbstractEntity $entity
     * @return RowDataModifierInterface|null
     */
    public function create(AbstractEntity $entity)
    {
        if ($entity->getRowDataModifier() !== null && class_exists($entity->getRowDataModifier())) {
            $modifierClassName = $entity->getRowDataModifier();
            /** @var RowDataModifierInterface $modifier */
            $modifier = new $modifierClassName;
            return $modifier;
        }
        return null;
    }
}
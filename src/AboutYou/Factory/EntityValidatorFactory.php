<?php

namespace AboutYou\Factory;

use AboutYou\Entity\AbstractEntity;
use AboutYou\Entity\Validators\EntityValidatorInterface;

/**
 * Class EntityValidatorFactory
 * @package AboutYou\Factory
 */
class EntityValidatorFactory
{
    /**
     * @param AbstractEntity $entity
     * @return EntityValidatorInterface|null
     */
    public function create(AbstractEntity $entity)
    {
        if ($entity->getValidator() !== null && class_exists($entity->getValidator())) {
            $validatorClassName = $entity->getValidator();
            /** @var EntityValidatorInterface $validator */
            $validator = new $validatorClassName;
            return $validator;
        }
        return null;
    }
}
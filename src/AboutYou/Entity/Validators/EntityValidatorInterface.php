<?php
namespace AboutYou\Entity\Validators;

interface EntityValidatorInterface
{
    /**
     * @param \AboutYou\Entity\AbstractEntity $entity
     * @return boolean
     */
    public function validate(\AboutYou\Entity\AbstractEntity $entity);
}
<?php

namespace AboutYou\Entity\Validators;

/**
 * Class VariantEntityValidator
 * @package AboutYou\Entity\Validators
 */
class VariantEntityValidator implements EntityValidatorInterface {

    public $rules = [
        'id' => 'isInteger',
        'isDefault' => 'boolean',
        'isAvailable' => 'boolean',
        'quantity' => 'isInteger',
        'size' => 'notBlank',
        'price' => ['isInstanceOf', \AboutYou\Entity\Price::class],
        'product' => ['isInstanceOf', \AboutYou\Entity\Product::class]
    ];

    /**
     * @param \AboutYou\Entity\AbstractEntity $entity
     * @return bool
     */
    public function validate(\AboutYou\Entity\AbstractEntity $entity)
    {
        foreach ($this->rules as $field => $rule) {
            if(!isset($entity->$field)){
                return false;
            }
            if(is_string($rule)){
                $valid = ValidationRules::$rule($entity->$field);
            } else {
                $ruleName = $rule[0];
                $valid = ValidationRules::$ruleName($entity->$field, $rule[1]);
            }
            if(!$valid){
                return false;
            }
        }
        return true;
    }
}

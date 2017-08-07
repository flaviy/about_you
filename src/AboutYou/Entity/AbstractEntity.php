<?php

namespace AboutYou\Entity;

use AboutYou\Entity\Validators\EntityValidatorInterface;
use AboutYou\Helper\RowDataModifierInterface;

/**
 * Class AbstractEntity
 * @package AboutYou\Entity
 */
abstract class AbstractEntity
{

    /** @var EntityValidatorInterface | null $validator  */
    protected $validator;

    /** @var RowDataModifierInterface | null $rowDataModifier */
    protected $rowDataModifier;

    /**
     * @return RowDataModifierInterface | null
     */
    public function getRowDataModifier()
    {
        return $this->rowDataModifier;
    }

    /**
     * @return array
     */
    public function getRelations()
    {
        if(isset($this->relations)){
            return $this->relations;
        }
        return [];
    }

    /**
     * @return EntityValidatorInterface|null
     */
    public function getValidator()
    {
        return $this->validator;
    }
}
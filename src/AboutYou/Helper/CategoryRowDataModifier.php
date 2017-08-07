<?php

namespace AboutYou\Helper;
/**
 * Class CategoryRowDataModifier
 * @package AboutYou\Helper
 */
class CategoryRowDataModifier implements RowDataModifierInterface
{
    public function modify($data)
    {
        if(!empty($data->products)){
            foreach ($data->products as $id => &$product){
                $product->id = (int)$id;
            }
        }
        return $data;
    }
}
<?php

namespace AboutYou\Helper;
/**
 * Class CategoryRowDataModifier
 * @package AboutYou\Helper
 */
class CategoryRowDataModifier implements RowDataModifierInterface
{
    /**Modify entity row data
     * @param $data
     * @return mixed
     */
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
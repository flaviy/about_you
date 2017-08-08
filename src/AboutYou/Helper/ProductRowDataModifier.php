<?php

namespace AboutYou\Helper;
/**
 * Class ProductRowDataModifier
 * @package AboutYou\Helper
 */
class ProductRowDataModifier implements RowDataModifierInterface
{
    /**Modify entity row data
     * @param $data
     * @return mixed
     */
    public function modify($data)
    {
        if(!empty($data->variants)){
            foreach ($data->variants as $id => &$variant){
                $variant->id = (int)$id;
            }
        }
        return $data;
    }
}
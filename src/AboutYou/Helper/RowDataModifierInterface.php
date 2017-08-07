<?php

namespace AboutYou\Helper;
/**
 * Interface RowDataModifierInterface
 * @package AboutYou\Helper
 */
interface RowDataModifierInterface
{
    /**
     * @param $data
     * @return mixed
     */
    public function modify($data);
}

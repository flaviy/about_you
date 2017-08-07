<?php

namespace AboutYou\DataSource;
/**
 * Interface DataSourceInterface
 * @package AboutYou\DataSource
 */
interface DataSourceInterface
{
    /**
     * @param string $source
     * @return mixed
     */
    public function read($source);
}
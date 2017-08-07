<?php

namespace  AboutYou\DataSource;

/**
 * Class Json
 * @package AboutYou\DataSource
 */
class Json implements DataSourceInterface
{
    public function read($source)
    {
        if(!is_readable($source)){
            throw new \Exception('Source file not found');
        }
        $data = file_get_contents($source);
        if($data){
            return json_decode($data);
        }
        return [];
    }
}
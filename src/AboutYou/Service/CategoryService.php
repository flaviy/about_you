<?php

namespace AboutYou\Service;

use AboutYou\Factory\EntityFactory;
use AboutYou\Utilities\Logger;

class CategoryService implements CategoryServiceInterface
{

    const SOURCE_FILE_ADDR = 'data'.DIRECTORY_SEPARATOR.'17325.json';

    /** @var \AboutYou\DataSource\DataSourceInterface $dataSource */
    protected $dataSource;

    /** @var  Logger $logger */
    protected $logger;

    /** @var  EntityFactory $entityFactory */
    protected $entityFactory;

    public function __construct(
        \AboutYou\DataSource\DataSourceInterface $dataSource,
        \AboutYou\Utilities\Logger $logger,
        \AboutYou\Factory\EntityFactory $entityFactory
    )
    {
        $this->dataSource = $dataSource;
        $this->logger = $logger;
        $this->entityFactory = $entityFactory;
    }

    /**
     * @param int $categoryId
     * @return null
     */
    public function getCategory($categoryId)
    {
        $entity = null;
        try {
            $data =  $this->dataSource->read(self::SOURCE_FILE_ADDR);
            if(isset($data->id) && $data->id == $categoryId) {
                $entity = $this->entityFactory->create(
                    \AboutYou\Entity\Category::class,
                    $data
                );
            }

        } catch (\Exception $ex) {
            $this->logger->log($ex->getTraceAsString());
        }
        return $entity;
    }
}
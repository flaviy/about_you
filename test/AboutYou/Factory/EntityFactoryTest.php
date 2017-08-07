<?php

namespace Tests\AboutYou\Factory;

use AboutYou\Factory\EntityFactory;
use AboutYou\Helper\RowDataModifierInterface;

class EntityFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject $entityDataModifierFactory   */
    protected $entityDataModifierFactory;

    /** @var  \PHPUnit_Framework_MockObject_MockObject $entityValidatorFactory */
    protected $entityValidatorFactory;

    /** @var  \PHPUnit_Framework_MockObject_MockObject $entityValidatorFactory */
    protected $dataModifier;

    /** @var  \PHPUnit_Framework_MockObject_MockObject $entityValidatorFactory */
    protected $entity;

    /** @var  EntityFactory $entityFactory */
    protected $entityFactory;

    protected function setUp()
    {
        $this->entityDataModifierFactory = $this->getMockBuilder(\AboutYou\Factory\EntityDataModifierFactory::class)
            ->setMethods(['create'])
            ->getMock();
        $this->entityValidatorFactory = $this->getMock(\AboutYou\Factory\EntityValidatorFactory::class);
        $this->dataModifier = $this->getMockForAbstractClass(RowDataModifierInterface::class);
        $this->entity = $this->getMockForAbstractClass(\AboutYou\Entity\AbstractEntity::class);
        $this->entityFactory = new EntityFactory(
            $this->entityDataModifierFactory,
            $this->entityValidatorFactory
        );
        parent::setUp();
    }

    public function testCreateEmptyModifierEmptyRelations()
    {

        $path =  dirname(dirname(dirname(__DIR__))).DIRECTORY_SEPARATOR.\AboutYou\Service\CategoryService::SOURCE_FILE_ADDR;
        $data = (new \AboutYou\DataSource\Json)->read($path);
        $this->entityDataModifierFactory
            ->expects($this->once())
            ->method('create')
            ->with($this->entity)
            ->willReturn(null);
        $this->dataModifier
            ->expects($this->never())
            ->method('modify');

        $this->entity
            ->expects($this->once())
            ->method('getRelations')
            ->willReturn([]);

        $this->entityFactory->create(get_class($this->entity), $data);
    }

}
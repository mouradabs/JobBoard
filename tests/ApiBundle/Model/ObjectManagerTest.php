<?php
namespace ApiBundle\Tests\Model;

use ApiBundle\Model\ObjectManager;

class ObjectManagerTest extends BaseTest
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    protected function setUp()
    {
        parent::setUp();

        $this->objectManager = new ObjectManager();
    }

    /**
     * @dataProvider providerCreate
     *
     * @param array $arguments
     */
    public function testCreate(array $arguments)
    {
        $className = '\DateTime';

        $actual = $this->objectManager->create($className, $arguments);
        
        $this->assertInstanceOf($className, $actual);
    }

    /**
     * @expectedException \ApiBundle\Model\Exception\RuntimeException
     */
    public function testFailCreate()
    {
        $this->objectManager->create('ApiBundle\Model\ObjectManager', [1, 2]);
    }

    /**
     * @dataProvider providerNoExistCreate
     *
     * @expectedException \ApiBundle\Model\Exception\RuntimeException
     *
     * @param string
     */
    public function testNoExistCreate($className)
    {
        $this->objectManager->create($className);
    }

    public function providerNoExistCreate()
    {
        return [
            ['Test'],
            ['']
        ];
    }

    public function providerCreate()
    {
        return [
            [['now']],
            [[]]
        ];
    }
}

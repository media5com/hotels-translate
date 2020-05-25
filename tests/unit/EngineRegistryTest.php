<?php namespace App\Tests;

use App\Domain\Model\Engine\EngineRegistry;
use App\Tests\Helper\FakeEngine;
use InvalidArgumentException;

class EngineRegistryTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testAddAndListEngines()
    {
        $registry = new EngineRegistry();
        $list = $registry->list();
    
        $this->assertIsArray($list);
        $this->assertEmpty($list);
        
        $registry->add(new FakeEngine());
        $list = $registry->list();
    
        $this->assertIsArray($list);
        $this->assertCount(1, $list);
        
        $registry->add(new FakeEngine());
        $list = $registry->list();
    
        $this->assertIsArray($list);
        $this->assertCount(1, $list);
    }
    
    public function testGetById()
    {
        $registry = new EngineRegistry();
    
        $this->expectException(InvalidArgumentException::class);
        $registry->getById('WrongEngineId');
    
        $registry->add(new FakeEngine());
        $engine = $registry->getById(FakeEngine::id());
        
        $this->assertInstanceOf(FakeEngine::class, $engine);
    }
}
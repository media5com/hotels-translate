<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Tests\api;


use App\Domain\Model\Engine\EngineRegistry;
use App\Tests\Helper\FakeEngine;

final class TestEngineRegistryFactory
{
    public static function createEngineRegistry(): EngineRegistry
    {
        $registry = new EngineRegistry();
        $registry->add(new FakeEngine());
        
        return $registry;
    }
}
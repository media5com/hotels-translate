<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Application;


use App\Domain\Model\Engine\EngineRegistry;

final class EngineRegistryFactory
{
    public static function createEngineRegistry(): EngineRegistry
    {
        $registry = new EngineRegistry();
        $registry->add(new GoogleEngine());
        
        return $registry;
    }
}
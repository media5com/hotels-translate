<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Domain\Model\Engine;


final class EngineRegistry implements EngineRegistryInterface
{
    private $engines = [];
    
    public function list(): array
    {
        return $this->engines;
    }
    
    public function add(EngineInterface $engine)
    {
        $this->engines[$engine->id()] = $engine;
    }
    
    public function getById($engineId): EngineInterface
    {
        if (!isset($this->engines[$engineId])) {
            throw new \InvalidArgumentException('Wrong engine id');
        }
        
        return $this->engines[$engineId];
    }
}
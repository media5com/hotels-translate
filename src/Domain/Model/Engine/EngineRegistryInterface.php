<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Domain\Model\Engine;


interface EngineRegistryInterface
{
    public function list(): array;
    
    public function getById($engineId): EngineInterface;
}
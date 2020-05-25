<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Controller;


use App\Domain\Model\Engine\EngineInterface;
use App\Domain\Model\Engine\EngineRegistryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

final class EngineController
{
    private $engineRegistry;
    
    /**
     * EngineController constructor.
     *
     * @param $engineRegistry
     */
    public function __construct(EngineRegistryInterface $engineRegistry)
    {
        $this->engineRegistry = $engineRegistry;
    }
    
    public function list()
    {
        $data = [];
        /** @var EngineInterface $engine */
        foreach ($this->engineRegistry->list() as $engine) {
            $data[$engine::id()] = $engine::description();
        }
        
        return new JsonResponse($data);
    }
}
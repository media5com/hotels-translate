<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Controller;


use App\Domain\Model\Engine\EngineRegistryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class TranslatorController
{
    /**
     * @var EngineRegistryInterface
     */
    private $engineRegistry;
    /**
     * @var string
     */
    private $targetLanguage;
    
    /**
     * TranslatorController constructor.
     *
     * @param EngineRegistryInterface $engineRegistry
     * @param string                  $targetLanguage
     */
    public function __construct(EngineRegistryInterface $engineRegistry, string $targetLanguage)
    {
        $this->engineRegistry = $engineRegistry;
        $this->targetLanguage = $targetLanguage;
    }
    
    public function translate(Request $request)
    {
        if (!$request->request->has('engine') || empty($request->request->get('engine'))) {
            return new Response(null, Response::HTTP_BAD_REQUEST);
        }
        
        if (!$request->request->has('content') || empty($request->request->get('content'))) {
            return new Response(null, Response::HTTP_BAD_REQUEST);
        }
        
        $engineId = $request->request->get('engine');
        try {
            $engine = $this->engineRegistry->getById($engineId);
        } catch (\InvalidArgumentException $exception) {
            return new Response(null, Response::HTTP_BAD_REQUEST);
        }
        
        $content        = $request->request->get('content');
        $targetLanguage = $request->request->get('target_language', $this->targetLanguage);
        $translation    = $engine->translate($content, $targetLanguage);
        $data           = ['translation' => $translation];
        
        return new JsonResponse($data);
    }
}
<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Domain\Model\Engine;


interface EngineInterface
{
    public static function id(): string;
    public static function description(): string;
    public function translate(string $content, string $targetLanguage): string;
}
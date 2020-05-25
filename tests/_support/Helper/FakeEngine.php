<?php
declare(strict_types=1);
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Tests\Helper;


use App\Domain\Model\Engine\EngineInterface;

final class FakeEngine implements EngineInterface
{
    public static function id(): string
    {
        return 'FakeEngine';
    }
    
    public static function description(): string
    {
        return 'Fake engine';
    }
    
    public function translate(string $content, string $targetLanguage): string
    {
        return 'тест';
    }
}
<?php
/**
 * translate
 *
 * Copyright (c) 2020 Vasily Stashko
 */

namespace App\Tests;

use App\Application\GoogleEngine;
use Google\Cloud\Translate\V3\TranslationServiceClient;

class GoogleEngineTest extends \Codeception\Test\Unit
{
    
    public function testTranslate()
    {
        $this->markTestIncomplete('Этот тест ещё не реализован.');
        $engine    = new GoogleEngine(new TranslationServiceClient([
            'credentials' => '/Users/bassta/PhpstormProjects/media5/translate/translate-api-268508-a565feda538d.json'
        ]), 'translate-api-268508');
        $translate = $engine->translate('test', 'ru');
        
        $this->assertNotEmpty($translate);
    }
}

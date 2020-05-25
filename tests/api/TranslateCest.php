<?php namespace App\Tests;

use App\Tests\Helper\FakeEngine;

class TranslateCest
{
    public function _before(ApiTester $I)
    {
    }
    
    // tests
    public function tryToTranslateWithEmptyFields(ApiTester $I)
    {
        $I->sendPost('/translate', []);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        
        $I->sendPost('/translate', [
            'engine'          => '',
            'content'         => '',
            'target_language' => '',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        
        $I->sendPost('/translate', [
            'engine'          => '',
            'content'         => 'test',
            'target_language' => '',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
        
        $I->sendPost('/translate', [
            'engine'          => FakeEngine::id(),
            'content'         => '',
            'target_language' => '',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }
    
    public function tryToTranslateWithWrongFields(ApiTester $I)
    {
        $I->sendPost('/translate', [
            'engine'          => 'WrongEngineId',
            'content'         => 'test',
            'target_language' => '',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::BAD_REQUEST);
    }
    
    public function tryToTranslateWithDefaultLanguage(ApiTester $I)
    {
        $I->sendPost('/translate', [
            'engine'          => FakeEngine::id(),
            'content'         => 'test',
            'target_language' => '',
        ]);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$.translation');
        $I->seeResponseMatchesJsonType([
            'translation' => 'string',
        ]);
        list($translation) = $I->grabDataFromResponseByJsonPath('$.translation');
        $I->assertNotEmpty($translation);
    }
}

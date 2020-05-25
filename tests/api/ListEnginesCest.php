<?php namespace App\Tests;
use App\Tests\ApiTester;

class ListEnginesCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function listEngines(ApiTester $I)
    {
        $I->sendGet('/engines');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
        $I->seeResponseIsJson();
    }
}

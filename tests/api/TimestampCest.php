<?php

namespace App\Tests;

class TimestampCest
{
    public function _before(ApiTester $I)
    {
    }

    // tests
    public function tryToTest(ApiTester $I)
    {
    }

    public function startPageDisplayed(ApiTester $I)
    {
        $I->haveHttpHeader('Accept', 'application/json');
        $I->sendGET('/timestamps');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([]);
    }
}

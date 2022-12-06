<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class Test02_LoginCest
{
    public function loginTest(AcceptanceTester $I): void
    {
        $I->wantTo('login with existing user');

        $I->amOnPage('/dashboard');

        $I->seeCurrentUrlEquals('/login');

        $I->fillField('email', 'john.doe@gmail.com');
        $I->fillField('password', 'secret');

        $I->click('Log in');

        $I->seeCurrentUrlEquals('/dashboard');

        $I->see('John Doe');
        $I->see("You're logged in!");
    }
}

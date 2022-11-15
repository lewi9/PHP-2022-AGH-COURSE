<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test11_LoginNotExistingCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->recreateObjectTable();

        $I->wantTo('see error when user does not exists');


        $I->amOnPage("/auth/login");

        $I->seeInTitle("Login");
        $I->see("Login", "h2");

        $I->fillField("email", "foo@bar.com");
        $I->fillField("password", "foo");

        $I->click("Enter");

        $I->seeCurrentUrlEquals("/");
        $I->see("Email 'foo@bar.com' does not exist!", "li.error");

        /**
         * Important - this is an example of the user enumeration vulnerability!
         * It should not be possible to check whether user is registered using the login form.
         */
    }
}

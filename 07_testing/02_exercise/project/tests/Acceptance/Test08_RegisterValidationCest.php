<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test08_RegisterValidationCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->recreateObjectTable();

        $I->wantTo('validate data entered during registration');


        $I->amOnPage("/auth/register");

        $I->click("Create");

        $I->seeCurrentUrlEquals("/auth/register");

        $I->see("The id filed cannot be empty", "li.error");
        $I->see("The name filed cannot be empty", "li.error");
        $I->see("The surname filed cannot be empty", "li.error");
        $I->see("The email filed cannot be empty", "li.error");
        $I->see("The password filed cannot be empty", "li.error");
        $I->see("The password confirmation filed cannot be empty", "li.error");

        $I->amGoingTo("check validation error when password confirmation is invalid");

        $I->fillField("id", "1");
        $I->fillField("name", "Name");
        $I->fillField("surname", "Surname");
        $I->fillField("email", "foo@bar.com");
        $I->fillField("password", "vey_long_and_complex_password");
        $I->fillField("password_confirmation", "vey_long_and_complex_password_confirmation_with_error");

        $I->click("Create");
        $I->seeCurrentUrlEquals("/auth/register");

        $I->see("The password confirmation filed does not match the password field", "li.error");
    }
}

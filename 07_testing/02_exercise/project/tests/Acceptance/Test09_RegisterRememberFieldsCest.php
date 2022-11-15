<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test09_RegisterRememberFieldsCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->recreateObjectTable();

        $I->wantTo('remember data entered during registration when validation error is present');


        $I->amOnPage("/auth/register");


        $I->fillField("id", "1");
        $I->click("Create");
        $I->seeCurrentUrlEquals("/auth/register");

        $I->dontSee("The id filed cannot be empty", "li.error");
        $I->seeInField("id", "1");
        $I->see("The name filed cannot be empty", "li.error");
        $I->see("The surname filed cannot be empty", "li.error");
        $I->see("The email filed cannot be empty", "li.error");
        $I->see("The password filed cannot be empty", "li.error");
        $I->see("The password confirmation filed cannot be empty", "li.error");


        $I->fillField("name", "Name");
        $I->click("Create");
        $I->seeCurrentUrlEquals("/auth/register");

        $I->dontSee("The id filed cannot be empty", "li.error");
        $I->seeInField("id", "1");
        $I->dontSee("The name filed cannot be empty", "li.error");
        $I->seeInField("name", "Name");
        $I->see("The surname filed cannot be empty", "li.error");
        $I->see("The email filed cannot be empty", "li.error");
        $I->see("The password filed cannot be empty", "li.error");
        $I->see("The password confirmation filed cannot be empty", "li.error");


        $I->fillField("surname", "Surname");
        $I->click("Create");
        $I->seeCurrentUrlEquals("/auth/register");

        $I->dontSee("The id filed cannot be empty", "li.error");
        $I->seeInField("id", "1");
        $I->dontSee("The name filed cannot be empty", "li.error");
        $I->seeInField("name", "Name");
        $I->dontSee("The surname filed cannot be empty", "li.error");
        $I->seeInField("surname", "Surname");
        $I->see("The email filed cannot be empty", "li.error");
        $I->see("The password filed cannot be empty", "li.error");
        $I->see("The password confirmation filed cannot be empty", "li.error");


        $I->fillField("email", "foo@bar.com");
        $I->click("Create");
        $I->seeCurrentUrlEquals("/auth/register");

        $I->dontSee("The id filed cannot be empty", "li.error");
        $I->seeInField("id", "1");
        $I->dontSee("The name filed cannot be empty", "li.error");
        $I->seeInField("name", "Name");
        $I->dontSee("The surname filed cannot be empty", "li.error");
        $I->seeInField("surname", "Surname");
        $I->dontSee("The email filed cannot be empty", "li.error");
        $I->seeInField("email", "foo@bar.com");
        $I->see("The password filed cannot be empty", "li.error");
        $I->see("The password confirmation filed cannot be empty", "li.error");


        $I->expectTo("see that previously entered password and password confirmation are not remembered");

        $I->fillField("password", "password");
        $I->fillField("password_confirmation", "incorrect_password_confirmation");
        $I->click("Create");
        $I->seeCurrentUrlEquals("/auth/register");

        $I->dontSee("The id filed cannot be empty", "li.error");
        $I->seeInField("id", "1");
        $I->dontSee("The name filed cannot be empty", "li.error");
        $I->seeInField("name", "Name");
        $I->dontSee("The surname filed cannot be empty", "li.error");
        $I->seeInField("surname", "Surname");
        $I->dontSee("The email filed cannot be empty", "li.error");
        $I->seeInField("email", "foo@bar.com");
        $I->dontSee("The password filed cannot be empty", "li.error");
        $I->seeInField("password", "");
        $I->dontSee("The password confirmation filed cannot be empty", "li.error");
        $I->seeInField("password_confirmation", "");
        $I->see("The password confirmation filed does not match the password field", "li.error");


        $I->amGoingTo("refresh page and see that old values have disappeared");
        $I->amOnPage("/auth/register");

        $I->dontSee("The id filed cannot be empty", "li.error");
        $I->seeInField("id", "");
        $I->dontSee("The name filed cannot be empty", "li.error");
        $I->seeInField("name", "");
        $I->dontSee("The surname filed cannot be empty", "li.error");
        $I->seeInField("surname", "");
        $I->dontSee("The email filed cannot be empty", "li.error");
        $I->seeInField("email", "");
        $I->dontSee("The password filed cannot be empty", "li.error");
        $I->seeInField("password", "");
        $I->dontSee("The password confirmation filed cannot be empty", "li.error");
        $I->seeInField("password_confirmation", "");
        $I->dontSee("The password confirmation filed does not match the password field", "li.error");
    }
}

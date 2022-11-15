<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;
use Model\User;

class Test13_LoginNotConfirmedCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->recreateObjectTable();

        $I->wantTo('be remained about email confirmation when trying to login');

        $I->amOnPage("/auth/login");

        $I->seeInTitle("Login");
        $I->see("Login", "h2");

        $user = new User(1);

        $user->name = "Unconfirmed";
        $user->surname = "User";
        $user->email = "dummy@example.com";
        $user->password = password_hash("foo", PASSWORD_DEFAULT);
        $user->confirmed = false;
        $random = rand();
        $user->token = md5(uniqid("$random", true));

        $id = $I->haveInDatabase("objects", [
            "key" => $user->key(),
            "data" => serialize($user)
        ]);


        $I->fillField("email", $user->email);
        $I->fillField("password", "foo");

        $I->click("Enter");

        $I->seeCurrentUrlEquals("/auth/confirmation_notice");
        $I->seeInTitle("Confirmation notice");
        $I->see("Please confirm user registration...", "h2");
    }
}

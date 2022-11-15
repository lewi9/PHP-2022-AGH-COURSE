<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;
use Model\User;

class Test14_LoginLogoutSeeHiddenContentCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->recreateObjectTable();

        $I->wantTo('see hidden content after login');


        $user = new User(1);

        $user->name = "Dummy";
        $user->surname = "User";
        $user->email = "dummy@example.com";
        $user->password = password_hash("foo", PASSWORD_DEFAULT);
        $user->confirmed = true;
        $user->token = null;

        $id = $I->haveInDatabase("objects", [
            "key" => $user->key(),
            "data" => serialize($user)
        ]);


        $I->amOnPage("/");

        $I->seeLink("Login", "/auth/login");
        $I->seeLink("Register", "/auth/register");
        $I->dontSeeLink("Logout", "/auth/logout");

        $I->dontSee("Dummy User", "h3.user");


        $I->amOnPage("/auth/login");

        $I->seeInTitle("Login");
        $I->see("Login", "h2");


        $I->fillField("email", $user->email);
        $I->fillField("password", "foo");

        $I->click("Enter");

        $I->seeCurrentUrlEquals("/");
        $I->see("Welcome back " . $user->name . "!");


        $I->dontSeeLink("Login", "/auth/login");
        $I->dontSeeLink("Register", "/auth/register");
        $I->seeLink("Logout", "/auth/logout");

        $I->see("Dummy User", "h3.user");

        $I->click("Logout");

        $I->seeCurrentUrlEquals("/");
        $I->see("Logged out successfully!");

        $I->seeLink("Login", "/auth/login");
        $I->seeLink("Register", "/auth/register");
        $I->dontSeeLink("Logout", "/auth/logout");

        $I->dontSee("Dummy User", "h3.user");
    }
}

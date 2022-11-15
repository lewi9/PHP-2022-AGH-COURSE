<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test00_PrettyUrlCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->amOnPage("/");
        $I->seeCurrentUrlEquals("/");
        $I->seeInTitle("Homepage");
        $I->see("Welcome on homepage!");

        $I->click("Home");
        $I->seeCurrentUrlEquals("/home");
        $I->seeInTitle("Homepage");
        $I->see("Welcome on homepage!");

        $I->click("About");
        $I->seeCurrentUrlEquals("/about");
        $I->seeInTitle("About");
        $I->see("Pretty URL test application!");

        $I->click("Users");
        $I->seeCurrentUrlEquals("/users");
        $I->seeInTitle("Users");
        $I->see("John");
        $I->see("Peter");
        $I->see("Paul");

        $I->click("John");
        $I->seeCurrentUrlEquals("/users/1");
        $I->seeInTitle("John");
        $I->see("Name: John");
        $I->see("Surname: Doe");
        $I->see("Age: 21");

        $I->click("Users");
        $I->seeCurrentUrlEquals("/users");
        $I->seeInTitle("Users");

        $I->click("Peter");
        $I->seeCurrentUrlEquals("/users/2");
        $I->seeInTitle("Peter");
        $I->see("Name: Peter");
        $I->see("Surname: Bauer");
        $I->see("Age: 16");

        $I->click("Users");
        $I->seeCurrentUrlEquals("/users");
        $I->seeInTitle("Users");

        $I->click("Paul");
        $I->seeCurrentUrlEquals("/users/3");
        $I->seeInTitle("Paul");
        $I->see("Name: Paul");
        $I->see("Surname: Smith");
        $I->see("Age: 18");
    }
}

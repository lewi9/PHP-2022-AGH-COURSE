<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class HomepageCest
{
    public function tryToTest(AcceptanceTester $I)
    {
        $I->wantTo('see Laravel links on homepage');

        $I->amOnPage('/');

        $I->seeInTitle('Laravel');

        $I->seeLink("Documentation", "https://laravel.com/docs");
        $I->seeLink("Laracasts", "https://laracasts.com");
        $I->seeLink("Forge", "https://forge.laravel.com");

        $I->dontSeeInDatabase('users');
    }
}

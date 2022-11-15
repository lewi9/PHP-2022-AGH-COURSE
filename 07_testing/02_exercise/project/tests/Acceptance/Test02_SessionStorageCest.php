<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test02_SessionStorageCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->amOnPage("/demo/session");
        $I->seeCurrentUrlEquals("/demo/session");

        $I->seeElement("input[value=widget_button_1]");
        $I->seeElement("input[value=widget_button_2]");
        $I->seeElement("input[value=widget_button_3]");

        $I->seeLink("widget_link_1");
        $I->seeLink("widget_link_2");
        $I->seeLink("widget_link_3");
    }
}

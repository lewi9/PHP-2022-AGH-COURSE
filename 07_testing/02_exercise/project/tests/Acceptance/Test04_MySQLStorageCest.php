<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test04_MySQLStorageCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->executeInDatabase("DROP TABLE IF EXISTS objects");

        $I->amOnPage("/demo/mysql");
        $I->seeCurrentUrlEquals("/demo/mysql");

        $I->seeElement("input[value=widget_button_1]");
        $I->seeElement("input[value=widget_button_2]");
        $I->seeElement("input[value=widget_button_3]");

        $I->seeLink("widget_link_1");
        $I->seeLink("widget_link_2");
        $I->seeLink("widget_link_3");

        $I->seeNumRecords(6, "objects");

        $I->executeInDatabase("DELETE FROM objects");
        $I->dontSeeInDatabase("objects");

        $I->amOnPage("/demo/mysql");
        $I->seeCurrentUrlEquals("/demo/mysql");

        $I->seeElement("input[value=widget_button_1]");
        $I->seeElement("input[value=widget_button_2]");
        $I->seeElement("input[value=widget_button_3]");

        $I->seeLink("widget_link_1");
        $I->seeLink("widget_link_2");
        $I->seeLink("widget_link_3");

        $I->seeNumRecords(6, "objects");

        $serialized_button1 = $I->grabColumnFromDatabase("objects", "data", ["key" => "widget_button_1"])[0];
        $serialized_button2 = $I->grabColumnFromDatabase("objects", "data", ["key" => "widget_button_2"])[0];
        $serialized_button3 = $I->grabColumnFromDatabase("objects", "data", ["key" => "widget_button_3"])[0];

        $button1 = $I->castToWidgetButton(unserialize($serialized_button1));
        $button2 = $I->castToWidgetButton(unserialize($serialized_button2));
        $button3 = $I->castToWidgetButton(unserialize($serialized_button3));

        $I->assertEquals("widget_button_1", $button1->key());
        $I->assertEquals("widget_button_2", $button2->key());
        $I->assertEquals("widget_button_3", $button3->key());

        $serialized_link1 = $I->grabColumnFromDatabase("objects", "data", ["key" => "widget_link_1"])[0];
        $serialized_link2 = $I->grabColumnFromDatabase("objects", "data", ["key" => "widget_link_2"])[0];
        $serialized_link3 = $I->grabColumnFromDatabase("objects", "data", ["key" => "widget_link_3"])[0];

        $link1 = $I->castToWidgetLink(unserialize($serialized_link1));
        $link2 = $I->castToWidgetLink(unserialize($serialized_link2));
        $link3 = $I->castToWidgetLink(unserialize($serialized_link3));

        $I->assertEquals("widget_link_1", $link1->key());
        $I->assertEquals("widget_link_2", $link2->key());
        $I->assertEquals("widget_link_3", $link3->key());
    }
}

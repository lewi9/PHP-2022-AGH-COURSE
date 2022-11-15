<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test01_FileStorageCest
{
    public function test(AcceptanceTester $I): void
    {
        $projectStorage = "../project/storage/FileStorage";

        $I->cleanDir("$projectStorage");

        $I->dontSeeFileFound("widget_button_1", $projectStorage);
        $I->dontSeeFileFound("widget_button_2", $projectStorage);
        $I->dontSeeFileFound("widget_button_3", $projectStorage);

        $I->dontSeeFileFound("widget_link_1", $projectStorage);
        $I->dontSeeFileFound("widget_link_2", $projectStorage);
        $I->dontSeeFileFound("widget_link_3", $projectStorage);

        $I->amOnPage("/demo/file");
        $I->seeCurrentUrlEquals("/demo/file");

        $I->seeElement("input[value=widget_button_1]");
        $I->seeElement("input[value=widget_button_2]");
        $I->seeElement("input[value=widget_button_3]");

        $I->seeLink("widget_link_1");
        $I->seeLink("widget_link_2");
        $I->seeLink("widget_link_3");

        $I->seeFileFound("$projectStorage/widget_button_1");
        $I->seeFileFound("$projectStorage/widget_button_2");
        $I->seeFileFound("$projectStorage/widget_button_3");

        $I->seeFileFound("$projectStorage/widget_link_1");
        $I->seeFileFound("$projectStorage/widget_link_2");
        $I->seeFileFound("$projectStorage/widget_link_3");

        $serialized_button1 = $I->castToString(file_get_contents("$projectStorage/widget_button_1"));
        $serialized_button2 = $I->castToString(file_get_contents("$projectStorage/widget_button_2"));
        $serialized_button3 = $I->castToString(file_get_contents("$projectStorage/widget_button_3"));

        $button1 = $I->castToWidgetButton(unserialize($serialized_button1));
        $button2 = $I->castToWidgetButton(unserialize($serialized_button2));
        $button3 = $I->castToWidgetButton(unserialize($serialized_button3));

        $I->assertEquals("widget_button_1", $button1->key());
        $I->assertEquals("widget_button_2", $button2->key());
        $I->assertEquals("widget_button_3", $button3->key());

        $serialized_link1 = $I->castToString(file_get_contents("$projectStorage/widget_link_1"));
        $serialized_link2 = $I->castToString(file_get_contents("$projectStorage/widget_link_2"));
        $serialized_link3 = $I->castToString(file_get_contents("$projectStorage/widget_link_3"));

        $link1 = $I->castToWidgetLink(unserialize($serialized_link1));
        $link2 = $I->castToWidgetLink(unserialize($serialized_link2));
        $link3 = $I->castToWidgetLink(unserialize($serialized_link3));

        $I->assertEquals("widget_link_1", $link1->key());
        $I->assertEquals("widget_link_2", $link2->key());
        $I->assertEquals("widget_link_3", $link3->key());
    }
}

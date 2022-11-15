<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

class Test05_RedisStorageCest
{
    public function test(AcceptanceTester $I): void
    {
        $I->cleanup();

        $I->dontSeeInRedis("widget_link_1");
        $I->dontSeeInRedis("widget_link_2");
        $I->dontSeeInRedis("widget_link_3");

        $I->dontSeeInRedis("widget_button_1");
        $I->dontSeeInRedis("widget_button_2");
        $I->dontSeeInRedis("widget_button_3");

        $I->amOnPage("/demo/redis");
        $I->seeCurrentUrlEquals("/demo/redis");

        $I->seeElement("input[value=widget_button_1]");
        $I->seeElement("input[value=widget_button_2]");
        $I->seeElement("input[value=widget_button_3]");

        $I->seeLink("widget_link_1");
        $I->seeLink("widget_link_2");
        $I->seeLink("widget_link_3");

        $I->seeInRedis("widget_link_1");
        $I->seeInRedis("widget_link_2");
        $I->seeInRedis("widget_link_3");

        $I->seeInRedis("widget_button_1");
        $I->seeInRedis("widget_button_2");
        $I->seeInRedis("widget_button_3");

        $serialized_button1 = $I->castToString($I->grabFromRedis("widget_button_1"));
        $serialized_button2 = $I->castToString($I->grabFromRedis("widget_button_2"));
        $serialized_button3 = $I->castToString($I->grabFromRedis("widget_button_3"));

        $button1 = $I->castToWidgetButton(unserialize($serialized_button1));
        $button2 = $I->castToWidgetButton(unserialize($serialized_button2));
        $button3 = $I->castToWidgetButton(unserialize($serialized_button3));

        $I->assertEquals("widget_button_1", $button1->key());
        $I->assertEquals("widget_button_2", $button2->key());
        $I->assertEquals("widget_button_3", $button3->key());

        $serialized_link1 = $I->castToString($I->grabFromRedis("widget_link_1"));
        $serialized_link2 = $I->castToString($I->grabFromRedis("widget_link_2"));
        $serialized_link3 = $I->castToString($I->grabFromRedis("widget_link_3"));

        $link1 = $I->castToWidgetlink(unserialize($serialized_link1));
        $link2 = $I->castToWidgetlink(unserialize($serialized_link2));
        $link3 = $I->castToWidgetlink(unserialize($serialized_link3));

        $I->assertEquals("widget_link_1", $link1->key());
        $I->assertEquals("widget_link_2", $link2->key());
        $I->assertEquals("widget_link_3", $link3->key());
    }
}

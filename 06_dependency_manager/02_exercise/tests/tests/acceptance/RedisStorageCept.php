<?php

$I = new AcceptanceTester($scenario);

$I->cleanup();

$I->dontSeeInRedis("widget_link_1");
$I->dontSeeInRedis("widget_link_2");
$I->dontSeeInRedis("widget_link_3");

$I->dontSeeInRedis("widget_button_1");
$I->dontSeeInRedis("widget_button_2");
$I->dontSeeInRedis("widget_button_3");

$I->amOnPage("/RedisStorage");
$I->seeCurrentUrlEquals("/RedisStorage");

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

$button1 = unserialize($I->grabFromRedis("widget_button_1"));
$button2 = unserialize($I->grabFromRedis("widget_button_2"));
$button3 = unserialize($I->grabFromRedis("widget_button_3"));

$I->assertEquals('Widget\Button', get_class($button1));
$I->assertEquals('Widget\Button', get_class($button2));
$I->assertEquals('Widget\Button', get_class($button3));

$I->assertEquals("widget_button_1", $button1->key());
$I->assertEquals("widget_button_2", $button2->key());
$I->assertEquals("widget_button_3", $button3->key());

$link1 = unserialize($I->grabFromRedis("widget_link_1"));
$link2 = unserialize($I->grabFromRedis("widget_link_2"));
$link3 = unserialize($I->grabFromRedis("widget_link_3"));

$I->assertEquals('Widget\Link', get_class($link1));
$I->assertEquals('Widget\Link', get_class($link2));
$I->assertEquals('Widget\Link', get_class($link3));

$I->assertEquals("widget_link_1", $link1->key());
$I->assertEquals("widget_link_2", $link2->key());
$I->assertEquals("widget_link_3", $link3->key());

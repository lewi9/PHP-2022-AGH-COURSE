<?php

$I = new AcceptanceTester($scenario);

$I->executeInDatabase("DROP TABLE IF EXISTS objects");

$I->amOnPage("/MySQLStorage");
$I->seeCurrentUrlEquals("/MySQLStorage");

$I->seeElement("input[value=widget_button_1]");
$I->seeElement("input[value=widget_button_2]");
$I->seeElement("input[value=widget_button_3]");

$I->seeLink("widget_link_1");
$I->seeLink("widget_link_2");
$I->seeLink("widget_link_3");

$I->seeNumRecords(6, "objects");

$I->executeInDatabase("DELETE FROM objects");
$I->dontSeeInDatabase("objects");

$I->amOnPage("/MySQLStorage");
$I->seeCurrentUrlEquals("/MySQLStorage");

$I->seeElement("input[value=widget_button_1]");
$I->seeElement("input[value=widget_button_2]");
$I->seeElement("input[value=widget_button_3]");

$I->seeLink("widget_link_1");
$I->seeLink("widget_link_2");
$I->seeLink("widget_link_3");

$I->seeNumRecords(6, "objects");

$button1 = unserialize($I->grabColumnFromDatabase("objects", "data", ["key" => "widget_button_1"])[0]);
$button2 = unserialize($I->grabColumnFromDatabase("objects", "data", ["key" => "widget_button_2"])[0]);
$button3 = unserialize($I->grabColumnFromDatabase("objects", "data", ["key" => "widget_button_3"])[0]);

$I->assertEquals('Widget\Button', get_class($button1));
$I->assertEquals('Widget\Button', get_class($button2));
$I->assertEquals('Widget\Button', get_class($button3));

$I->assertEquals("widget_button_1", $button1->key());
$I->assertEquals("widget_button_2", $button2->key());
$I->assertEquals("widget_button_3", $button3->key());

$link1 = unserialize($I->grabColumnFromDatabase("objects", "data", ["key" => "widget_link_1"])[0]);
$link2 = unserialize($I->grabColumnFromDatabase("objects", "data", ["key" => "widget_link_2"])[0]);
$link3 = unserialize($I->grabColumnFromDatabase("objects", "data", ["key" => "widget_link_3"])[0]);

$I->assertEquals('Widget\Link', get_class($link1));
$I->assertEquals('Widget\Link', get_class($link2));
$I->assertEquals('Widget\Link', get_class($link3));

$I->assertEquals("widget_link_1", $link1->key());
$I->assertEquals("widget_link_2", $link2->key());
$I->assertEquals("widget_link_3", $link3->key());

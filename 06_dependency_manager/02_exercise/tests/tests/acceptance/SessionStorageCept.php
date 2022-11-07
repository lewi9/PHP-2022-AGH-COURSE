<?php

$I = new AcceptanceTester($scenario);

$I->amOnPage("/SessionStorage");
$I->seeCurrentUrlEquals("/SessionStorage");

$I->seeElement("input[value=widget_button_1]");
$I->seeElement("input[value=widget_button_2]");
$I->seeElement("input[value=widget_button_3]");

$I->seeLink("widget_link_1");
$I->seeLink("widget_link_2");
$I->seeLink("widget_link_3");

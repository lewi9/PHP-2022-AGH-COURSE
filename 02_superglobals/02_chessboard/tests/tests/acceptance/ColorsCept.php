<?php

$I = new AcceptanceTester($scenario);

$I->amOnPage("/");
$I->seeCurrentUrlEquals("/");
$I->seeChessboard(10, 10);
$I->seeElement("a", ["class" => "block gray"]);
$I->dontSeeElement("a", ["class" => "block red"]);
$I->dontSeeElement("a", ["class" => "block green"]);
$I->dontSeeElement("a", ["class" => "block blue"]);
$I->dontSeeCookie("color");

$I->selectOption("color", "red");
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->seeCookie("color", ["red"]);
$I->seeChessboard(10, 10);
$I->dontSeeElement("a", ["class" => "block gray"]);
$I->seeElement("a", ["class" => "block red"]);
$I->dontSeeElement("a", ["class" => "block green"]);
$I->dontSeeElement("a", ["class" => "block blue"]);

$I->selectOption("color", "green");
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->seeCookie("color", ["green"]);
$I->seeChessboard(10, 10);
$I->dontSeeElement("a", ["class" => "block gray"]);
$I->dontSeeElement("a", ["class" => "block red"]);
$I->seeElement("a", ["class" => "block green"]);
$I->dontSeeElement("a", ["class" => "block blue"]);

$I->selectOption("color", "blue");
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->seeCookie("color", ["blue"]);
$I->seeChessboard(10, 10);
$I->dontSeeElement("a", ["class" => "block gray"]);
$I->dontSeeElement("a", ["class" => "block red"]);
$I->dontSeeElement("a", ["class" => "block green"]);
$I->seeElement("a", ["class" => "block blue"]);

$I->resetCookie("color");
$I->amOnPage("/");
$I->seeCurrentUrlEquals("/");
$I->seeChessboard(10, 10);
$I->seeElement("a", ["class" => "block gray"]);
$I->dontSeeElement("a", ["class" => "block red"]);
$I->dontSeeElement("a", ["class" => "block green"]);
$I->dontSeeElement("a", ["class" => "block blue"]);

<?php

$I = new AcceptanceTester($scenario);

$I->amOnPage("/");
$I->seeCurrentUrlEquals("/");
$I->seeCookie("PHPSESSID");
$I->seeChessboard(10, 10);

$I->fillField("sx", 0);
$I->fillField("sz", 0);
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->dontSeeChessboard();

$I->fillField("sx", 1);
$I->fillField("sz", 0);
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->dontSeeChessboard();

$I->fillField("sx", 0);
$I->fillField("sz", 1);
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->dontSeeChessboard();

$I->fillField("sx", 1);
$I->fillField("sz", 1);
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->seeChessboard(1, 1);

$I->fillField("sx", 7);
$I->fillField("sz", 13);
$I->click("Change");
$I->seeCurrentUrlEquals("/");
$I->seeChessboard(13, 7);

$I->resetCookie("PHPSESSID");
$I->amOnPage("/");
$I->seeCurrentUrlEquals("/");
$I->seeCookie("PHPSESSID");
$I->seeChessboard(10, 10);

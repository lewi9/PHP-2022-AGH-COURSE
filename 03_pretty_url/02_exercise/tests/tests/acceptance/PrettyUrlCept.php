<?php

$I = new AcceptanceTester($scenario);

$I->amOnPage("/");
$I->seeCurrentUrlEquals("/");
$I->see("Welcome on homepage!");

$I->click("Home");
$I->seeCurrentUrlEquals("/home");
$I->see("Welcome on homepage!");

$I->click("About");
$I->seeCurrentUrlEquals("/about");
$I->see("Pretty URL test application!");

$I->click("Users");
$I->seeCurrentUrlEquals("/users");
$I->see("John");
$I->see("Peter");
$I->see("Paul");

$I->click("John");
$I->seeCurrentUrlEquals("/user/1");
$I->see("Name: John");
$I->see("Surname: Doe");
$I->see("Age: 21");

$I->click("Users");
$I->seeCurrentUrlEquals("/users");

$I->click("Peter");
$I->seeCurrentUrlEquals("/user/2");
$I->see("Name: Peter");
$I->see("Surname: Bauer");
$I->see("Age: 16");

$I->click("Users");
$I->seeCurrentUrlEquals("/users");

$I->click("Paul");
$I->seeCurrentUrlEquals("/user/3");
$I->see("Name: Paul");
$I->see("Surname: Smith");
$I->see("Age: 18");

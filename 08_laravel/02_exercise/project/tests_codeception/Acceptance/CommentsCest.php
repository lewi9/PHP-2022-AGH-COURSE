<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class CommentsCest
{
    public function tryToTest(AcceptanceTester $I): void
    {
        $I->wantTo('see comments from DB displayed on page');

        $I->seeNumRecords(0, "comments");

        $randomNumber = rand();

        $title = "Title $randomNumber";
        $text = "Some text $randomNumber";

        $id = $I->haveInDatabase('comments', ['title' => $title, 'text' => $text]);

        $I->amOnPage('/comments');
        $I->see('Comments', 'h1');
        $I->seeLink($title, "/comments/$id");

        $I->click($title);
        $I->seeCurrentUrlEquals("/comments/$id");

        $I->see($title, 'h1');
        $I->see($text, 'p');
    }
}

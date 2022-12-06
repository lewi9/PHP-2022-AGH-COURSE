<?php

namespace TestsCodeception\Acceptance;

use TestsCodeception\Support\AcceptanceTester;

class Test03_BooksCest
{
    public function booksTest(AcceptanceTester $I): void
    {
        $I->wantTo('have books page');

        $I->amOnPage('/books');
        $I->seeCurrentUrlEquals('/login');

        $I->fillField('email', 'john.doe@gmail.com');
        $I->fillField('password', 'secret');

        $I->click('Log in');

        $I->seeCurrentUrlEquals('/books');

        $I->see('List of books', 'h2');

        $I->see('No books in database.');

        $I->click('Create new...');

        $I->seeCurrentUrlEquals('/books/create');

        $I->see('Creating a book', 'h2');

        $I->click('Create');

        $I->seeCurrentUrlEquals('/books/create');

        $I->see('The isbn field is required.', 'li');
        $I->see('The title field is required.', 'li');
        $I->see('The description field is required.', 'li');

        $bookIsbn = "1234512345123";
        $bookTitle = "SomeTitle";
        $bookDescriptionIntro = "SomeDescription with";
        $bookDescriptionFormatted = "formatting";
        $bookDescription = "$bookDescriptionIntro **$bookDescriptionFormatted**";

        $I->fillField('isbn', 'string');
        $I->fillField('title', $bookTitle);
        $I->fillField('description', $bookDescription);

        $I->click('Create');
        $I->seeCurrentUrlEquals('/books/create');

        $I->see('The isbn must be 13 digits.', 'li');
        $I->dontSee('The name title is required.', 'li');
        $I->dontSee('The surname description is required.', 'li');

        $I->fillField('isbn', $bookIsbn);


        $I->dontSeeInDatabase('books', [
            'isbn' => $bookIsbn,
            'title' => $bookTitle,
            'description' => $bookDescription
        ]);

        $I->click('Create');

        $I->seeInDatabase('books', [
            'isbn' => $bookIsbn,
            'title' => $bookTitle,
            'description' => $bookDescription
        ]);

        $id = $I->grabFromDatabase('books', 'id', [
            'isbn' => $bookIsbn
        ]);

        $I->seeCurrentUrlEquals('/books/' . $id);

        $I->see("Viewing a book", 'h2');
        $I->see($bookIsbn);
        $I->see($bookTitle);
        $I->see($bookDescriptionIntro);
        $I->see($bookDescriptionFormatted, 'strong');

        $I->amOnPage('/books');

        $I->see("$bookIsbn", 'tr > td');
        $I->see("$bookTitle", 'tr > td');
        $I->dontSee("$bookDescription", 'tr > td');

        $I->click('Details');

        $I->seeCurrentUrlEquals('/books/' . $id);

        $I->click('Edit');

        $I->seeCurrentUrlEquals('/books/' . $id . '/edit');
        $I->see('Editing a book', 'h2');

        $I->seeInField('isbn', $bookIsbn);
        $I->seeInField('title', $bookTitle);
        $I->seeInField('description', $bookDescription);

        $I->fillField('description', "");

        $I->click('Update');

        $I->seeCurrentUrlEquals('/books/' . $id . '/edit');
        $I->see('The description field is required.', 'li');

        $bookNewDescription = 'NewBookDescription';

        $I->fillField('description', $bookNewDescription);
        $I->click('Update');

        $I->seeCurrentUrlEquals('/books/' . $id);

        $I->see($bookNewDescription);

        $I->dontSeeInDatabase('books', [
            'isbn' => $bookIsbn,
            'description' => $bookDescription
        ]);

        $I->seeInDatabase('books', [
            'isbn' => $bookIsbn,
            'description' => $bookNewDescription
        ]);

        $I->click('Delete');

        $I->seeCurrentUrlEquals('/books');

        $I->dontSeeInDatabase('books', [
            'isbn' => $bookIsbn,
            'description' => $bookNewDescription
        ]);
    }
}

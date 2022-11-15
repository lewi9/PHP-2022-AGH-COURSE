<?php

namespace Tests\Unit;

use Tests\Support\UnitTester;

use String\Editor;

class Test00_StringEditorCest
{
    public function create(UnitTester $I): void
    {
        $editor = new Editor("This is a sentence");
        $I->assertEquals("This is a sentence", $editor->get());
    }

    public function replaceWord(UnitTester $I): void
    {
        $editor = new Editor("This is a sentence");
        $editor->replace("This is", "That was");
        $I->assertEquals("That was a sentence", $editor->get());
    }

    public function lowercase(UnitTester $I): void
    {
        $editor = new Editor("This is a sentence");
        $I->assertEquals("this is a sentence", $editor->lower()->get());
    }

    public function uppercase(UnitTester $I): void
    {
        $editor = new Editor("This is a sentence");
        $I->assertEquals("THIS IS A SENTENCE", $editor->upper()->get());
    }

    public function replaceAndUpperCase(UnitTester $I): void
    {
        $editor = new Editor("This is a sentence");
        $result = $editor->replace("sentence", "fancy sentence")->upper()->get();
        $I->assertEquals("THIS IS A FANCY SENTENCE", $result);
    }

    public function censorWord(UnitTester $I): void
    {
        $editor = new Editor("This is a sentence");
        $I->assertEquals("This is a ********", $editor->censor("sentence")->get());
    }

    public function censorShortAndLongWords(UnitTester $I): void
    {
        $editor = new Editor("Sentence with simple and sophisticated words");
        $result = $editor->censor("simple")->censor("sophisticated")->get();
        $I->assertEquals("Sentence with ****** and ************* words", $result);
    }

    public function repeatWord(UnitTester $I): void
    {
        $editor = new Editor("Sentence with simple word");
        $result = $editor->repeat("simple ", 4)->get();
        $I->assertEquals("Sentence with simple simple simple simple word", $result);
    }

    public function removeWord(UnitTester $I): void
    {
        $editor = new Editor("Sentence with simple word");
        $result = $editor->remove("simple ")->get();
        $I->assertEquals("Sentence with word", $result);
    }

    public function editSentence(UnitTester $I): void
    {
        $editor = new Editor("Unit testing frameworks like Codeception allow to test very fancy things");

        $editor->replace("Codeception", "one we have used")
            ->censor("testing")->remove("to test ")->repeat("very ", 2);

        $I->assertEquals("Unit ******* frameworks like one we have used allow very very fancy things", $editor->get());
    }
}

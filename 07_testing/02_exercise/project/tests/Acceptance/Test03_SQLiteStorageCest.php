<?php

namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;
use PDO;

class Test03_SQLiteStorageCest
{
    public function test(AcceptanceTester $I): void
    {
        $projectStorage = "../project/storage/SQLiteStorage";

        $I->cleanDir("$projectStorage");

        $I->dontSeeFileFound("db.sqlite", $projectStorage);

        $I->amOnPage("/demo/sqlite");
        $I->seeCurrentUrlEquals("/demo/sqlite");

        $I->seeElement("input[value=widget_button_1]");
        $I->seeElement("input[value=widget_button_2]");
        $I->seeElement("input[value=widget_button_3]");

        $I->seeLink("widget_link_1");
        $I->seeLink("widget_link_2");
        $I->seeLink("widget_link_3");

        $I->seeFileFound("db.sqlite", $projectStorage);

        // Using PDO directly because Codeception is configured with MySQL
        $pdo = new PDO("sqlite:$projectStorage/db.sqlite");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $pdo->query("SELECT * FROM objects ORDER BY key");
        $objects = $I->castToPDOStatement($query)->fetchAll();

        $I->assertEquals(6, sizeof($objects));

        $I->assertEquals("widget_button_1", $objects[0]["key"]);
        $I->assertEquals("widget_button_2", $objects[1]["key"]);
        $I->assertEquals("widget_button_3", $objects[2]["key"]);

        $button1 = $I->castToWidgetButton(unserialize($objects[0]["data"]));
        $button2 = $I->castToWidgetButton(unserialize($objects[1]["data"]));
        $button3 = $I->castToWidgetButton(unserialize($objects[2]["data"]));

        $I->assertEquals("widget_button_1", $button1->key());
        $I->assertEquals("widget_button_2", $button2->key());
        $I->assertEquals("widget_button_3", $button3->key());

        $I->assertEquals("widget_link_1", $objects[3]["key"]);
        $I->assertEquals("widget_link_2", $objects[4]["key"]);
        $I->assertEquals("widget_link_3", $objects[5]["key"]);

        $link1 = $I->castToWidgetLink(unserialize($objects[3]["data"]));
        $link2 = $I->castToWidgetLink(unserialize($objects[4]["data"]));
        $link3 = $I->castToWidgetLink(unserialize($objects[5]["data"]));

        $I->assertEquals("widget_link_1", $link1->key());
        $I->assertEquals("widget_link_2", $link2->key());
        $I->assertEquals("widget_link_3", $link3->key());
    }
}

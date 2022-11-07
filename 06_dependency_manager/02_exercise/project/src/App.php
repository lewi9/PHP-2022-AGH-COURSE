<?php

use Storage\Storage;
use Widget\Widget;
use Widget\Link;
use Widget\Button;

class App
{
    public function run(string $storageTypeName): void
    {
        $fullStorageTypeName = "\\Storage\\$storageTypeName";

        echo "Test for: $fullStorageTypeName<br/>";

        $storage = new $fullStorageTypeName();

        if (!$storage instanceof Storage) {
            exit("Storage type is invalid!");
        }

        $widgets = [
            new Link(1), new Link(2), new Link(3),
            new Button(1), new Button(2), new Button(3)
        ];

        foreach ($widgets as $widget) {
            $storage->store($widget);
        }

        foreach ($storage->loadAll() as $distinguishable) {
            if ($distinguishable instanceof Widget) {
                $this->render($distinguishable);
            }
        }
    }

    private function render(Widget $widget): void
    {
        $widget->draw();
    }
}

<?php

use Widget\Widget;

class App
{
    public function run(): void
    {
        $storage = new \Storage\FileStorage();
        for($i = 0; $i<5; $i++ )
        {
            $storage->store(new \Widget\Button($i));
            $storage->store(new \Widget\Link($i));
        }
        foreach($storage->loadAll() as $elem)
            $this->render($elem);
    }
    private function render (Widget $widget): void
    {
        $widget->draw();
    }
}

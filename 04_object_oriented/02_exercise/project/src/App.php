<?php

use Widget\Widget;

class App
{
    public function run(): void
    {
        $storage = new \Storage\FileStorage();
        for($i = 1; $i<=SIZE; $i++ )
        {
            $storage->store(new \Widget\Button($i));
            $storage->store(new \Widget\Link($i));
        }
        foreach($storage->loadAll() as $elem)
        {
            if($elem instanceof Widget)
                $this->render($elem);
        }

    }
    private function render (Widget $widget): void
    {
        $widget->draw();
    }
}

<?php

use Widget\Widget;

class App
{
    public function run(): void
    {
        $buttons = array();
        $links = array();
        $storage = new \Storage\FileStorage();
        for($i = 0; $i<5; $i++ )
        {
            $buttons[] = new \Widget\Button($i);
            $links[] = new \Widget\Link($i);
        }
        for($i = 0; $i<5; $i++ )
        {
            $storage->store($buttons[$i]);
            $storage->store($links[$i]);
        }

    }
    private function render (Widget $widget): void
    {

    }
}

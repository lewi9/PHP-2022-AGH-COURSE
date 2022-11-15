<?php

namespace Controller;

use Storage\Exception\StorageException;
use Widget\Link;
use Widget\Button;

class DemoController extends Controller
{
    public function index(): Result
    {
        return view('demo.index')->withTitle('Demo');
    }

    /**
     * @throws StorageException
     */
    private function demo(string $type): Result
    {
        $storage = $this->storage($type);

        $widgets = [
            new Link(1), new Link(2), new Link(3), new Link(4),
            new Button(1), new Button(2), new Button(3), new Button(4)
        ];

        foreach ($widgets as $widget) {
            $storage->store($widget);
        }

        $storage->remove("widget_link_4");
        $storage->remove("widget_button_4");

        return view('demo.show')->withTitle("Demo for " . $type)->with('widgets', $storage->load('widget_*'));
    }

    /**
     * @throws StorageException
     */
    public function mysql(): Result
    {
        return $this->demo('mysql');
    }

    /**
     * @throws StorageException
     */
    public function sqlite(): Result
    {
        return $this->demo('sqlite');
    }

    /**
     * @throws StorageException
     */
    public function file(): Result
    {
        return $this->demo('file');
    }

    /**
     * @throws StorageException
     */
    public function session(): Result
    {
        return $this->demo('session');
    }

    /**
     * @throws StorageException
     */
    public function redis(): Result
    {
        return $this->demo('redis');
    }
}

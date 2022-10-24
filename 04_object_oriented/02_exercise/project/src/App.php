<?php

class App
{
    public function run(): void {
        echo "Hello from App.php!";

        $baz = new \Foo\Bar\Baz();

        echo "<br/>";

        $dummy = new Dummy("asdfjasfd");

        $s = serialize($dummy);

        // store to file

        // read from file

        $object = unserialize($s);

        if (!$object instanceof Dummy)
            exit("Wrong type!");

        $object->test();
    }
}

<?php

namespace Storage;

use Concept\Distinguishable;

trait SerializationHelpers
{
    public static function deserializeAsDistinguishable(string $contents): Distinguishable
    {
        $object = unserialize($contents);
        if (!$object instanceof Distinguishable) {
            exit("Deserialized object is not a Distinguishable!");
        }
        return $object;
    }
}

<?php

namespace App\Helpers;

use App\Models\User;

/**
 * Provides helpers static analysers.
 */
trait HasEnsure
{
    public function ensureIsString(mixed $object): string
    {
        if (gettype($object) != 'string') {
            abort(500, '$object is not a string!');
        }
        return $object;
    }

    public function ensureIsStringOrNull(mixed $object): string|null
    {
        return $object ? $this->ensureIsString($object) : null;
    }

    public function ensureIsNotNullUser(User|null $user): User
    {
        if ($user) {
            return $user;
        }
        abort(500, '$user is null!');
    }

    /**
     * @return mixed[]
     */
    public function ensureIsArray(mixed $array): array
    {
        if (is_array($array)) {
            return $array;
        }
        abort(500, '$array is an array!');
    }
}

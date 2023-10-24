<?php

namespace App\Traits;

trait ArraySerializer
{
    public function toArray()
    {
        $array = [];
        foreach($this as $key => $property) {
            $array[$key] = $property;
        }
        return $array;
    }
}

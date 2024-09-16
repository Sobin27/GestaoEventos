<?php
namespace App\Core\Traits;

trait ArraySerializer
{
    public function toArray(): array
    {
        $array = [];
        foreach($this as $key => $property) {
            $array[$key] = $property;
        }
        return $array;
    }
}

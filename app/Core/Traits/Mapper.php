<?php
namespace App\Core\Traits;

trait Mapper
{
    public function mapTo(): array
    {
        $arrayFormated = [];
        foreach ($this->getAttributes() as $key => $value) {
            $camelCaseKey = lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $key))));
            $arrayFormated[$camelCaseKey] = $value;
        }
        return $arrayFormated;
    }
}

<?php

namespace Vgplay\Heros\Traits;

trait HasObjectListFormElement
{
    protected function fillObjectList(array $objectValueSeparatedByObjectKey)
    {
        $objects = [];

        foreach (($objectValueSeparatedByObjectKey ?? []) as $key => $separatedValues) {
            foreach (($separatedValues ?? []) as $i => $value) {
                $objects[$i][$key] = $value;
            }
        }

        return $objects;
    }
}

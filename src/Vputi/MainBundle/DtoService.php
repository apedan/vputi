<?php

namespace Vputi\MainBundle;

function getClosure($object)
{
    $getter = function($dto){
        foreach(get_object_vars($this) as $variable => $value) {
            if (property_exists($dto, $variable)) {
                $dto->$variable = $this->$variable;
            }
        }
        return $dto;
    };

    return $getter->bindTo($object, $object);
}

/**
 * Dto Service
 */
class DtoService
{
    /**
     * Object or array of objects to dto object/objects
     *
     * @param $data
     * @param $dto
     * @return array|object
     */
    public static function objectToDto($data, $dto)
    {
        $result = array();
        if (is_array($data) && !empty($data)) {
            foreach($data as $object) {
                $closure = getClosure($object);
                $result[] = $closure(new $dto);
            }
        } elseif (is_object($data)) {
            $closure = getClosure($data);
            $result = $closure($dto);
        }

        return $result;
    }
}



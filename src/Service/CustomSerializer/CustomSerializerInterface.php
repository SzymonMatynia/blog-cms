<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 28.12.18
 * Time: 13:12
 */

namespace App\Service\CustomSerializer;


interface CustomSerializerInterface
{
    public function normalizeObject($object);
    public function denormalizeObject($object, $class);
}
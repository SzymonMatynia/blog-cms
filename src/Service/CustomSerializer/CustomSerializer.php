<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 28.12.18
 * Time: 13:12
 */

namespace App\Service\CustomSerializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class CustomSerializer implements CustomSerializerInterface
{
    private $objectNormalizer;
    private $arrayDenormalizer;
    public function __construct(ObjectNormalizer $objectNormalizer, DenormalizerInterface $arrayDenormalizer)
    {
        $this->objectNormalizer = $objectNormalizer;
        $this->arrayDenormalizer = $arrayDenormalizer;
    }

    public function normalizeObject($object)
    {
        return $this->objectNormalizer->normalize($object);
        //$this->objectNormalizer->normalize($object);
    }
    public function denormalizeObject($object, $class)
    {
        return $this->arrayDenormalizer->denormalize($object, $class);
    }

}
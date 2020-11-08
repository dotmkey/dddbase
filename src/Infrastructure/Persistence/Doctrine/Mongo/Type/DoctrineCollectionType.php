<?php
declare(strict_types=1);

namespace DDDBase\Infrastructure\Persistence\Doctrine\Mongo\Type;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Types\Type;
use DDDBase\Domain\Assertion\Assertion;

class DoctrineCollectionType extends Type
{
    /**
     * @param ArrayCollection $value
     * @return mixed|void
     */
    public function convertToDatabaseValue($value)
    {
        Assertion::assertInstanceOf($value, ArrayCollection::class);

        return array_values($value->toArray());
    }

    /**
     * @param array $value
     * @return mixed|void
     */
    public function convertToPHPValue($value)
    {
        Assertion::assertIsArray($value);
        Assertion::assertIsNotEmpty($value);

        return new ArrayCollection(array_values($value));
    }

    public function closureToPHP(): string
    {
        $return  = '\DDDBase\Domain\Assertion\Assertion::assertIsArray($value);';
        $return .= '\DDDBase\Domain\Assertion\Assertion::assertIsNotEmpty($value);';
        $return .= '$return = new \Doctrine\Common\Collections\ArrayCollection(\array_values($value));';

        return $return;
    }
}
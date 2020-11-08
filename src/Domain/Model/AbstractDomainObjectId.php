<?php
declare(strict_types=1);

namespace DDDBase\Domain\Model;

use DDDBase\Domain\Assertion\Assertion;

abstract class AbstractDomainObjectId extends AbstractValueObject
{
    protected string $id;

    public function __construct(string $id)
    {
        $this->setId($id);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function equals(AbstractValueObject $valueObject): bool
    {
        return $valueObject instanceof static && $this->id() === $valueObject->id();
    }

    protected function setId(string $id): void
    {
        Assertion::assertIsNotEmpty($id);

        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->id();
    }
}
<?php
declare(strict_types=1);

namespace DDDBase\Application\Command;

abstract class AbstractCommand implements SchemableInterface
{
    public static function fromArray(array $data): self
    {
        $command = new static();
        foreach ($data as $key => $value) {
            $methodNamePart = implode('', explode('_', $key));

            $methodName = is_array($value) && method_exists($command, $methodName = $methodNamePart . 'FromArray')
                ? $methodName
                : (method_exists($command, $methodName = 'set' . $methodNamePart) ? $methodName : null)
            ;

            if ($methodName === null) {
                continue;
            }

            $command->$methodName($value);
        }

        return $command;
    }
}
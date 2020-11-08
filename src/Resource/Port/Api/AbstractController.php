<?php
declare(strict_types=1);

namespace DDDBase\Resource\Port\Api;

use DDDBase\Application\Command\AbstractCommand;
use DDDBase\Resource\Port\Api\Response\Success;
use DDDBase\Resource\Port\Api\Serialization\CommandDenormalizer;
use DDDBase\Resource\Port\Api\Serialization\TransformerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController as BaseAbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractController extends BaseAbstractController
{
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        return parent::json((new Success())->setData($data), $status, $headers, $context);
    }

    protected function jsonContent2Command(
        string $commandClass,
        TransformerInterface $transformer = null
    ): AbstractCommand {
        $content = $this->get('request_stack')->getCurrentRequest()->getContent();

        /** @var Serializer $serializer */
        $serializer = $this->get('serializer');
        $command = $serializer->deserialize(
            $content, $commandClass, 'json', [CommandDenormalizer::TRANSFORMER_CONTEXT => $transformer]
        );

        if (!is_a($command, $commandClass)) {
            throw new \RuntimeException('Denormalization error.');
        }

        return $command;
    }
}
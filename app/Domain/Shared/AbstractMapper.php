<?php

namespace App\Domain\Shared;

use App\Infrastructure\Exception\InfrastructureException;
use App\Infrastructure\Persistence\DocumentInterface;
use App\Infrastructure\Persistence\Hibernate\MapperInterface;

abstract class AbstractMapper implements MapperInterface
{
    /**
     * @var string
     */
    private $documentClass;

    /**
     * AbstractMapper constructor.
     * @param string $documentClass
     */
    public function __construct(string $documentClass)
    {
        $this->documentClass = $documentClass;
    }

    /**
     * @param array $data
     * @return DocumentInterface
     * @throws InfrastructureException
     */
    public function instantiate(array $data) : DocumentInterface
    {
        $documentClass = $this->documentClass;

        if (!$documentClass) {
            throw new InfrastructureException('documentClass is not set.');
        }

        $document = new $documentClass($data);

        if (!$document instanceof DocumentInterface) {
            throw new InfrastructureException(get_class($document).' is not an instance of '.DocumentInterface::class);
        }

        return $document;
    }

    public function getIndex() : string
    {
        return str_replace('\\','_', strtolower($this->documentClass));
    }

    public function getType() : string
    {
        return str_replace('\\','_', strtolower($this->documentClass));
    }
}
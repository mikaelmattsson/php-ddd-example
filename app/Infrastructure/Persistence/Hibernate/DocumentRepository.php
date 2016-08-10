<?php

namespace App\Infrastructure\Persistence\Hibernate;

use App\Infrastructure\Exception\InfrastructureException;
use App\Infrastructure\Persistence\DocumentInterface;

class DocumentRepository
{
    /**
     * @var string
     */
    protected $documentClass = '';

    /**
     * @var string
     */
    protected $collectionClass = '';

    /**
     * @var PersistenceService
     */
    private $persistenceService;

    /**
     * @var array
     */
    private $dirty = [];

    /**
     * @param PersistenceService $persistenceService
     */
    public function __construct(PersistenceService $persistenceService)
    {
        $this->persistenceService = $persistenceService;
    }

    /**
     * @param array $data
     * @return DocumentInterface
     * @throws InfrastructureException
     */
    public function create(array $data) : DocumentInterface
    {
        $document = $this->newDocument($data);

        $this->persist($document);

        return $document;
    }

    /**
     * @param DocumentInterface $document
     * @return DocumentRepository|static
     */
    public function persist(DocumentInterface $document) : DocumentRepository
    {
        $this->dirty[spl_object_hash($document)] = $document;

        return $this;
    }

    /**
     * @return DocumentRepository|static
     */
    public function save() : DocumentRepository
    {
        $this->persistenceService->save($this->dirty);

        $this->dirty = [];

        return $this;
    }

    /**
     *
     */
    public function newDocument($data) : DocumentInterface
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

    public function getAll()
    {
        $document = $this->newDocument([]);

        $data = $this->persistenceService->search([
            'index' => $document->getIndex(),
            'type' => $document->getType(),
        ]);

        dd($data);
    }

    public function get($id)
    {
        $document = $this->newDocument([]);
        $this->persistenceService->get([
            'index' => $document->getIndex(),
            'type' => $document->getType(),
            'id' => $id,
        ]);
    }
}
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
     * @var string
     */
    protected $mapperClass = '';

    /**
     * @var MapperInterface
     */
    private $mapper;

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

        $mapperClass = $this->mapperClass;

        $this->mapper = new $mapperClass($this->documentClass);
    }

    /**
     * @param array $data
     * @return DocumentInterface
     * @throws InfrastructureException
     */
    public function create(array $data) : DocumentInterface
    {
        $document = $this->mapper->deserialize($data);

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

    public function getAll()
    {
        //$document = $this->mapper->deserialize([]);

        $data = $this->persistenceService->search([
            'index' => $this->mapper->getIndex(),
            'type' => $this->mapper->getType(),
        ], $this->mapper);

        return $data->getDocuments();
    }

    public function get($id)
    {
        $this->persistenceService->get([
            'index' => $this->mapper->getIndex(),
            'type' => $this->mapper->getType(),
            'id' => $id,
        ], $this->mapper);
    }

    /**
     * @return MapperInterface
     */
    public function getMapper()
    {
        return $this->mapper;
    }
}
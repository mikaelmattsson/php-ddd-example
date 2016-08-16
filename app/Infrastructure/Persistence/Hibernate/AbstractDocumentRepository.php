<?php

namespace App\Infrastructure\Persistence\Hibernate;

use App\Infrastructure\Exception\InfrastructureException;
use App\Infrastructure\Persistence\DocumentInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Illuminate\Config\Repository as Config;

abstract class AbstractDocumentRepository
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
     * @var UuidFactory
     */
    private $uuidFactory;
    /**
     * @var Config
     */
    private $config;

    /**
     * @param PersistenceService $persistenceService
     * @param UuidFactory $uuidFactory
     * @param Config $config
     */
    public function __construct(PersistenceService $persistenceService, UuidFactory $uuidFactory, Config $config)
    {
        $this->persistenceService = $persistenceService;
        $this->uuidFactory = $uuidFactory;
        $this->config = $config;

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
        $data['uuid'] = $this->uuidFactory->uuid5(Uuid::NAMESPACE_URL, $this->config->get('url'));

        $document = $this->mapper->deserialize($data);

        $this->persist($document);

        return $document;
    }

    /**
     * @param DocumentInterface $document
     * @return AbstractDocumentRepository|static
     */
    public function persist(DocumentInterface $document) : AbstractDocumentRepository
    {
        $this->persistenceService->persist($document, $this->mapper);

        return $this;
    }

    /**
     * @return AbstractDocumentRepository|static
     */
    public function save() : AbstractDocumentRepository
    {
        $this->persistenceService->flush();

        return $this;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $data = $this->persistenceService->search([
            'index' => $this->mapper->getIndex(),
            'type' => $this->mapper->getType(),
        ], $this->mapper);

        return $data->getDocuments();
    }

    /**
     * @param $id
     */
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
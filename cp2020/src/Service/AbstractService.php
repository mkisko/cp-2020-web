<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractService
{
    protected $em;
    protected $validator;
    protected $serializer;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        SerializerInterface $serializer
    )
    {
        $this->serializer = $serializer;
        $this->em = $entityManager;
        $this->validator = $validator;
    }
}

<?php
namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AbstractApiController extends AbstractController
{
    protected $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     * @param int $code
     * @param array $headers
     * @return Response
     */
    protected function createResponse($data, $code = 200, $headers = [])
    {
        $response = new Response($data, $code, $headers);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Content-Type', 'charset=UTF8');
        return $response;
    }
}

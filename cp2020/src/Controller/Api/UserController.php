<?php
namespace App\Controller\Api;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class UserController
 * @package App\Controller\Api
 * @Route("/api/users")
 */
class UserController extends AbstractApiController {

    public function __toString()
    {
        return __CLASS__;
    }

    /**
     * @Route("/{$id}", name="get_user", methods={"GET", "POST"})
     * @param $id
     * @return Response
     */
    public function getUserById($id)
    {
        $user = $this->getDoctrine()->getRepository('User')->find($id);

        if (!$user) {
            return $this->createResponse("not found", 404);
        }
        $jsonContent = $this->serializer->serialize($user, 'json', ['groups' => 'users']);

        return $this->createResponse($jsonContent);
    }

    /**
     * @Route("/", name="get_users", methods={"GET", "POST"})
     */
    public function getUsers(){
        $users = $this->getDoctrine()->getRepository('App:User')->findAll();

        $jsonContent = $this->serializer->serialize($users, 'json', ['groups' => 'users']);

        return $this->createResponse($jsonContent);
    }
}

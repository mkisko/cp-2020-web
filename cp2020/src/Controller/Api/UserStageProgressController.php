<?php
namespace App\Controller\Api;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserStageProgressController
 * @package App\Controller\Api
 * @Route("/api/progress")
 */
class UserStageProgressController extends AbstractApiController {

    public function __toString()
    {
        return __CLASS__;
    }

    /**
     * @Route("/{id}", name="get_progress", methods={"GET"})
     * @param $id
     * @return Response
     */
    public function getProgress($id)
    {
        $userStageProgresses = $this->getDoctrine()->getRepository('App:UserStageProgress')->findBy(['User' => $id]);


        $values = [];

        foreach ($userStageProgresses as $userStageProgress) {
            $value["id"] = $userStageProgress->getId();
            $value["status"] = $userStageProgress->getStatus();
            $value["stageName"] = $userStageProgress->getStage()->getTitle();
            $value["vacancyCount"] = 5;
            $value["costMin"] = 20000;
            $value["costMax"] = 25000;

            $values[] = $value;
        }



        $jsonContent = $this->serializer->serialize($values, 'json');

        return $this->createResponse($jsonContent);
    }

}

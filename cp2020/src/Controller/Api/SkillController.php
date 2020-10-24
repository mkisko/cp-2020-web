<?php
namespace App\Controller\Api;

use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SkillController
 * @package App\Controller\Api
 * @Route("/api/skills")
 */
class SkillController extends AbstractApiController {

    public function __toString()
    {
        return __CLASS__;
    }

    /**
     * @Route("/", name="get_skills", methods={"GET", "POST"})
     */
    public function getSkills() {

        $skills = $this->getDoctrine()->getRepository('App:Skill')->findAll();

        $jsonContent = $this->serializer->serialize($skills, 'json', ['groups' => 'skills']);

        return $this->createResponse($jsonContent);

    }
}

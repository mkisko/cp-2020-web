<?php
namespace App\Controller\Api;

use App\Entity\Vacancy;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/vacancy")
 */
class VacancyController extends AbstractApiController {

    public function __toString()
    {
        return __CLASS__;
    }

    /**
     * @Route("/vac", name="get_vac", methods={"GET"})
     */
     public function getVac(){

        $vacancies = $this->getDoctrine()->getRepository(Vacancy::class)->findAll();

        $jsonContent = $this->serializer->serialize($vacancies, 'json', ['groups' => 'vacancies']);

        return $this->createResponse($jsonContent);
}
    /**
     * @Route("/", name="get_vacancies", methods={"GET"})
     */
    public function getVacancies()
    {
        $vacancies = $this->getDoctrine()->getRepository(Vacancy::class)->findAll();

        $values = [];

        foreach ($vacancies as $vacancy) {
            $value["id"] = $vacancy->getId();
            $value["title"] = $vacancy->getTitle();
            $value["description"] = $vacancy->getDescription();
            foreach ($vacancy->getSkills() as $skill) {
                $val["id"] = $skill->getId();
                $val["title"] = $skill->getTitle();
                $value["skills"][] = $val;
            }
            $value["company"]["id"] = $vacancy->getCompany()->getId();
            $value["company"]["title"] = $vacancy->getCompany()->getTitle();
            $value["company"]["description"] = $vacancy->getCompany()->getDescription();
            $value["minCost"] = $vacancy->getMinCost();
            $value["maxCost"] = $vacancy->getMaxCost();
            $value["typeIntern"] = $vacancy->getTypeIntern();
            $value["user"]["id"] = $vacancy->getUser()->getId();
            $value["user"]["email"] = $vacancy->getUser()->getEmail();

            $value["expired"] = $vacancy->getExpired();
            $value["publichedAt"] = $vacancy->getPublichedAt();
            $value["conditions"] = $vacancy->getConditions();
            $value["city"] = $vacancy->getCity();


            $values[] = $value;
        }



        $jsonContent = $this->serializer->serialize($values, 'json');

        return $this->createResponse($jsonContent);
    }
}

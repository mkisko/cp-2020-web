<?php
namespace App\Controller\Api;

use App\Entity\Company;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController
 * @package App\Controller\Api
 * @Route("/api/company")
 */
class CompanyController extends AbstractApiController {

    /**
     * @Route("/", name="get_company", methods={"GET"})
     */
    public function getCompanies() {

        $companies = $this->getDoctrine()->getRepository(Company::class)->findAll();

        $values = [];

        foreach ($companies as $company) {
            $value["id"] = $company->getId();
            $value["title"] = $company->getTitle();
            $value["description"] = $company->getDescription();
            $value["type"] = $company->getType();

            $value["manager"]["id"] = $company->getManager()->getId();
            $value["manager"]["id"] = $company->getManager()->getEmail();
            foreach ($company->getVacancies() as $vacancy) {
                    $val["id"] = $vacancy->getId();
                    $val["title"] = $vacancy->getTitle();
                    $val["description"] = $vacancy->getDescription();
                    foreach ($vacancy->getSkills() as $skill) {
                        $val2["id"] = $skill->getId();
                        $val2["title"] = $skill->getTitle();
                        $val["skills"][] = $val2;
                    }
                    $val["minCost"] = $vacancy->getMinCost();
                    $val["maxCost"] = $vacancy->getMaxCost();
                    $val["typeIntern"] = $vacancy->getTypeIntern();
                    $val["user"]["id"] = $vacancy->getUser()->getId();
                    $val["user"]["email"] = $vacancy->getUser()->getEmail();

                    $val["expired"] = $vacancy->getExpired();
                    $val["publichedAt"] = $vacancy->getPublichedAt();
                    $val["conditions"] = $vacancy->getConditions();
                    $val["city"] = $vacancy->getCity();

                    $value["vacancies"][] = $val;
                }

            $values[] = $value;
        }

       $jsonContent = $this->serializer->serialize($values, 'json');

        return $this->createResponse($jsonContent);
    }
}

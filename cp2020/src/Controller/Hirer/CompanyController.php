<?php
namespace App\Controller\Hirer;

use App\Entity\Company;
use App\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CompanyController
 * @package App\Controller\Hirer
 * @Route("/hirer/company")
 */
class CompanyController extends AbstractController {

    /**
     * @Route("/check_profile", name="check_profile", methods={"GET", "POST"})
     */
    public function checkProfile() {

        $user = $this->getUser();

        $company = $this->getDoctrine()->getRepository(Company::class)->findOneBy(['manager' => $user]);

        if($company) {
          return $this->redirectToRoute('hirer_show_profile', [ 'id' => $company->getId()]);
        }
        return $this->redirectToRoute('hirer_create_profile');
    }
    /**
     * @Route("/new", name="hirer_create_profile", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $user = $this->getUser();

        $existCompany = $this->getDoctrine()->getRepository(Company::class)->findOneBy(['manager' => $user]);

        if ($existCompany) {
            return $this->redirectToRoute('hirer_show_profile', [ 'id' => $existCompany->getId()]);
        }

        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setManager($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            return $this->redirectToRoute('hirer_show_profile', [ 'id' => $company->getId()]);
        }

        return $this->render('hirer/company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hirer_show_profile", methods={"GET"})
     * @param Company $company
     * @return Response
     */
    public function show(Company $company): Response
    {
        return $this->render('hirer/company/show.html.twig', [
            'company' => $company,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hirer_edit_profile", methods={"GET","POST"})
     * @param Request $request
     * @param Company $company
     * @return Response
     */
    public function edit(int $id, Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hirer_show_profile', ['id' => $id]);
        }

        return $this->render('hirer/company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Vacancy;
use App\Form\VacancyType;
use App\Repository\VacancyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/vacancy")
 */
class VacancyController extends AbstractController
{
    /**
     * @Route("/", name="vacancy_index", methods={"GET"})
     * @param VacancyRepository $vacancyRepository
     * @return Response
     */
    public function index(VacancyRepository $vacancyRepository): Response
    {
        return $this->render('admin/vacancy/index.html.twig', [
            'vacancies' => $vacancyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vacancy_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $vacancy = new Vacancy();
        $form = $this->createForm(VacancyType::class, $vacancy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vacancy);
            $entityManager->flush();

            return $this->redirectToRoute('vacancy_index');
        }

        return $this->render('admin/vacancy/new.html.twig', [
            'vacancy' => $vacancy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vacancy_show", methods={"GET"})
     * @param Vacancy $vacancy
     * @return Response
     */
    public function show(Vacancy $vacancy): Response
    {
        return $this->render('admin/vacancy/show.html.twig', [
            'vacancy' => $vacancy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vacancy_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Vacancy $vacancy
     * @return Response
     */
    public function edit(Request $request, Vacancy $vacancy): Response
    {
        $form = $this->createForm(VacancyType::class, $vacancy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vacancy_index');
        }

        return $this->render('admin/vacancy/edit.html.twig', [
            'vacancy' => $vacancy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vacancy_delete", methods={"DELETE"})
     * @param Request $request
     * @param Vacancy $vacancy
     * @return Response
     */
    public function delete(Request $request, Vacancy $vacancy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacancy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vacancy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vacancy_index');
    }
}

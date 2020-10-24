<?php

namespace App\Controller\Admin;

use App\Entity\UserEducation;
use App\Form\UserEducationType;
use App\Repository\UserEducationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/user/education")
 */
class UserEducationController extends AbstractController
{
    /**
     * @Route("/", name="user_education_index", methods={"GET"})
     * @param UserEducationRepository $userEducationRepository
     * @return Response
     */
    public function index(UserEducationRepository $userEducationRepository): Response
    {
        return $this->render('admin/user_education/index.html.twig', [
            'user_educations' => $userEducationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_education_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $userEducation = new UserEducation();
        $form = $this->createForm(UserEducationType::class, $userEducation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userEducation);
            $entityManager->flush();

            return $this->redirectToRoute('user_education_index');
        }

        return $this->render('admin/user_education/new.html.twig', [
            'user_education' => $userEducation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_education_show", methods={"GET"})
     * @param UserEducation $userEducation
     * @return Response
     */
    public function show(UserEducation $userEducation): Response
    {
        return $this->render('admin/user_education/show.html.twig', [
            'user_education' => $userEducation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_education_edit", methods={"GET","POST"})
     * @param Request $request
     * @param UserEducation $userEducation
     * @return Response
     */
    public function edit(Request $request, UserEducation $userEducation): Response
    {
        $form = $this->createForm(UserEducationType::class, $userEducation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_education_index');
        }

        return $this->render('admin/user_education/edit.html.twig', [
            'user_education' => $userEducation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_education_delete", methods={"DELETE"})
     * @param Request $request
     * @param UserEducation $userEducation
     * @return Response
     */
    public function delete(Request $request, UserEducation $userEducation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userEducation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userEducation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_education_index');
    }
}

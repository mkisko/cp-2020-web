<?php

namespace App\Controller\Admin;

use App\Entity\UserStageProgress;
use App\Form\UserStageProgressType;
use App\Repository\UserStageProgressRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/progress")
 */
class UserStageProgressController extends AbstractController
{
    /**
     * @Route("/", name="user_stage_progress_index", methods={"GET"})
     * @param UserStageProgressRepository $userStageProgressRepository
     * @return Response
     */
    public function index(UserStageProgressRepository $userStageProgressRepository): Response
    {
        return $this->render('admin/user_stage_progress/index.html.twig', [
            'user_stage_progresses' => $userStageProgressRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="user_stage_progress_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $userStageProgress = new UserStageProgress();
        $form = $this->createForm(UserStageProgressType::class, $userStageProgress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userStageProgress);
            $entityManager->flush();

            return $this->redirectToRoute('user_stage_progress_index');
        }

        return $this->render('admin/user_stage_progress/new.html.twig', [
            'user_stage_progress' => $userStageProgress,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_stage_progress_show", methods={"GET"})
     * @param UserStageProgress $userStageProgress
     * @return Response
     */
    public function show(UserStageProgress $userStageProgress): Response
    {
        return $this->render('admin/user_stage_progress/show.html.twig', [
            'user_stage_progress' => $userStageProgress,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_stage_progress_edit", methods={"GET","POST"})
     * @param Request $request
     * @param UserStageProgress $userStageProgress
     * @return Response
     */
    public function edit(Request $request, UserStageProgress $userStageProgress): Response
    {
        $form = $this->createForm(UserStageProgressType::class, $userStageProgress);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_stage_progress_index');
        }

        return $this->render('admin/user_stage_progress/edit.html.twig', [
            'user_stage_progress' => $userStageProgress,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_stage_progress_delete", methods={"DELETE"})
     * @param Request $request
     * @param UserStageProgress $userStageProgress
     * @return Response
     */
    public function delete(Request $request, UserStageProgress $userStageProgress): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userStageProgress->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userStageProgress);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_stage_progress_index');
    }
}

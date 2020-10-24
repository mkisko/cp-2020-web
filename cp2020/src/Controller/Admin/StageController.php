<?php

namespace App\Controller\Admin;

use App\Entity\Stage;
use App\Form\StageType;
use App\Repository\StageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/stage")
 */
class StageController extends AbstractController
{
    /**
     * @Route("/", name="stage_index", methods={"GET"})
     * @param StageRepository $stageRepository
     * @return Response
     */
    public function index(StageRepository $stageRepository): Response
    {
        return $this->render('admin/stage/index.html.twig', [
            'stages' => $stageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="stage_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $stage = new Stage();
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($stage);
            $entityManager->flush();

            return $this->redirectToRoute('stage_index');
        }

        return $this->render('admin/stage/new.html.twig', [
            'stage' => $stage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stage_show", methods={"GET"})
     * @param Stage $stage
     * @return Response
     */
    public function show(Stage $stage): Response
    {
        return $this->render('admin/stage/show.html.twig', [
            'stage' => $stage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="stage_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Stage $stage
     * @return Response
     */
    public function edit(Request $request, Stage $stage): Response
    {
        $form = $this->createForm(StageType::class, $stage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('stage_index');
        }

        return $this->render('admin/stage/edit.html.twig', [
            'stage' => $stage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="stage_delete", methods={"DELETE"})
     * @param Request $request
     * @param Stage $stage
     * @return Response
     */
    public function delete(Request $request, Stage $stage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$stage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('stage_index');
    }
}

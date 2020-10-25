<?php
namespace App\Controller\Hirer;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ResumeController
 * @package App\Controller\Hirer
 * @Route("/hirer/resume")
 */
class ResumeController extends AbstractController {

    /**
     * @Route("/", name="resume_list", methods={"GET", "POST"})
     * @return Response
     */
    public function index() {
        // remove it for static html
        // $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        return $this->render('hirer/resume/index.html.twig', [
            // 'users' => $users
        ]);
    }

    /**
     * @Route("/{id}", name="resume_show", methods={"GET", "POST"})
     * @param $id
     * @return Response
     */
    public function show($id) {
        // remove it for static html
        // $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('hirer/resume/show.html.twig', [
            // 'user' => $user
        ]);
    }

}

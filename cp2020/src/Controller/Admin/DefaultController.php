<?php
namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller\Admin
 * @Route("/admin")
 */
class DefaultController extends AbstractController {

    /**
     * @Route("/", name="admin_index")
     */
    public function index() {
        return $this->redirectToRoute('skill_index');
    }

}

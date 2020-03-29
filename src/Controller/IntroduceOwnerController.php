<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IntroduceOwnerController extends AbstractController
{
    /**
     * @Route("/introduce/owner", name="introduce_owner")
     */
    public function index()
    {
        return $this->render('introduce_owner/index.html.twig', [
            'controller_name' => 'IntroduceOwnerController',
        ]);
    }
}

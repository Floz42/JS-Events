<?php

namespace App\Controller\admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DeliveriesController extends AbstractController
{
    /**
     * @Route("/deliveries", name="deliveries")
     */
    public function index()
    {
        return $this->render('deliveries/index.html.twig', [
            'controller_name' => 'DeliveriesController',
        ]);
    }
}

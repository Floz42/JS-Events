<?php

namespace App\Controller;

use App\Repository\ImageRepository;
use App\Repository\ImageSliderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * The homepage of website 
     * 
     * @Route("/", name="accueil")
     */
    public function index(ImageSliderRepository $repo)
    {
        $images = $repo->findAll();

        return $this->render('base.html.twig', [
            'images' => $images
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\IntroduceOwner;
use App\Repository\ImageSliderRepository;
use App\Repository\IntroduceOwnerRepository;
use App\Repository\IntroduceRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * The homepage of website 
     * 
     * @Route("/", name="accueil")
     */
    public function index(ImageSliderRepository $sliderRepo, IntroduceRepository $introduceRepo, IntroduceOwnerRepository $introduceOwnerRepo, NewsRepository $newsRepo)
    {
        $slider_images = $sliderRepo->findAll();
        $introduceOwner = $introduceOwnerRepo->find(5);
        $news = $newsRepo->findAll();

        return $this->render('base.html.twig', [
            'images' => $slider_images,
            'introduceOwner' => $introduceOwner,
            'news' => $news
        ]);
    }

    /**
     * The introduction of website
     * 
     * @Route("/introduce", name="introduce")
     */
    public function introduce(IntroduceRepository $repo)
    {
        $introduce = $repo->find(1);

        return $this->render('partials/introduce.html.twig', [
            'introduce' => $introduce
        ]);
    }
}

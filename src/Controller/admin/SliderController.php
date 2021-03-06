<?php

namespace App\Controller\admin;

use App\Entity\ImageSlider;
use App\Form\SliderType;
use App\Repository\ImageSliderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SliderController extends AbstractController
{
    /**
     * @Route("/admin/slider", name="slider_show")
     */
    public function index(ImageSliderRepository $repo)
    {
        $images = $repo->findAll();
        return $this->render('admin/slider/index.html.twig', [
            'images' => $images
        ]);
    }
    
    /**
     * addImage -> add or modify picture for the slider.
     *
     * @Route("/admin/slider/add", name="slider_add")
     * @Route("/admin/slider/update/{id}", name="slider_update")
     */
    public function addImage(Request $request, EntityManagerInterface $manager, ImageSlider $image = null)
    {
        $exist = true;
        $message = "Votre image a bien été modifiée.";
        if (!$image) {
            $exist = false;
            $image = new ImageSlider();
            $message = "Votre image a bien été ajoutée.";
        }

        $form = $this->createForm(SliderType::class, $image);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($image);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('slider_show');
        }

        return $this->render('admin/slider/addImage.html.twig',[
            'form' => $form->createView(),
            'exist' => $exist
        ]);
    }

    /**
     * @Route("/admin/slider/delete/{id}", name="slider_delete")
     */
    public function deleteImage(EntityManagerInterface $manager, ImageSlider $image)
    {
        $manager->remove($image);
        $manager->flush();
        $this->addFlash('success','Votre image a bien été supprimée du slider.');
        return $this->redirectToRoute('slider_show');
    }
}

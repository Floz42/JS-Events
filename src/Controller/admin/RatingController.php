<?php

namespace App\Controller\admin;

use App\Entity\Rating;
use App\Repository\RatingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RatingController extends AbstractController
{
    /**
     * @Route("/admin/ratings", name="ratings_show")
     */
    public function index(RatingRepository $repo, EntityManagerInterface $manager, Request $request)
    {
        $ratings = $repo->findBy([], ['id' => 'DESC']);
        return $this->render('admin/rating/index.html.twig', [
            'ratings' => $ratings
        ]);
    }
    
    /**
     * @Route("/admin/ratings/delete/{id}", name="rating_delete")
     */
    public function deleteRating(EntityManagerInterface $manager, Rating $rating)
    {
        $manager->remove($rating);
        $manager->flush();
        $this->addFlash('success',"L'avis a été supprimé avec succès.");
        return $this->redirectToRoute('ratings_show');
    }
}

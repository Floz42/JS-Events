<?php

namespace App\Controller;

use Swift_Mailer;
use App\Entity\Rating;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Form\PostRatingType;
use App\Repository\NewsRepository;
use App\Repository\RatingRepository;
use App\Repository\DeliveryRepository;
use App\Repository\IntroduceRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ImageSliderRepository;
use App\Repository\IntroduceOwnerRepository;
use App\Service\StatsService;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    public function __construct()
    {
        if (!isset($_COOKIE['visited'])) {
            $visited = setcookie('visited', 'visitedLastHour', time() + 60*60, null, null, false, true);
        }
        if (!isset($_COOKIE['visitedUnique'])) {
            $visitedH = setcookie('visitedUnique', 'visitedLastYear', time() + 31536000, null, null, false, true);
        }
    }
    /**
     * The homepage of website 
     * 
     * @Route("/", name="accueil")
     */
    public function index(ImageSliderRepository $sliderRepo, IntroduceOwnerRepository $introduceOwnerRepo, NewsRepository $newsRepo, DeliveryRepository $deliveryRepo,
                          Swift_Mailer $mailer, Request $request, RatingRepository $ratingRepo, EntityManagerInterface $manager, StatsService $stats)
    {
        $slider_images = $sliderRepo->findAll();
        $introduceOwner = $introduceOwnerRepo->find(3);
        $news = $newsRepo->findBy([], ['id' => 'DESC']);
        $deliveries = $deliveryRepo->findAll();
        $ratings = $ratingRepo->findBy([], ['id' => 'DESC']);
        $visitor = $stats->addVisitor("visited","counterVisitors");
        $uniqueVisitor = $stats->addVisitor("visitedUnique","counterUniqueVisitors");

        $rating = new Rating();
        $form_rating = $this->createForm(PostRatingType::class, $rating);
        $form_rating->handleRequest($request);
        if ($form_rating->isSubmitted() && $form_rating->isValid()) {
            $manager->persist($rating);
            $manager->flush();
            $this->addFlash('success', 'Merci, votre avis à été posté avec succès.');
            return $this->redirectToRoute('accueil');
        } 

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $message = (new \Swift_Message())
                ->setSubject('Nouveau message de ton site !!')
                ->setFrom($data->getEmail())
                ->setTo('flo.carreclub@gmail.com')
                ->setContentType("text/html")
                ->setBody(
                    '<html>' . 
                        '<body>' . 
                            'Nouveau message de : '. $data->getFirstname() . ' ' . $data->getLastname() . '<br>' .
                            'Son e-mail : '. $data->getEmail() . '<br>' .
                            'Titre du message : ' . $data->getTitle() . '<br>' .
                            'Contenu du message : ' . $data->getContent() . '<br>' .
                        '</body>' . 
                    '</html>' 
                );
            $mailer->send($message);
            $this->addFlash('success', 'Votre message a été envoyé avec succès !');
        }

        return $this->render('base.html.twig', [
            'images' => $slider_images,
            'introduceOwner' => $introduceOwner,
            'news' => $news,
            'deliveries' => $deliveries,
            'ratings' => $ratings,
            'form' => $form->createView(),
            'form_rating' => $form_rating->createView(),
        ]);
    }
}

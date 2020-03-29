<?php

namespace App\Controller\admin;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/admin/news", name="news_show")
     */
    public function index(NewsRepository $repo)
    {
        $news = $repo->findBy([], ["id" => "DESC"]);
        return $this->render('admin/news/index.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @Route("/admin/news/add", name="news_add")
     * @Route("/admin/news/update/{id}", name="news_update")
     */
    public function addNews(Request $request, News $news = null, EntityManagerInterface $manager)
    {
        $exist = true;
        $message = "Votre news a bien été modifiée.";
        if (!$news) {
            $exist = false;
            $news = new News();
            $message = "Votre news a bien été ajoutée.";
        }
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($news);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('news_show');
        }

        return $this->render('admin/news/addNews.html.twig', [
            'form' => $form->createView(),
            'exist' => $exist
        ]);
    }

    /**
     * @Route("/admin/news/delete/{id}", name="news_delete")
     */
    public function deleteNews(EntityManagerInterface $manager, News $news)
    {
        $manager->remove($news);
        $manager->flush();
        $this->addFlash('success', "Votre news a bien été supprimée.");
        return $this->redirectToRoute('news_show');
    }
}

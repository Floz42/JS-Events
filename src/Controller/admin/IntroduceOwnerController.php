<?php

namespace App\Controller\admin;

use App\Entity\IntroduceOwner;
use App\Form\IntroduceOwnerType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\IntroduceOwnerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IntroduceOwnerController extends AbstractController
{
    /**
     * @Route("/admin/introduce_owner", name="introduce_owner_show")
     */
    public function index(IntroduceOwnerRepository $repo)
    {
        $owner = $repo->findBy(['lastname' => 'Patry']);
        
        return $this->render('admin/introduce_owner/index.html.twig', [
            'owner' => $owner[0],
        ]);
    }

    /**
     * @Route("/admin/introduce_owner/update/{id}", name="update_introduce_owner")
     */
    public function updateInfos(Request $request, IntroduceOwner $owner = null, EntityManagerInterface $manager)
    {
        
        $form = $this->createForm(IntroduceOwnerType::class, $owner);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($owner);
            $manager->flush();
            $this->addFlash('success',"Vos informations ont été modifiées avec succès");
            return $this->redirectToRoute('introduce_owner_show');
        }

        return $this->render('admin/introduce_owner/update_introduce_owner.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

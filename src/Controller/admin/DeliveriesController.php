<?php

namespace App\Controller\admin;

use App\Entity\Delivery;
use App\Form\DeliveryType;
use App\Repository\DeliveryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeliveriesController extends AbstractController
{
    /**
     * @Route("/admin/deliveries", name="deliveries_show")
     */
    public function index(DeliveryRepository $repo)
    {
        $deliveries = $repo->findAll();

        return $this->render('admin/deliveries/index.html.twig', [
            'deliveries' => $deliveries
        ]);
    }

    /**
     * @Route("/admin/deliveries/delete/{id}", name="deliveries_delete")
     */
    public function deleteDelivery(Delivery $delivery, EntityManagerInterface $manager)
    {
        $manager->remove($delivery);
        $manager->flush();
        $this->addFlash('success', "Votre prestation a bien été supprimée de la liste.");
        return $this->redirectToRoute('deliveries_show');
    }

    /**
     * @Route("/admin/deliveries/add", name="delivery_add")
     * @Route("/admin/deliveries/update/{id}", name="delivery_update" )
     */
    public function addDelivery(Request $request, EntityManagerInterface $manager, Delivery $delivery = null)
    {
        $exist = true;
        $message = "Votre prestation a bien été modifiée.";
        if (!$delivery) {
            $exsit = false;
            $delivery = new Delivery();
            $message = "Votre prestation a bien été ajoutée.";
        }

        $form = $this->createForm(DeliveryType::class, $delivery);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            foreach($delivery->getOptionDeliveries() as $option) {
                $option->setDelivery($delivery);
                $manager->persist($option);
            }

            $manager->persist($delivery);
            $manager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('deliveries_show');
        }

        return $this->render('admin/deliveries/addDelivery.html.twig', [
            'form' => $form->createView(),
            'exist' => $exist
        ]);
    }
}

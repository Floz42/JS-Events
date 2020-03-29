<?php

namespace App\Controller\admin;

use App\Repository\StatsRepository;
use App\Service\StatsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin", name="dashboard")
     */
    public function index(StatsService $statsDashboard)
    {
        $stats = $statsDashboard->getStats();
        return $this->render('/admin/dashboard/index.html.twig', [
            'stats' => $stats
        ]);
    }
}

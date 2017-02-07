<?php

namespace AppBundle\Controller;

use AppBundle\Service\GoldRushService;
use ClassesWithParents\D;
use DateTime;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $goldRushService = $this->getGoldRushService();

        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
            'investment_data' => $goldRushService->getInvestmentData(new DateTime())
        ]);
    }

    /**
     * @return GoldRushService
     */
    private function getGoldRushService()
    {
        return $this->container->get('app.gold_rush_service');
    }


}

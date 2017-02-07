<?php

namespace AppBundle\Controller;

use AppBundle\Controller\LoggerElasticTrait;
use AppBundle\Controller\LoggerTextTrait;
use AppBundle\Service\GoldRushService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    use LoggerTextTrait, LoggerElasticTrait {
        LoggerTextTrait::log insteadof LoggerElasticTrait;
        LoggerElasticTrait::log insteadof LoggerTextTrait;

        LoggerTextTrait::log as textLog;
        LoggerElasticTrait::log as esLog;
    }

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
            'investment_data' => $goldRushService->getInvestmentData(new DateTime()),
            'textLog' => $this->textLog(),
            'esLog' => $this->esLog()
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

<?php
/**
 * Created by PhpStorm.
 * User: lekha
 * Date: 27.07.2019
 * Time: 17:53
 */

namespace App\Controller;

use App\Entity\Transporters;
use App\Repository\AirportsRepository;
use App\Repository\ShedulesRepository;
use App\Repository\TransportersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function __construct(AirportsRepository $airportsRepository)
    {
        $this->airportsRepository = $airportsRepository;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $airports = $this->airportsRepository->findAll();
        return $this->render('index/index.html.twig',[
            'airports' => $airports
        ]);
    }
}

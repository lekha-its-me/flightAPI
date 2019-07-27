<?php
/**
 * Created by PhpStorm.
 * User: lekha
 * Date: 27.07.2019
 * Time: 17:53
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return $this->render('index/index.html.twig');
    }
}

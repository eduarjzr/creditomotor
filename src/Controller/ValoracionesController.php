<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ValoracionesController extends AbstractController
{
    /**
     * @Route("/valoraciones", name="valoraciones")
     */
    public function index()
    {
        return $this->render('valoraciones/index.html.twig', [
            'controller_name' => 'ValoracionesController',
        ]);
    }
}

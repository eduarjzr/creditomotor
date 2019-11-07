<?php

namespace App\Controller;

use App\Service\actualizarMarcas;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DbManagerController extends AbstractController
{
    /**
     * @var actualizarMarcas
     */
    private $actualizarMarcas;

    /**
     * @param actualizarMarcas $billing
     */
    public function __construct(actualizarMarcas $actualizarMarcas)
    {
        $this->actualizarMarcas = $actualizarMarcas;
    }


    /**
     * @Route("/db/manager", name="db_manager.")
     */
    public function index()
    {
        return $this->render('db_manager/index.html.twig', [
            'controller_name' => 'DbManagerController',
        ]);
    }

    /**
     * @Route("/db/manager/update", name="db_update")
     */
    public function updateDB(EntityManagerInterface $entityManager)
    {
        $this->actualizarMarcas->doTheJob();
        //$this->actualizarMarcas->getMarcasFromSource();
        //$this->actualizarMarcas->createYearsDB();
        //$this->actualizarMarcas->getCombustiblesFromSource();die;
    }
}

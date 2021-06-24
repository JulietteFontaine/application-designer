<?php

namespace App\Controller;

use App\Repository\FurnitureRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FurnitureListController extends AbstractController
{

    private $repository;

    public function __construct(FurnitureRepository $furnitureRepository)
    {
        $this->repository = $furnitureRepository;
    }

    /** 
     * @Route("/meubles", name="list_furniture")
     */
    public function showListController()
    {

        $furnitures = $this->repository->findAll();

        // $array_e = [];
        // $array_a = [];

        // foreach ($furnitures as $f) {
        //     $types = $f->getType();
        //     if ($types == "etagère") {

        //     } else {

        //     }
        // }

        return $this->render("Furnitures/FurnitureList.html.twig", [
            'furnitures' => $furnitures
        ]);
    }
}

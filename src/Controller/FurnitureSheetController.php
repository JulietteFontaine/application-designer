<?php

namespace App\Controller;

use App\Repository\FurnitureRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FurnitureSheetController extends AbstractController
{

    private $repository;

    public function __construct(FurnitureRepository $furnitureRepository)
    {
        $this->repository = $furnitureRepository;
    }

    /** 
     * @Route("/meuble/{id}", name="furniture_sheet")
     */
    public function showMaterialSheet($id)
    {
        $furniture = $this->repository->find($id);

        return $this->render("Furnitures/FurnitureSheet.html.twig", [
            'furniture' => $furniture
        ]);
    }
}

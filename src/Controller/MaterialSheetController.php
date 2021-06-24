<?php

namespace App\Controller;

use App\Repository\MaterialRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaterialSheetController extends AbstractController
{

    private $repository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->repository = $materialRepository;
    }

    /** 
     * @Route("/materiel/{id}", name="material_sheet")
     */
    public function showMaterialSheet($id)
    {
        $material = $this->repository->find($id);

        return $this->render("Materials/MaterialSheet.html.twig", [
            'material' => $material
        ]);
    }
}
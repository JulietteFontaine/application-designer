<?php

namespace App\Controller;

use App\Repository\FurnitureRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** 
 * @Route("/admin")
 */
class FurnitureListController extends AbstractController
{

    private $repository;

    public function __construct(FurnitureRepository $furnitureRepository, UserRepository $userRepository)
    {
        $this->repository = $furnitureRepository;
        $this->user = $userRepository;
    }

    /** 
     * @Route("/meubles", name="list_furniture")
     */
    public function showListController()
    {

        $user = $this->getUser();
        $furnitures = $user->getFurnitures();

        return $this->render("Furnitures/FurnitureList.html.twig", [
            'furnitures' => $furnitures
        ]);
    }
}
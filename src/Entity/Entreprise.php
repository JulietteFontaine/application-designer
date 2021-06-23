<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public $nom;

    // /**
    //  * @ORM\Column(type="string", length=255)
    //  */
    // public $type_matieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="entreprise")
     */
    public $matieres;

}
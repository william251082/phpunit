<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class Enclosure
{
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Entity\Enclosure", mappedBy="enclosure", cascade={"persist"})
     */
    private $dinosaurs;

    public function __construct()
    {
        $this->dinosaurs = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getDinosaurs(): Collection
    {
        return $this->dinosaurs;
    }

    public function addDinosaur(Dinosaur $dinosaur)
    {
        $this->dinosaurs[] = $dinosaur;
    }

}

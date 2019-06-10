<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dinosaurs")
 */
class Dinosaur
{
    const LARGE = 20;

    const HUGE = 30;

    /**
     * @ORM\Column(type="integer")
     */
    private $length = 0;

    /**
     * @var string
     */
    private $genus;

    /**
     * @var bool
     */
    private $isCarnivorous;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Enclosure", inversedBy="dinosaurs")
     */
    private $enclosure;

    public function __construct(string $genus = 'unknown', bool $isCarnivorous)
    {
        $this->genus = $genus;
        $this->isCarnivorous = $isCarnivorous;
    }

    /**
     * @return mixed
     */
    public function getLength(): int
    {
        return $this->length;
    }

    /**
     * @param mixed $length
     */
    public function setLength($length)
    {
        $this->length = $length;
    }

    public function getSpecification(): string
    {
        return sprintf(
            'The %s %scarnivorous dinosaur is %d meters long',
            $this->genus,
            $this->isCarnivorous ? '' : 'non-',
            $this->length
        );
    }

    /**
     * @return string
     */
    public function getGenus(): string
    {
        return $this->genus;
    }

    /**
     * @return bool
     */
    public function isCarnivorous(): bool
    {
        return $this->isCarnivorous;
    }
}

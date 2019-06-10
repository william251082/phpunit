<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Exception\DinosaursAreRunningRampantExceptions;
use AppBundle\Exception\NotABuffetException;
use PHPUnit\Framework\TestCase;

class EnclosureTest extends TestCase
{
    public function testItHasNoDinosaursByDefault()
    {
        $enclosure = new Enclosure();

        $this->assertEmpty( $enclosure->getDinosaurs());
    }

    public function testItAddsDinosaurs()
    {
        $enclosure = new Enclosure(true);

        $enclosure->addDinosaur(new Dinosaur('dino1', true));
        $enclosure->addDinosaur(new Dinosaur('dino2', true));

        $this->assertCount(2, $enclosure->getDinosaurs());
    }

    public function testItDoesNotAllowCarnivorousDinosaursToMixWithHerbivores()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur('dino1', false));

        $this->expectException(NotABuffetException::class);

        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    }

    /**
     * @expectedException NotABuffetException
     */
    public function testItDoesNotAllowToAddNonCarnivorousDinosaursToMixWithCarnivores()
    {
        $enclosure = new Enclosure(true);
        $enclosure->addDinosaur(new Dinosaur('dino1', false));
        $enclosure->addDinosaur(new Dinosaur('dino2', false));

        $this->expectException(NotABuffetException::class);

        $enclosure->addDinosaur(new Dinosaur('Velociraptor', true));
    }

    /**
     * @expectedException DinosaursAreRunningRampantExceptions
     */
    public function testItDoesNotAllowToAddDinosaurToUnsecureEnclosure()
    {
        $enclosure = new Enclosure();

        $this->expectException(DinosaursAreRunningRampantExceptions::class);
        $this->expectExceptionMessage('Are you crazy?');

        $enclosure->addDinosaur(new Dinosaur('Velociraptor', false));
    }
}

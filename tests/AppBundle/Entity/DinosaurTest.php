<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Dinosaur;
use PHPUnit\Framework\TestCase;

class DinosaurTest extends TestCase
{
    public function testSettingLength()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);

        $this->assertSame(0, $dinosaur->getLength());

        $dinosaur->setLength(9);
        $this->assertSame(9, $dinosaur->getLength());
    }

    public function testDinosaurHasNotShrunk()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);
        $dinosaur->setLength(15);

        $this->assertGreaterThan(14, $dinosaur->getLength(), 'Why did this dinosaur shrunk?');
    }

    public function testsReturnsFullSpecificationOfDinosaur()
    {
        $dinosaur = new Dinosaur('unknown', false);

        $this->assertSame(
            'The unknown non-carnivorous dinosaur is 0 meters long',
            $dinosaur->getSpecification()
        );
    }

    public function testsReturnsFullSpecificationsForTyrannosaurus()
    {
        $dinosaur = new Dinosaur('Tyrannosaurus', true);

        $dinosaur->setLength(15);
        $this->assertSame(
            'The Tyrannosaurus carnivorous dinosaur is 15 meters long',
            $dinosaur->getSpecification()
        );
    }
}

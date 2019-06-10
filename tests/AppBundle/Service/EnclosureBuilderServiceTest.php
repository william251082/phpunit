<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Factory\DinosaurFactory;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class EnclosureBuilderServiceTest extends TestCase
{
    public function testItBuildsAndPersistsEnclosure()
    {
        $manager = $this->createMock(EntityManagerInterface::class);

        $manager->expects($this->once())
            ->method('persist')
            ->with($this->isInstanceOf(Enclosure::class));

        $manager->expects($this->atLeastOnce())
            ->method('flush');

        $dinoFactory = $this->createMock(DinosaurFactory::class);

        // parameter of method on the mocked class
        $dinoFactory->expects($this->exactly(2))
            ->method('growFromSpecification')
            ->willReturn(new Dinosaur())
            ->with($this->isType('string'));

        $builder = new EnclosureBuilderService($manager, $dinoFactory);
        $enclosure = $builder->buildEnclosure(1, 2);

        $this->assertCount(1, $enclosure->getSecurities());
        $this->assertCount(2, $enclosure->getDinosaurs());
//        var_dump($enclosure->getDinosaurs()->toArray());
    }
}

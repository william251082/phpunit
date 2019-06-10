<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;
use PHPUnit\Framework\TestCase;

class DinosaurLengthDeterminatorTest extends TestCase
{
    /**
     * @dataProvider getSpecLengthTests
     */
   public function testItReturnsCorrectLengthRange($spec, $minExpectedSize, $maxExpectedSize)
   {
        $determinator = new DinosaurLengthDeterminator();
        $actualSize = $determinator->getLengthFromSpecification($spec);

        $this->assertGreaterThanOrEqual($minExpectedSize, $actualSize);
        $this->assertLessThanOrEqual($maxExpectedSize, $actualSize);
   }

   public function getSpecLengthTests()
   {
       return [
           // specification min and max length
           ['large carnivorous dinosaur', Dinosaur::LARGE, Dinosaur::HUGE - 1],
           'default response' => ['give all cookies', 0, Dinosaur::LARGE - 1],
           ['large herbivores', Dinosaur::LARGE, Dinosaur::HUGE - 1],
           ['huge dinosaur', Dinosaur::HUGE, 100],
           ['huge dino', Dinosaur::HUGE, 100],
           ['huge', Dinosaur::HUGE, 100],
           ['omg', Dinosaur::HUGE, 100]
       ];
   }
}

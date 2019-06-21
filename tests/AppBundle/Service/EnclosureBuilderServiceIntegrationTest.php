<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Dinosaur;
use AppBundle\Entity\Enclosure;
use AppBundle\Entity\Security;
use AppBundle\Service\EnclosureBuilderService;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EnclosureBuilderServiceIntegrationTest extends KernelTestCase
{
    protected function setUp()
    {
        self::bootKernel();

        $this->truncateEntities();
    }

    public function testItBuildsEnclosureWithDefaultSpecification()
    {
        /** @var EnclosureBuilderService $enclosureBuilderService */
        $enclosureBuilderService = self::$kernel->getContainer()
            ->get('test.'.EnclosureBuilderService::class);

        $enclosureBuilderService->buildEnclosure();

        $manager = $this->getEntityManager();

        $count = (int) $manager->getRepository(Security::class)
            ->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $this->assertSame(1, $count, 'Amount of security systems are not the same');

        $count = (int) $manager->getRepository(Dinosaur::class)
            ->createQueryBuilder('s')
            ->select('COUNT(s.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $this->assertSame(3, $count, 'Amount of dinosaurs are not the same');
    }

    private function truncateEntities()
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->purge();
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager()
    {
         return self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
}

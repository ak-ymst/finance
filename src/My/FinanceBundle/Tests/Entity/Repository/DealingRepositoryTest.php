<?php

namespace My\FinanceBundle\Tests\Entity\Repository;

use \PHPunit_Framework_TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

use My\FinanceBundle\DataFixtures\ORM\DealingRepositoryTestData1;
use My\FinanceBundle\Entity\Repository\DealingRepository;


class DealingRepositoryTest extends WebTestCase {
    private $repos;

    public function setUp() {
        parent::setUp();
        
        $kernel = static::createKernel();
        $kernel->boot();
        $loader = new Loader($kernel->getContainer());
        $loader->addFixture(new DealingRepositoryTestData1());
        $fixtures = $loader->getFixtures();
        $em = $kernel->getContainer()->get('doctrine.orm.entity_manager');

        $purger = new ORMPurger($em);
        $purger->setPurgeMode(ORMPurger::PURGE_MODE_TRUNCATE);
        $executer = new ORMExecutor($em, $purger);
        $executer->execute($fixtures);

        $this->repos = $em->getRepository('MyFinanceBundle:Dealing');
        
    }
    
    public function testDealingCount() {
        $entities = $this->repos->findByDateBetween('2015-04-01', '2015-04-30');

        $this->assertEquals(2, count($entities), '4月中のリスト取得');
        
        $entities = $this->repos->findByDateBetween('2015-04-20', '2015-04-30');
        
        $this->assertEquals(1, count($entities), '4月20日以降のリスト取得');
    }
    
    public function testDealingOne() {
        $entities = $this->repos->findByDateBetween('2015-04-20', '2015-04-30');
        
        $this->assertEquals(1, count($entities), '4月20日以降のリスト取得');

        $entity = $entities[0];
        $this->assertEquals("クライアント２", $entity->getClient(), 'クライアントで比較');
        $this->assertEquals(2, $entity->getDealingTypeId(), '科目IDで比較');
        
        $this->assertEquals(2, $entity->getDealingType()->getId(), 'オブジェクト経由で科目IDで比較');
    }
}


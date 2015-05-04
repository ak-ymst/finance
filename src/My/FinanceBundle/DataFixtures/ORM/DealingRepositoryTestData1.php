<?php

namespace My\FinanceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use My\FinanceBundle\Entity\DealingType;
use My\FinanceBundle\Entity\Dealing;
use \DateTime;

class DealingRepositoryTestData1 implements FixtureInterface {

    public function load(ObjectManager $manager) {
        $types = array();
        
        $type = new DealingType();
        $type->setName('売上返品');
        $manager->persist($type);
        $types[$type->getName()] = $type;
        
        $type = new DealingType();
        $type->setName('仕入');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $dealing = new Dealing();
        $dealing->setDate(new DateTime('2015-04-16'));
        $dealing->setDealingType($types['売上返品']);
        $dealing->setDescription('返品');
        $dealing->setClient('クライアント１');
        $dealing->setAmount(100);
        $manager->persist($dealing);

        $dealing = new Dealing();
        $dealing->setDate(new DateTime('2015-04-23'));
        $dealing->setDealingType($types['仕入']);
        $dealing->setDescription('なにか仕入れた');
        $dealing->setClient('クライアント２');
        $dealing->setAmount(200);
        $manager->persist($dealing);
        
        $manager->flush();
    }
    
    public function getOrder() {
        return 1;
    }

}

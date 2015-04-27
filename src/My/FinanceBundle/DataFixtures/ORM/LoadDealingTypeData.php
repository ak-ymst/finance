<?php

namespace My\FinanceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use My\FinanceBundle\Entity\DealingType;

class LoadDealingType implements FixtureInterface {

    /**
     * {@inheritDoc}
     *
     */
    public function load(ObjectManager $manager) {
        
        $type = new DealingType();
        $type->setName('売上返品');
        $manager->persist($type);
        
        $type = new DealingType();
        $type->setName('仕入');
        $manager->persist($type);
        
        $type = new DealingType();
        $type->setName('仕入返品');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('給料賃金');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('外注工賃');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('地代家賃');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('租税公課');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('荷造運賃');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('水道光熱費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('旅費交通費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('通信費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('広告宣伝費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('接待交際費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('損害保険料');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('消耗品費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('税理士・弁護士報酬');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('雑費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('支払い手数料');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('新聞図書費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('車両費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('研修費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('会議費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('諸会費');
        $manager->persist($type);

        $type = new DealingType();
        $type->setName('固定資産');
        $manager->persist($type);

        
        $manager->flush();
    }
}



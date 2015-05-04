<?php

namespace My\FinanceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use My\FinanceBundle\Entity\DealingType;
use My\FinanceBundle\Entity\Dealing;
use \DateTime;

class LoadDealingType implements FixtureInterface {

    /**
     * {@inheritDoc}
     *
     */
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
        
        $type = new DealingType();
        $type->setName('仕入返品');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('給料賃金');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('外注工賃');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('地代家賃');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('租税公課');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('荷造運賃');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('水道光熱費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('旅費交通費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('通信費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('広告宣伝費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('接待交際費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('損害保険料');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('消耗品費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('税理士・弁護士報酬');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('雑費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('支払い手数料');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('新聞図書費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('車両費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('研修費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('会議費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('諸会費');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $type = new DealingType();
        $type->setName('固定資産');
        $manager->persist($type);
        $types[$type->getName()] = $type;

        $dealing = new Dealing();
        $dealing->setDate(new DateTime('2015-04-16'));
        $dealing->setDealingType($types['新聞図書費']);
        $dealing->setDescription('書籍代');
        $dealing->setClient('AMAZON');
        $dealing->setAmount(1512);
        $manager->persist($dealing);

        $dealing = new Dealing();
        $dealing->setDate(new DateTime('2015-04-23'));
        $dealing->setDealingType($types['通信費']);
        $dealing->setDescription('IIJ契約');
        $dealing->setClient('IIJN');
        $dealing->setAmount(1727);
        $manager->persist($dealing);

        $dealing = new Dealing();
        $dealing->setDate(new DateTime('2015-05-02'));
        $dealing->setDealingType($types['旅費交通費']);
        $dealing->setDescription('定期代');
        $dealing->setClient('JR東日本');
        $dealing->setAmount(6460);
        $manager->persist($dealing);

        $manager->flush();
    }
}



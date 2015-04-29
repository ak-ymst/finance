<?php

namespace My\FinanceBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DealingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DealingRepository extends EntityRepository {

    /**
     * 取引日の期間で指定して取引一覧を取得する関数
     *
     *
     * @param $from 期間開始日(YYYY-MM-DD)
     * @param $to 期間終了日(YYYY-MM-DD)
     * @return 取引一覧
     */
    public function findByDateBetween($from, $to) {
        $params = array();
        $params['from'] = $from;
        $params['to'] = $to;
        
        $query = $this->createQueryBuilder('p')
                      ->where('p.date >= :from ')
                      ->andWhere('p.date <= :to ')
                      ->setParameters($params)
                      ->getQuery();

        return $query->getResult();

    }
}

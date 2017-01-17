<?php

namespace BoosterBundle\Repository;

use Doctrine\ORM\EntityRepository;


class NeedsRepository extends EntityRepository
{

   public function findNeedsBytitle($motcle)
    {
        $query = $this->createQueryBuilder('n')
            ->where('n.title like :title')
            ->setParameter('title', $motcle.'%')
            ->orderBy('n.title', 'ASC')
            ->getQuery();

        return $query->getResult();
    }
}

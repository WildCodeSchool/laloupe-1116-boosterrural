<?php

namespace BoosterBundle\Repository;

use Doctrine\ORM\EntityRepository;


class NeedsRepository extends EntityRepository
{

   public function findNeedsBydescription($motcle)
    {
        $query = $this->createQueryBuilder('n')
            ->where('n.description like :description')
            ->orwhere('n.title like :title')
            ->orwhere('n.activity like :activity')
            ->orwhere('n.town like :town')
            ->setParameter('description', '%'.$motcle.'%')
            ->setParameter('title', '%'.$motcle.'%')
            ->setParameter('activity', '%'.$motcle.'%')
            ->setParameter('town', '%'.$motcle.'%')
            ->orderBy('n.description', 'ASC')
            ->getQuery();


        return $query->getResult();
    }
}

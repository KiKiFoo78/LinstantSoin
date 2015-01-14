<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class ProduitsRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT designation FROM ProductBundle:Produits designation ORDER BY designation.designation ASC'
            )
            ->getResult();
    }


    public function findArray($array)
    {
        $qb = $this->createQueryBuilder('u')
                ->Select('u')
                ->Where('u.id IN (:array)')
                ->setParameter('array', $array);
        return $qb->getQuery()->getResult();
    }
}
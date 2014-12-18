<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class CategorieServRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT intitule FROM ProductBundle:CategorieServ intitule ORDER BY intitule.intitule ASC'
            )
            ->getResult();
    }
}
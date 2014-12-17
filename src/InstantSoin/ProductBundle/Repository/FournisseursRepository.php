<?php

namespace InstantSoin\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository;


class FournisseursRepository extends EntityRepository
{
	public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT nom FROM ProductBundle:Fournisseurs nom ORDER BY nom.nom ASC'
            )
            ->getResult();
    }
}
<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EquipmentController extends Controller
{
    public function equipment_overallAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Equipment:Equipment_overall.html.twig', array('search' => $search->createView()));
    }

}

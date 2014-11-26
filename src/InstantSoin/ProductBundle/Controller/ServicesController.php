<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ServicesController extends Controller
{
    public function services_overallAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Services:Services_overall.html.twig', array('search' => $search->createView()));
    }

}

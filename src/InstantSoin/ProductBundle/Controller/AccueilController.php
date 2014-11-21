<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function accueilAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'livreSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'livreSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Accueil:accueil.html.twig', array('search' => $search->createView()));
    }
}

<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AccueilController extends Controller
{
    public function accueilAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
                                
        return $this->render('ProductBundle:Accueil:accueil.html.twig', array('search' => $search->createView()));
    }

    public function sidebarAction() {
       
        return $this->render('ProductBundle:Accueil:sidebar.html.twig');
    }

    public function whoswhoAction() {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
       
        return $this->render('ProductBundle:Accueil:whoswho.html.twig', array('search' => $search->createView()));
    }


    public function clairjoieAction() {
       
        return $this->redirect('http://www.clairjoie.com');
    }
}

<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\Services;
use InstantSoin\ProductBundle\Form\ServicesType;
use InstantSoin\ProductBundle\Repository\ServicesRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;


class ServicesController extends Controller
{
    public function services_overallAction()
    {

    	$search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
                                
        return $this->render('ProductBundle:Services:Services_overall.html.twig',
            array(
                'search' => $search->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }


    public function services_by_catAction($id, Request $Request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Services');
        $services = $repository->findByCategorieServ($id);

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
        $currentCatServ = $repository->findById($id)[0];

        if (!$services){
            $session = $this->getRequest()->getSession();
            $this->get('session')->getFlashBag()->clear();
            $session->getFlashBag()->add('user_add_warning', 'Nous sommes désolés mais aucun service de cette catégorie n\'est effectué actuellement.');
        }
            return $this->render('ProductBundle:Services:Services_by_cat.html.twig',
                array(
                    'services' => $services,
                    'currentCatServ' => $currentCatServ,
                    'search' => $search->createView(),
                    'categoriesServ' => $categoriesServ,
                    'categoriesProd' => $categoriesProd,
                ));
    }


}

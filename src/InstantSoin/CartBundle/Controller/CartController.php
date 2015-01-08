<?php

namespace InstantSoin\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;

class CartController extends Controller
{
    public function show_cartAction()
    {

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();


        var_dump($_SESSION);
        die();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();
        
        return $this->render('CartBundle:Cart:cart.html.twig',
            array(
                'search' => $search->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }

    public function to_cartAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $actionMsg = "";

            $session = $this->get('session');

            $id = $request->get("id");
            $action = $request->get("action");

            $username = $this->get('security.context')->getToken()->getUsername();
            $session->set('user',$username);

            switch ($action) {
                case '1':
                    $session->set('id',$id);
                    $session -> set('action','Ajout');
                    break;
                
                case '2':
                    $session->remove('id');
                    $session -> set('action','Suppression');
                    break;

                default:
                    # code...
                    break;
            }

            return new Response($_SESSION['_sf2_attributes']['action']." de l'article ".$id." effectué correctement.");

        } else {
            // rediriger vers même page
        }
    }
}

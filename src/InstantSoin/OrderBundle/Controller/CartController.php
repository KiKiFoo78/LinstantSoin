<?php

namespace InstantSoin\OrderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Entity\CategorieServ;


class CartController extends Controller
{
    public function cartAction(Request $request)
    {
        $session = $request->getSession();



        //////////////////////////////////////////////////////////
        $panier = $session->get('panier');
        var_dump($panier);
        die();
        //////////////////////////////////////////////////////////



        if (!$session->has('panier')) $session->set('panier', array());
        
        
        if (count($session->get('panier')) > 0) {
            $em = $this->getDoctrine()->getManager();
            $produits = $em->getRepository('EcommerceBundle:Produits')->findArray(array_keys($session->get('panier')));
        } else {
        
            $produits = array();
        }

        $search = $this->createFormBuilder()
                                ->add('recherche', 'search', array('label' => '', 'attr' => array('class' => 'productSearch')))
                                ->add('save', 'submit', array('label' => 'Rechercher','attr' => array('class' => 'productSearch')))
                                ->getForm();
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('OrderBundle:Cart:cart.html.twig',
        	array(
        		'produits' => $produits,
        		'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
                'search' => $search->createView(),
        		'panier' => $session->get('panier')));
    }

    public function to_cartAction(Request $request)
    {
        $session = $request->getSession();

        if (!$session->has('panier')) $session->set('panier',array());
        $panier = $session->get('panier');
        
        $id = $request->get("id");
        $action = $request->get("action");

        switch ($action) {
                case '1':
                    if (array_key_exists($id, $panier)) {
                        $qte = $panier[$id];
                        $qte++;
                        $panier[$id] = $qte;                       
                    }
                    else {
                        $panier[$id] = 1;
                    }
                    $session->set('action','ajouté');
                    break;
                case '2':
                    $qte = $panier->get($id);
                    if ( $qte = 1 ){
                        $panier->remove($id);
                    }
                    else{
                        $qte--;
                        $panier->set($id , $qte);
                    }
                    $session->set('action','supprimé');
                    break;
                default:
                    # code...
                    break;
            }

            $session->set('panier',$panier);
            
            return new Response("Cet article a bien été ".$session->get('action'));
    }

}

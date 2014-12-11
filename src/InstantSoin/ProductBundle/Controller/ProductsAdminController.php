<?php

namespace InstantSoin\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\ProductBundle\Entity\Produits;
use InstantSoin\ProductBundle\Form\ProduitsType;

class ProductsAdminController extends Controller
{
    public function createProductsAction(request $request)
    {
        $produit = new Produits();

        $form = $this->createForm(new ProduitsType(), $produit);

        $form->handleRequest($request);

        if($form->isValid()){

            $newProd = $form->get('reference')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La référence "' .$newProd. '" a bien été créée. Elle est maintenant disponible au catalogue.');

            return $this->redirect($this->generateUrl('createProducts'));
        }

        return $this->render('ProductBundle:Products:createProducts.html.twig', array('form' => $form->createView()));
    }





    public function updateProductsAction()
    {

    }





    public function deleteProductsAction()
    {

    }





    public function listingProductsAction()
    {

    }




}

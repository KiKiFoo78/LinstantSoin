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
use InstantSoin\ProductBundle\Repository\ProduitsRepository;

class ProductsAdminController extends Controller
{
    public function createProductsAction(request $request)
    {
        $produit = new Produits();

        $form = $this->createForm(new ProduitsType(), $produit);

        $form->handleRequest($request);

        if($form->isValid()){

            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/Produits';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }
            $nomImage = $form['reference']->getData().rand(1, 99).'.'.$extension;

            $file->move($dir, $nomImage);

            $produit->setUrlimage($dir.'/'.$nomImage);
            $produit->setAltimage($produit->getDesignation());
            }

            $newProd = $form->get('reference')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La référence "' .$newProd. '" a bien été créée. Elle est maintenant disponible au catalogue.');

            return $this->redirect($this->generateUrl('createProducts'));
        }

        return $this->render('ProductBundle:Products:createProducts.html.twig', array('form' => $form->createView()));
    }





    public function updateProductsAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $produit = $em->getRepository('ProductBundle:Produits')->findById($id)[0];
        

        if (!$produit) {
            $produit = new Produits();
        }

        $form = $this->createForm(new ProduitsType(), $produit);
        
        $image = $produit->getUrlimage();

        $form->handleRequest($request);

        if($form->isValid()){
            
            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/Produits';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }
            $nomImage = $form['reference']->getData().rand(1, 99).'.'.$extension;

            $file->move($dir, $nomImage);

            $produit->setUrlimage($dir.'/'.$nomImage);
            $produit->setAltimage($produit->getDesignation());

            }

            $updateProd = $form->get('designation')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'Le Produit "' .$updateProd. '" a bien été mis à jour.');

            return $this->redirect($this->generateUrl('listingProducts'));
        }

        return $this->render('ProductBundle:Products:updateProducts.html.twig', array('form' => $form->createView(), 'image' => $image));
    }





    public function deleteProductsAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Produits');
        $produit = $repository->findById($id)[0];
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Produits');
        $produits = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Products:listingProducts.html.twig', array('produits' => $produits));
    }





    public function listingProductsAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Produits');
        $produits = $repository->findAllOrderedByName();

        $_SESSION['produits']=$produits;

        return $this->render('ProductBundle:Products:listingProducts.html.twig', array('produits' => $produits));
    }




}

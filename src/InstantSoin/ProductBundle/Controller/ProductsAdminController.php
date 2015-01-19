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
use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;

class ProductsAdminController extends Controller
{
    public function createProductsAction(request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

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

            $nom = $form->get('designation')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $produit->setUrlimage($dir.'/'.$nomImage);
            $produit->setAltimage($produit->getDesignation());
            }

            $newProd = $form->get('reference')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'La référence "' .$newProd. '" a bien été créée. Elle est maintenant disponible au catalogue.');

            return $this->redirect($this->generateUrl('createProducts'));
        }

        return $this->render('ProductBundle:Products:createProducts.html.twig',
            array(
                'form' => $form->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function updateProductsAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

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

            $nom = $form->get('designation')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $produit->setUrlimage($dir.'/'.$nomImage);
            $produit->setAltimage($produit->getDesignation());

            }

            $updateProd = $form->get('designation')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'Le Produit "' .$updateProd. '" a bien été mis à jour.');

            return $this->redirect($this->generateUrl('listingProducts'));
        }

        return $this->render('ProductBundle:Products:updateProducts.html.twig',
            array(
                'form' => $form->createView(),
                'image' => $image,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
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

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Products:listingProducts.html.twig',
            array(
                'produits' => $produits,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function listingProductsAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Produits');
        $produits = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Products:listingProducts.html.twig',
            array(
                'produits' => $produits,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }



    private function stripAccents($nom){
        $replace = array('e','e','e','a','o','e','e','a','a','u','u','r');
        $search = array('é','è','ê','à','ô','É','È','À','Â','ù','Ù','®');

        $nom = str_replace($search,$replace,$nom);
       
        $newChaine = "";
        $i = 0;
        $long = strlen($nom);

        for($idx=0; $idx<$long; $idx++){
            $car = $nom[$idx];

            switch ($car) {
                case ' ':
                    break;
                case '/':
                    $newChaine[$i] = '_';
                    $i++;
                    break;
                case '®':
                    break;
                case '-':
                    $newChaine[$i] = '-';
                    $i++;
                    break;
                
                default:
                    $newChaine[$i] = $nom[$idx];
                    $i++;
                    break;
            }
        }
        return implode($newChaine);
    }


}

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

use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Form\CategorieProdType;

class CategoryProdAdminController extends Controller
{
    public function createCategoryProdAction(request $request)
    {
        $categorieProd = new CategorieProd();

        $form = $this->createForm(new CategorieProdType(), $categorieProd);

        $form->handleRequest($request);

        if($form->isValid()){

            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/CategorieProd';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }

            $nom = $form->get('intitule')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $categorieProd->setUrlimage($dir.'/'.$nomImage);
            $categorieProd->setAltimage($categorieProd->getIntitule());
            }

            $newCatProd = $form->get('intitule')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieProd);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La catégorie "' .$newCatProd. '" a bien été créée. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('createCategoryProd'));
        }

        return $this->render('ProductBundle:Category:createCategoryProd.html.twig', array('form' => $form->createView()));
    }





    public function updateCategoryProdAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $categorieProd = $em->getRepository('ProductBundle:CategorieProd')->findById($id)[0];
        

        if (!$categorieProd) {
            $categorieProd = new CategorieProd();
        }

        $form = $this->createForm(new CategorieProdType(), $categorieProd);

        $image = $categorieProd->getUrlimage();

        $form->handleRequest($request);

        if($form->isValid()){
            
            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/CategorieProd';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }

            $nom = $form->get('intitule')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $categorieProd->setUrlimage($dir.'/'.$nomImage);
            $categorieProd->setAltimage($categorieProd->getIntitule());

            }
    
            $updateCategProd = $form->get('intitule')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($categorieProd);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La categorie "' .$updateCategProd. '" a bien été mise à jour. Vous pouvez créer les produits associés.');

            return $this->redirect($this->generateUrl('listingCategoryProd'));
        }

        return $this->render('ProductBundle:Category:updateCategoryProd.html.twig', array('form' => $form->createView(), 'image' => $image));
    }





    public function deleteCategoryProdAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categorieProd = $repository->findById($id)[0];
        
        $nomCategProd = $categorieProd->getIntitule();

        $em = $this->getDoctrine()->getManager();
        $em->remove($categorieProd);
        $em->flush();

        $this->get('session')->getFlashBag()->add('user_add_success', 'La categorie "' .$nomCategProd. '" a bien été supprimée.');

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Category:listingCategoryProd.html.twig', array('categoriesProd' => $categoriesProd));
    }





    public function listingCategoryProdAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $_SESSION['categoriesProd']=$categoriesProd;

        return $this->render('ProductBundle:Category:listingCategoryProd.html.twig', array('categoriesProd' => $categoriesProd));
    }


    public function stripAccents($nom){
        $replace = array('e','e','e','a','o');
        $search = array('é','è','ê','à','ô');

        $nom = str_replace($search,$replace,$nom);
       
       $newChaine = "";
       $i = 0;
       $long = strlen($nom);

       for($idx=0; $idx<$long; $idx++){
            $car = $nom[$idx];

            switch ($car) {
                case ' ':
                    //$newChaine[$i] = '';
                    break;
                case '/':
                    $newChaine[$i] = '_';
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

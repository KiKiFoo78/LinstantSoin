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

use InstantSoin\ProductBundle\Entity\Services;
use InstantSoin\ProductBundle\Form\ServicesType;
use InstantSoin\ProductBundle\Repository\ServicesRepository;
use InstantSoin\ProductBundle\Entity\CategorieProd;
use InstantSoin\ProductBundle\Repository\CategorieProdRepository;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;

class ServicesAdminController extends Controller
{
    public function createServicesAction(request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        $service = new Services();

        $form = $this->createForm(new ServicesType(), $service);

        $form->handleRequest($request);

        if($form->isValid()){

            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/services';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }

            $nom = $form->get('libelle')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $service->setUrlimage($dir.'/'.$nomImage);
            $service->setAltimage($service->getReference());
            }

            $newService = $form->get('reference')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            $this->get('session')->getFlashBag()->clear();
            $this->get('session')->getFlashBag()->add('user_add_success', 'La prestation "' .$newService. '" a bien été créée. Elle est maintenant disponible au catalogue.');

            return $this->redirect($this->generateUrl('createServices'));
        }

        return $this->render('ProductBundle:Services:createServices.html.twig',
            array(
                'form' => $form->createView(),
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function updateServicesAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $service = $em->getRepository('ProductBundle:services')->findById($id)[0];
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        if (!$service) {
            $service = new Services();
        }

        $form = $this->createForm(new ServicesType(), $service);
        
        $image = $service->getUrlimage();

        $form->handleRequest($request);

        if($form->isValid()){
            
            $file = $form['image']->getData();

            if ($file) {
            $dir = 'bundles/InstantSoin/Images/services';

            $extension = $file->guessExtension();
                if (!$extension) {
                    $extension = 'jpeg';
                }
           
            $nom = $form->get('designation')->getData();

            $temp = $this->stripAccents($nom);

            $nomImage = $temp.'.'.$extension;

            $file->move($dir, $nomImage);

            $service->setUrlimage($dir.'/'.$nomImage);
            $service->setAltimage($service->getReference());

            }

            $updateService = $form->get('reference')->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            $this->get('session')->getFlashBag()->add('user_add_success', 'La prestation "' .$updateService. '" a bien été mise à jour.');

            return $this->redirect($this->generateUrl('listingServices'));
        }

        return $this->render('ProductBundle:Services:updateServices.html.twig',
            array(
                'form' => $form->createView(),
                'image' => $image,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }





    public function deleteServicesAction($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Services');
        $service = $repository->findById($id)[0];
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($service);
        $em->flush();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Services');
        $services = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        return $this->render('ProductBundle:Services:listingServices.html.twig',
            array(
                'services' => $services,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }



    public function listingServicesAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:Services');
        $services = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

        $_SESSION['services'] = $services;

        return $this->render('ProductBundle:Services:listingServices.html.twig',
            array(
                'services' => $services,
                'categoriesServ' => $categoriesServ,
                'categoriesProd' => $categoriesProd,
            ));
    }

    private function stripAccents($nom){
        $replace = array('e','e','e','a','o','e','e','a','u','u');
        $search = array('é','è','ê','à','ô','É','È','À','ù','Ù');

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

<?php


namespace InstantSoin\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

use InstantSoin\UserBundle\Entity\User;
use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Entity\CategorieProd;


class AdminController extends Controller
{
	public function adminAction()
	{
        
        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieProd');
        $categoriesProd = $repository->findAllOrderedByName();

        $repository = $this->getDoctrine()->getManager()->getRepository('ProductBundle:CategorieServ');
        $categoriesServ = $repository->findAllOrderedByName();

		return $this->render('UserBundle:Admin:admin.html.twig', array('categoriesServ' => $categoriesServ, 'categoriesProd' => $categoriesProd));
	}
	
	public function sidebar_adminAction()
	{
       
        return $this->render('UserBundle:Admin:sidebar_admin.html.twig');
    }

}
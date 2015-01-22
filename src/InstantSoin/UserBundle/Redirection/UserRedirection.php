<?php

namespace InstantSoin\UserBundle\Redirection;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

use InstantSoin\UserBundle\Entity\User;
use InstantSoin\UserBundle\Controller\SecurityController;


class UserRedirection implements AuthenticationSuccessHandlerInterface
{
    private $router;

    public function __construct(RouterInterface $router){
        $this->router = $router;
    }
    
    public function onAuthenticationSuccess(Request $request, TokenInterface $token){
        $roles = $token->getRoles();
        
        $rolesTab = array_map(function($role){
                                        return $role->getRole();
                                    }, $roles);
        
        
        if (in_array("ROLE_ESTHETICIENNE", $rolesTab)){

            $redirection = new RedirectResponse($this->router->generate('estheticienne'));
        }

        if (in_array("ROLE_ADMIN", $rolesTab)){

            $redirection = new RedirectResponse($this->router->generate('admin'));
        }

        if (in_array("ROLE_USER",  $rolesTab)){

            $redirection = new RedirectResponse($this->router->generate('product_homepage'));
        }
        //$function = "InstantSoin\UserBundle\Controller\SecurityController.php/lastLogDate(".$token.")";
        //$temp = $this->{$function};

        return $redirection;
    }

    //public function lastLogDate($token)
    //{   
    //    $user = $token->getUser('lastLogin');
    //    $date = getdate();
    //    $user->setLastLogin($date);

    //    $em = $this->getDoctrine()->getEntityManager();
    //    $em->persist($user);
    //    $em->flush();
    //    return true;
    //}

    
}
<?php 
namespace InstantSoin\UserBundle\Component\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ZipCode extends Constraint
{
    // message is optional, you can also pass the message in the annotation
    public $message = 'Le code postal doit contenir 5 carractères numériques. Votre saisie était {{ value }}.';

}
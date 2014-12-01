<?php

namespace InstantSoin\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;


class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array('label' => 'Nom : '));
        $builder->add('email', 'email', array('label' => 'Adresse Email : '));
        $builder->add('subject','text', array( 'label' => 'Sujet : '));
        $builder->add('body', 'textarea',array('label' => 'Votre message : '));
    }

    public function getName()
    {
        return 'contact';
    }
}
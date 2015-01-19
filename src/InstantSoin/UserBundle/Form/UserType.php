<?php

namespace InstantSoin\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormTypeInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('data_class' => null,'required' => true))
            ->add('prenom', 'text', array('data_class' => null,'required' => true))
            ->add('adresse1', 'text', array('data_class' => null,'required' => true))
            ->add('adresse2', 'text', array('data_class' => null,'required' => false))
            ->add('codepostal', 'number', array('data_class' => null,'required' => true))
            ->add('ville', 'text', array('data_class' => null,'required' => true))
            ->add('telephone', 'text', array('data_class' => null,'required' => true))
            ->add('email', 'text', array('data_class' => null,'required' => true))
            ->add('username', 'text', array(
                    'data_class' => null,
                    'required' => true,
                    'read_only' => true,
                ))
            ->add('password', 'text', array(
                    'data_class' => null,
                    'required' => true,
                    'read_only' => true,
                ))
            ->add('roles', array('data_class' => null,'required' => true))
            ->add('save', 'submit', array('label' => 'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_userbundle_user';
    }
}

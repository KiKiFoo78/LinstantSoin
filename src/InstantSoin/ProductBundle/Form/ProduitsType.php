<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProduitsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('designation')
            ->add('description')
            ->add('image')
            ->add('urlimage')
            ->add('altimage')
            ->add('stock')
            ->add('categorie')
            ->add('fournisseurs')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\ProductBundle\Entity\Produits'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_productbundle_produits';
    }
}

<?php

namespace InstantSoin\ProductBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use InstantSoin\ProductBundle\Entity\CategorieServ;
use InstantSoin\ProductBundle\Form\CategorieServType;
use InstantSoin\ProductBundle\Repository\CategorieServRepository;

class ServicesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference', 'text', array('required' => true, 'label' => 'Référence de la prestation :'))
            ->add('libelle', 'text', array('required' => true, 'label' => 'Libellé de la prestation :'))
            ->add('description', 'text', array('required' => true, 'label' => 'Description de la prestation :'))
            ->add('image', 'file', array('data_class' => null,'required' => false, 'label' => 'Image de la prestation :'))
            ->add('categorieServ', 'entity', array(
                            'class' => 'ProductBundle:CategorieServ',
                            'property' => 'intitule',
                            'query_builder' => function(CategorieServRepository $er)
                            {
                            return $er->createQueryBuilder('CategorieServ');
                            },
                            'empty_value' => 'Sélectionnez la catégorie de service',
                            'required' => true,
                            'expanded' => false,
                            'multiple' => false,
                            'label' => 'Catégorie de service correspondante :',
                        ))

            ->add('save', 'submit', array('label' => 'Enregistrer'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InstantSoin\ProductBundle\Entity\Services'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'instantsoin_productbundle_services';
    }
}

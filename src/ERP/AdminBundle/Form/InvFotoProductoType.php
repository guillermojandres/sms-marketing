<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvFotoProductoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null, array(
                    'required'=>true,
                    'label' => 'Nombre',  
                    'attr'=>array(
                    'class'=>'form-control invproductoTextBox'                     
                    )))
            
            ->add('file',null, array('label'=>'Foto de Subcategoria','required'=>false,
                    'attr'=>array('class'=>'Subcategoria invproductoSelect'
                    )))          
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\AdminBundle\Entity\InvFotoProducto'
        ));
    }
}

<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CrmEmpresaClienteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', null ,array('label'=>'Nombre '))
            ->add('direccion' , null ,array('label'=>'Direccion '))
            ->add('nrc', null ,array('label'=>'NRC'))
            ->add('nit', null ,array('label'=>'NIT'))
            ->add('giro', null ,array('label'=>'Giro'))
            ->add('tel', null ,array('label'=>'Telefono'))
            ->add('fax', null ,array('label'=>'Fax'))
            ->add('correo', null ,array('label'=>'Correo'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\AdminBundle\Entity\CrmEmpresaCliente'
        ));
    }
}

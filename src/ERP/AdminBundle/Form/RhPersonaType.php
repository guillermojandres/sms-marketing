<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RhPersonaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apellido')
            ->add('genero')
            ->add('fechaIngreso', 'date')
            ->add('fechaNacimiento', 'date')
            ->add('dui')
            ->add('nit')
            ->add('correoelectronico')
            ->add('direccion')
            ->add('telefonoFijo')
            ->add('telefonoMovil')
            ->add('ctlCiudad')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ERP\AdminBundle\Entity\RhPersona'
        ));
    }
}

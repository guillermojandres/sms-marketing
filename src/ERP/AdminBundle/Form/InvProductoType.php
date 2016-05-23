<?php

namespace ERP\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvProductoType extends AbstractType
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
            ->add('descripcion', null, array(
                    'required'=>true,
                    'label' => 'Descripcion',  
                    'attr'=>array(
                    'class'=>'form-control invproductoTextBox'                       
                    )))
            ->add('precioCompra', null, array(
                    'required'=>true,
                    'label' => 'Precio de compra',  
                    'attr'=>array(
                    'class'=>'form-control invproductoTextBox'                      
                    )))
            ->add('precioVenta', null, array(
                    'required'=>true,
                    'label' => 'Precio de venta',  
                    'attr'=>array(
                    'class'=>'form-control invproductoTextBox'                       
                    )))
            ->add('sku', null, array(
                   'required'=>true,
                   'label' => 'Sku',  
                   'attr'=>array(
                   'class'=>'form-control invproductoTextBox'                     
                   )))
            ->add('serial', null, array(
                   'required'=>true,
                   'label' => 'Serial',  
                   'attr'=>array(                    
                   'class'=>'form-control invproductoTextBox'                      
                   )))
            ->add('inventarioBajo', null, array(
                   'required'=>true,
                   'label' => 'Inventario bajo',  
                   'attr'=>array(
                   'class'=>'form-control invproductoTextBox'                      
                   )))
            ->add('totalExistencia', null, array( 
                   'required'=>true,
                   'label' => 'Existencias totales',  
                  'attr'=>array(
                   'class'=>'form-control invproductoTextBox'                      
                   )))
            ->add('invCatProducto', null, array(  
                   'required'=>true,
                   'label' => 'Categoria de producto',  
                   'attr'=>array(
                   'class'=>'form-control invproductoSelect'                      
                   )))
            ->add('invTipoInventario', null, array( 
                  'required'=>true,
                  'label' => 'Tipo de inventario',    
                  'attr'=>array(
                  'class'=>'form-control invproductoSelect'                     
                  )))
            ->add('invZona', null, array(  
                   'required'=>true,
                   'label' => 'Zona',  
                   'attr'=>array(
                   'class'=>'form-control invproductoSelect'                      
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
            'data_class' => 'ERP\AdminBundle\Entity\InvProducto'
        ));
    }
}

<?php

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ERP\AdminBundle\Entity\BeardProducto;
use ERP\AdminBundle\Entity\BeardAtributoProducto;
use ERP\AdminBundle\Entity\BeardImagenProducto;

/**
 * InvProveedor controller.
 *
 * @Route("/admin/inventariobeardnewprod")
 */
class InventariobeardNewProdController extends Controller
{
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/newprod", name="inventariobeard_newprod")
     *
     */  
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $catprod = $em->getRepository('ERPAdminBundle:CtlCategoriaProducto')->findAll();
        
        return $this->render('ERPCRMBundle:inventariobeard:newprod.html.twig', array('categoriaproducto'=>$catprod));
    }         
    
    /**
     * Lista de subcategorias filtradas por categorias.
     *
     * @Route("/subxcat", name="inventariobeard_subxcatprod")
     * @Method("POST")
     */
    public function subxcatprodAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $parameters = $request->request->all();
        $idcat = $parameters['idcat'];                            
        $catprod = $em->getRepository('ERPAdminBundle:CtlCategoriaProducto')->find($idcat);
        $subcats = $em->getRepository('ERPAdminBundle:CtlSubCategoriaProducto')->findBy(array('idCategoria'=>$catprod));
        //var_dump($subcats);
        $a = array();
        
        foreach ($subcats as $key => $value) {
            //var_dump($key);
            $a[$key]['id'] = $value->getId();
            $a[$key]['nombre'] = $value->getNombreSubCategoria();
            //var_dump($a[$key]['nombre']);
        }
        //var_dump($a);
        //die();
        
        $response = new JsonResponse();
        $response->setData(array(           
            'a' => $a,
        ));
        
        return $response;
        //return new Response(json_encode($a));
        //return $this->render('ERPCRMBundle:inventariobeard:newprod.html.twig', array('subcategoriasproducto' => $subcats));
    }
    
    /**
     * Lists all InvProveedor entities.
     *
     * @Route("/insertprod", name="inventariobeard_insertprod")
     * @Method({"GET", "POST"})
     */  
    public function insertarproductoAction(Request $request)
    {
        $parameters = $request->request->all();
        $em = $this->getDoctrine()->getManager();
        //var_dump($parameters['atributo']);
        //var_dump($parameters['porcentaje']);
        //var_dump($_FILES);
                                               
        //$_FILES;        
        $producto = new BeardProducto();
        $atributoproducto = new BeardAtributoProducto();
        $fotoproducto = new BeardImagenProducto();
        
        $producto->setNombre($parameters['nombreprod']);
        $producto->setPrecio($parameters['precio']);
        $producto->setNumeroReferencia($parameters['codigo']);
        $producto->setEstado(1);
        $producto->setDescripcion($parameters['descripcion']);
        $producto->setLink($parameters['link']);
        $producto->setIngrediente($parameters['ingrediente']);
        $producto->setPresentacion($parameters['presentacion']);
        $producto->setStock($parameters['stock']);
        if(isset($parameters['destacado'])){            
            $producto->setDestacado(1);
        }else{
            $producto->setDestacado(0);
        }
        if(isset($parameters['disponibilidad'])){            
            $producto->setDispoonible(1);
        }else{
            $producto->setDispoonible(0);
        }
        if(isset($parameters['msjexistencia'])){           
            $producto->setMensaje($parameters['msjexistencia']);
        }
                
        $idsubcat = $parameters['subcategoria'];
        
        $subcatprod = $em->getRepository('ERPAdminBundle:CtlSubCategoriaProducto')->find($idsubcat);        
        $producto->setSubCategoriaProducto($subcatprod);
        $em->persist($producto);
        $em->flush();
                      
        //Insertando datos en la tabla de atributos del producto
        $n=  count($parameters['atributo']);
        for($i=1;$i<$n;$i++){
            $atributoproducto->setNombre($parameters['atributo'][$i]);
            $atributoproducto->setPorcentaje($parameters['porcentaje'][$i]);
            $atributoproducto->setIdProducto($producto);
            $em->persist($atributoproducto);
            $em->flush();            
            unset($atributoproducto);
            $atributoproducto = new BeardAtributoProducto();
        }
                                                                      
        $path = $this->container->getParameter('photo.producto');

        $fecha = date('Y-m-d-His');
        //$extension = $entity->getFile()->getClientOriginalExtension();
        $nombreArchivo1 = "producto_".$fecha."_".$_FILES['userfile']['name'];
        $nombreArchivo2 = "producto_".$fecha."_".$_FILES['userfile2']['name'];
        $nombreArchivo3 = "producto_".$fecha."_".$_FILES['userfile3']['name'];
        $nombreArchivo4 = "producto_".$fecha."_".$_FILES['userfile4']['name'];
        $nombreArchivo5 = "producto_".$fecha."_".$_FILES['userfile5']['name'];

        //Primero se verifica si el archivo se subio al servidor y luego se guarda en la BD
        //$k=0;
        if(move_uploaded_file($_FILES['userfile']['tmp_name'], $path.$nombreArchivo1)){
            $fotoproducto->setImagen1($nombreArchivo1);
        }
        if(move_uploaded_file($_FILES['userfile2']['tmp_name'], $path.$nombreArchivo2)){
            $fotoproducto->setImagen2($nombreArchivo2);
        }
        if(move_uploaded_file($_FILES['userfile3']['tmp_name'], $path.$nombreArchivo3)){
            $fotoproducto->setImagen3($nombreArchivo3);
        }
        if(move_uploaded_file($_FILES['userfile4']['tmp_name'], $path.$nombreArchivo4)){
            $fotoproducto->setImagen4($nombreArchivo4);
        }
        if(move_uploaded_file($_FILES['userfile5']['tmp_name'], $path.$nombreArchivo5)){
            $fotoproducto->setImagen5($nombreArchivo5);
        }
        
        $fotoproducto->setIdProducto($producto);
        $em->persist($fotoproducto);
        $em->flush();
        //var_dump($path);
        //die();
                
        //return $this->render('ERPCRMBundle:inventariobeard:newprod.html.twig', array('categoriaproducto'=>$catprod));
        return $this->render('ERPCRMBundle:inventariobeard:dashboard.html.twig');
    }
    
    
    
      /**
    * Ajax utilizado para buscar informacion de abogados
    * 
    * @Route("/buscarProducto", name="buscarProducto",options={"expose"=true})
    */
    public function BuscarProyectoAction(Request $request)
    {
        $busqueda = $request->query->get('q');
        $page = $request->query->get('page');
       
        $em = $this->getDoctrine()->getEntityManager();
        $dql = "SELECT abo.id abogadoid, abo.nombre  "
                        . "FROM ERPAdminBundle:BeardProducto abo "
                        . "WHERE upper(abo.nombre) LIKE upper(:busqueda)"
                        . " ORDER BY abo.nombre ASC ";
       
        $abogado['data'] = $em->createQuery($dql)
                ->setParameters(array('busqueda'=>"%".$busqueda."%"))
                ->setMaxResults( 10 )
                ->getResult();
       
        return new Response(json_encode($abogado));
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
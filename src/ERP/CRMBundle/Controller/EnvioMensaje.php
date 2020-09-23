<?php

namespace ERP\CRMBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception;


/**
 * ClientePotencial controller.
 *
 * @Route("/envioMensajes")
 */
class EnvioMensaje extends Controller
{
    /**
     * Lists all Restaurantes entities.
     *
     * @Route("/", name="envio_mensajes_final",options={"expose"=true})
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
 		 return $this->render('ERPCRMBundle:envioMensajes/envioMensajes.html.php', array(
            
        ));
	       
    }
    
 
    
    
    
 }

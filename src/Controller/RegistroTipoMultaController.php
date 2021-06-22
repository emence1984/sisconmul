<?php

namespace App\Controller;

use App\Entity\SmTipoMulta;
use App\Form\RegistroTipoMultaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RegistroTipoMultaController extends AbstractController
{
    #[Route('/sisconmul/tipomulta', name: 'registro_tipo_multa')]
    public function index(Request $request): Response
    {

        $tipoMulta = new SmTipoMulta();
       
        $frmTipoMulta = $this->createForm(RegistroTipoMultaType::class, $tipoMulta);
        $frmTipoMulta->handleRequest($request);
 
         if ($frmTipoMulta->isSubmitted() && $frmTipoMulta->isValid()){
             
            $em = $this->getDoctrine()->getManager();
            $em->persist($tipoMulta);
            $em->flush();
 
            $this->addFlash('msgOk','Transacción Ejecutada con Éxito !!');
 
            return $this->redirectToRoute('principal');
         }
 

        return $this->render('registro_tipo_multa/index.html.twig', [
            'frmTipoMulta' => $frmTipoMulta->createView(),
        ]);
    }
}

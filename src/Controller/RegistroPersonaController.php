<?php

namespace App\Controller;

use App\Entity\SmPersona;
use App\Entity\SmUsuario;
use App\Form\RegistroPersonaType;
use App\Form\RegistroUsuarioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistroPersonaController extends AbstractController
{
    /**
     * @Route("/sisconmul/persona",name="registro_persona")
     */
    public function home(Request $request)
    {
        // crea una instancia de la tabla usuario
        //$usuario = new SmUsuario();
        $persona = new SmPersona();
        
        // crea el formulario de registro de usuario
       // $frmUsuario = $this -> createForm(RegistroUsuarioType::class, $usuario);
        
       $frmPersona = $this->createForm(RegistroPersonaType::class, $persona);
       $frmPersona->handleRequest($request);

        if ($frmPersona->isSubmitted() && $frmPersona->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($persona);
            $em->flush();

            $this->addFlash('msgOk','Transacción Ejecutada con Éxito !!');

            return $this->redirectToRoute('principal');
        }

        return $this->render('registro_persona/index.html.twig', [
            'frmRegistroPersona' => $frmPersona->createView(),
        ]);
    }
}
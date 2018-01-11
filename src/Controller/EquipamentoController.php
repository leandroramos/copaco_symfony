<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Equipamento;
use App\Form\EquipamentoType;

class EquipamentoController extends Controller
{
    /**
     * @Route("/equipamento/new", name="equipamento_new")
     */
    public function newAction(Request $request)
    {
        $equipamento = new Equipamento();
        $form = $this->createForm(EquipamentoType::class,$equipamento);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $equipamento->setIp('192.168.0.4');
            $em->persist($equipamento);
            $em->flush();
            return $this->redirectToRoute('equipamento_new');
        }
        return $this->render('equipamento/new.html.twig',[
            'form' => $form->createView()
        ]); 
    }
}

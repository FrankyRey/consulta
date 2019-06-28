<?php

namespace App\Controller;

use App\Entity\ConceptoPago;
use App\Form\ConceptoPagoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/concepto_pago")
 */
class ConceptoPagoController extends AbstractController
{
    /**
     * @Route("/", name="concepto_pago_index", methods={"GET"})
     */
    public function index(): Response
    {
        $conceptoPagos = $this->getDoctrine()
            ->getRepository(ConceptoPago::class)
            ->findAll();

        return $this->render('concepto_pago/index.html.twig', [
            'concepto_pagos' => $conceptoPagos,
        ]);
    }

    /**
     * @Route("/new", name="concepto_pago_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $conceptoPago = new ConceptoPago();
        $form = $this->createForm(ConceptoPagoType::class, $conceptoPago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($conceptoPago);
            $entityManager->flush();

            return $this->redirectToRoute('concepto_pago_index');
        }

        return $this->render('concepto_pago/new.html.twig', [
            'concepto_pago' => $conceptoPago,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idConceptoPago}", name="concepto_pago_show", methods={"GET"})
     */
    public function show(ConceptoPago $conceptoPago): Response
    {
        return $this->render('concepto_pago/show.html.twig', [
            'concepto_pago' => $conceptoPago,
        ]);
    }

    /**
     * @Route("/{idConceptoPago}/edit", name="concepto_pago_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ConceptoPago $conceptoPago): Response
    {
        $form = $this->createForm(ConceptoPagoType::class, $conceptoPago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('concepto_pago_index', [
                'idConceptoPago' => $conceptoPago->getIdConceptoPago(),
            ]);
        }

        return $this->render('concepto_pago/edit.html.twig', [
            'concepto_pago' => $conceptoPago,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idConceptoPago}", name="concepto_pago_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ConceptoPago $conceptoPago): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conceptoPago->getIdConceptoPago(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($conceptoPago);
            $entityManager->flush();
        }

        return $this->redirectToRoute('concepto_pago_index');
    }
}

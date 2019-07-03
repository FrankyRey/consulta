<?php

namespace App\Controller;

use App\Entity\OfertaAcademica;
use App\Form\OfertaAcademicaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/oferta_academica")
 */
class OfertaAcademicaController extends AbstractController
{
    /**
     * @Route("/", name="oferta_academica_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ofertaAcademicas = $this->getDoctrine()
            ->getRepository(OfertaAcademica::class)
            ->findAll();

        return $this->render('oferta_academica/index.html.twig', [
            'oferta_academicas' => $ofertaAcademicas,
        ]);
    }

    /**
     * @Route("/new", name="oferta_academica_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ofertaAcademica = new OfertaAcademica();
        $form = $this->createForm(OfertaAcademicaType::class, $ofertaAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ofertaAcademica);
            $entityManager->flush();

            return $this->redirectToRoute('oferta_academica_index');
        }

        return $this->render('oferta_academica/new.html.twig', [
            'oferta_academica' => $ofertaAcademica,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idOfertaAcademica}", name="oferta_academica_show", methods={"GET"})
     */
    public function show(OfertaAcademica $ofertaAcademica): Response
    {
        return $this->render('oferta_academica/show.html.twig', [
            'oferta_academica' => $ofertaAcademica,
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{idOfertaAcademica}/edit", name="oferta_academica_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OfertaAcademica $ofertaAcademica): Response
    {
        $form = $this->createForm(OfertaAcademicaType::class, $ofertaAcademica);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oferta_academica_index', [
                'idOfertaAcademica' => $ofertaAcademica->getIdOfertaAcademica(),
            ]);
        }

        return $this->render('oferta_academica/edit.html.twig', [
            'oferta_academica' => $ofertaAcademica,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idOfertaAcademica}", name="oferta_academica_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OfertaAcademica $ofertaAcademica): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ofertaAcademica->getIdOfertaAcademica(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ofertaAcademica);
            $entityManager->flush();
        }

        return $this->redirectToRoute('oferta_academica_index');
    }
}

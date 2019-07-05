<?php

namespace App\Controller;

use App\Entity\NivelAcademico;
use App\Form\NivelAcademicoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/nivel_academico")
 */
class NivelAcademicoController extends AbstractController
{
    /**
     * @Route("/", name="nivel_academico_index", methods={"GET"})
     */
    public function index(): Response
    {
        $nivelAcademicos = $this->getDoctrine()
            ->getRepository(NivelAcademico::class)
            ->findAll();

        return $this->render('nivel_academico/index.html.twig', [
            'nivel_academicos' => $nivelAcademicos,
        ]);
    }

    /**
     * @Route("/new", name="nivel_academico_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nivelAcademico = new NivelAcademico();
        $form = $this->createForm(NivelAcademicoType::class, $nivelAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nivelAcademico);
            $entityManager->flush();

            return $this->redirectToRoute('nivel_academico_index');
        }

        return $this->render('nivel_academico/new.html.twig', [
            'nivel_academico' => $nivelAcademico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idNivelAcademico}", name="nivel_academico_show", methods={"GET"})
     */
    public function show(NivelAcademico $nivelAcademico): Response
    {
        return $this->render('nivel_academico/show.html.twig', [
            'nivel_academico' => $nivelAcademico,
        ]);
    }

    /**
     * @Route("/{idNivelAcademico}/edit", name="nivel_academico_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NivelAcademico $nivelAcademico): Response
    {
        $form = $this->createForm(NivelAcademicoType::class, $nivelAcademico);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nivel_academico_index', [
                'idNivelAcademico' => $nivelAcademico->getIdNivelAcademico(),
            ]);
        }

        return $this->render('nivel_academico/edit.html.twig', [
            'nivel_academico' => $nivelAcademico,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idNivelAcademico}", name="nivel_academico_delete", methods={"DELETE"})
     */
    public function delete(Request $request, NivelAcademico $nivelAcademico): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nivelAcademico->getIdNivelAcademico(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nivelAcademico);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nivel_academico_index');
    }
}

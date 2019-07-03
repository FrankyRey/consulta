<?php

namespace App\Controller;

use App\Entity\EstatusAlumno;
use App\Form\EstatusAlumnoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/estatus_alumno")
 */
class EstatusAlumnoController extends AbstractController
{
    /**
     * @Route("/", name="estatus_alumno_index", methods={"GET"})
     */
    public function index(): Response
    {
        $estatusAlumnos = $this->getDoctrine()
            ->getRepository(EstatusAlumno::class)
            ->findAll();

        return $this->render('estatus_alumno/index.html.twig', [
            'estatus_alumnos' => $estatusAlumnos,
        ]);
    }

    /**
     * @Route("/new", name="estatus_alumno_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estatusAlumno = new EstatusAlumno();
        $form = $this->createForm(EstatusAlumnoType::class, $estatusAlumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estatusAlumno);
            $entityManager->flush();

            return $this->redirectToRoute('estatus_alumno_index');
        }

        return $this->render('estatus_alumno/new.html.twig', [
            'estatus_alumno' => $estatusAlumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEstatusAlumno}", name="estatus_alumno_show", methods={"GET"})
     */
    public function show(EstatusAlumno $estatusAlumno): Response
    {
        return $this->render('estatus_alumno/show.html.twig', [
            'estatus_alumno' => $estatusAlumno,
        ]);
    }

    /**
     * @Route("/{idEstatusAlumno}/edit", name="estatus_alumno_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EstatusAlumno $estatusAlumno): Response
    {
        $form = $this->createForm(EstatusAlumnoType::class, $estatusAlumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estatus_alumno_index', [
                'idEstatusAlumno' => $estatusAlumno->getIdEstatusAlumno(),
            ]);
        }

        return $this->render('estatus_alumno/edit.html.twig', [
            'estatus_alumno' => $estatusAlumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idEstatusAlumno}", name="estatus_alumno_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EstatusAlumno $estatusAlumno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estatusAlumno->getIdEstatusAlumno(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estatusAlumno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estatus_alumno_index');
    }
}

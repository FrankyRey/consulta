<?php

namespace App\Controller;

use App\Entity\Alumno;
use App\Entity\Pago;

use App\Form\PagoType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/pagos")
 */
class PagosController extends AbstractController
{

	/**
     * @Route("/", name="pagos_index", methods={"GET"})
     */
    public function index(): Response
    {
        $alumnos = $this->getDoctrine()
            ->getRepository(Alumno::class)
            ->findAll();

        return $this->render('pagos/index.html.twig', [
            'alumnos' => $alumnos,
        ]);
    }

    /**
     * @Route("/{matricula}", name="pago_historial", methods={"GET"})
     */
    public function historial(Alumno $alumno): Response
    {
        $pagos = $this->getDoctrine()
            ->getRepository(Pago::class)
            ->findBy([
            	'alumnoMatricula' => $alumno->getMatricula(),
            ]);

        return $this->render('pagos/historial.html.twig', [
            'pagos' => $pagos,
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/new", name="pago_new", methods={"GET","POST"})
     */
    public function new(Request $request, Alumno $alumno): Response
    {
        $pago = new Pago();
        $pago->setIdUser($this->container->get('security.token_storage')->getToken()->getUser());
        $pago->setAlumnoMatricula($alumno);
        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pago);
            $entityManager->flush();

            return $this->redirectToRoute('pago_historial', [
                'matricula' => $alumno->getMatricula(),
            ]);
        }

        return $this->render('pagos/new.html.twig', [
            'pago' => $pago,
            'form' => $form->createView(),
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/{idPago}", name="pago_show", methods={"GET"})
     */
    public function show(Request $request, Alumno $alumno, Pago $pago): Response
    {
        return $this->render('pagos/show.html.twig', [
            'pago' => $pago,
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/{idPago}/edit", name="pago_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Alumno $alumno, Pago $pago): Response
    {
        $form = $this->createForm(PagoType::class, $pago);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pago_historial', [
                'matricula' => $alumno->getMatricula(),
            ]);
        }

        return $this->render('pagos/edit.html.twig', [
            'pago' => $pago,
            'form' => $form->createView(),
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/{idPago}", name="pago_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Alumno $alumno, Pago $pago): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pago->getIdPago(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pago);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pago_historial', [
            'matricula' => $alumno->getMatricula(),
        ]);
    }
}
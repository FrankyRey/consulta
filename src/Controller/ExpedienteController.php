<?php

namespace App\Controller;

use App\Entity\Alumno;
use App\Entity\Expediente;
use App\Entity\Documento;
use App\Entity\EstatusDocumento;

use App\Form\ExpedienteType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/expedientes")
 */
class ExpedienteController extends AbstractController
{

	/**
     * @Route("/", name="expediente_index", methods={"GET"})
     */
    public function index(): Response
    {
        $alumnos = $this->getDoctrine()
            ->getRepository(Alumno::class)
            ->findAll();

        return $this->render('expediente/index.html.twig', [
            'alumnos' => $alumnos,
        ]);
    }

    /**
     * @Route("/{matricula}", name="documentos", methods={"GET"})
     */
    public function documentos(Alumno $alumno): Response
    {
        $documentos = $this->getDoctrine()
            ->getRepository(Expediente::class)
            ->findBy([
                'alumnoMatricula' => $alumno->getMatricula(),
            ]);

        return $this->render('expediente/documentos.html.twig', [
            'documentos' => $documentos,
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/new", name="documentos_new", methods={"GET","POST"})
     */
    public function new(Request $request, Alumno $alumno): Response
    {
        $expediente = new Expediente();
        $expediente->setIdUser($this->container->get('security.token_storage')->getToken()->getUser());
        $expediente->setAlumnoMatricula($alumno);
        $form = $this->createForm(ExpedienteType::class, $expediente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($expediente);
            $entityManager->flush();

            return $this->redirectToRoute('documentos', [
                'matricula' => $alumno->getMatricula(),
            ]);
        }

        return $this->render('expediente/new.html.twig', [
            'expediente' => $expediente,
            'form' => $form->createView(),
            'alumno' => $alumno,
        ]);
    }
}
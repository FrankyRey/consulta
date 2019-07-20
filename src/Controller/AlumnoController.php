<?php

namespace App\Controller;

use App\Entity\Alumno;
use App\Form\AlumnoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/alumno")
 */
class AlumnoController extends AbstractController
{
    /**
     * @Route("/", name="alumno_index", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        $mensaje = $request->query->get('mensaje');

        $alumnos = $this->getDoctrine()
            ->getRepository(Alumno::class)
            ->findAll();

        return $this->render('alumno/index.html.twig', [
            'alumnos' => $alumnos,
            'mensaje' => $mensaje,
        ]);
    }

    /**
     * @Route("/new", name="alumno_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $alumno = new Alumno();
        $alumno->setIdUser($this->container->get('security.token_storage')->getToken()->getUser());
        $alumno->setFechaAlta(new \DateTime());
        $form = $this->createForm(AlumnoType::class, $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($alumno);
            $entityManager->flush();

            return $this->redirectToRoute('alumno_index');
        }

        return $this->render('alumno/new.html.twig', [
            'alumno' => $alumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{matricula}", name="alumno_show", methods={"GET"})
     */
    public function show(Alumno $alumno): Response
    {
        return $this->render('alumno/show.html.twig', [
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/edit", name="alumno_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Alumno $alumno): Response
    {
        $form = $this->createForm(AlumnoType::class, $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumno_index', [
                'matricula' => $alumno->getMatricula(),
            ]);
        }

        return $this->render('alumno/edit.html.twig', [
            'alumno' => $alumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{matricula}", name="alumno_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Alumno $alumno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$alumno->getMatricula(), $request->request->get('_token'))) {
            try{
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($alumno);
                $entityManager->flush();
            }
            catch(\Doctrine\DBAL\DBALException $e){
                $exception_message = $e->getPrevious()->getCode();
                if($exception_message==23000){
                    $mensaje = "No se puede eliminar el alumno, verifique que ya no exista información asociada a este alumno";
                }
                return $this->redirectToRoute('alumno_index', [
                    'mensaje' => $mensaje,
                ]);
            }
        }

        return $this->redirectToRoute('alumno_index');
    }
}

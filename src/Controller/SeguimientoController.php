<?php

namespace App\Controller;

use App\Entity\Alumno;
use App\Entity\Seguimiento;

use App\Form\SeguimientoType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/portal/seguimiento")
 */
class SeguimientoController extends AbstractController
{

	/**
     * @Route("/", name="seguimiento_index", methods={"GET"})
     */
    public function index(): Response
    {
        $alumnos = $this->getDoctrine()
            ->getRepository(Alumno::class)
            ->findAll();

        return $this->render('seguimiento/index.html.twig', [
            'alumnos' => $alumnos,
        ]);
    }

    /**
     * @Route("/{matricula}", name="seguimiento_historial", methods={"GET"})
     */
    public function historial(Alumno $alumno): Response
    {
        $correos = $this->getDoctrine()
            ->getRepository(Seguimiento::class)
            ->findBy([
            	'alumnoMatricula' => $alumno->getMatricula(),
            ]);

        return $this->render('seguimiento/historial.html.twig', [
            'correos' => $correos,
            'alumno' => $alumno,
        ]);
    }

    /**
     * @Route("/{matricula}/new", name="seguimiento_new", methods={"GET","POST"})
     */
    public function new(Request $request, Alumno $alumno, \Swift_Mailer $mailer): Response
    {
        $seguimiento = new Seguimiento();
        $seguimiento->setIdUser($this->container->get('security.token_storage')->getToken()->getUser());
        $seguimiento->setAlumnoMatricula($alumno);
        $form = $this->createForm(SeguimientoType::class, $seguimiento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $transport = (new \Swift_SmtpTransport('smtp.office365.com', 587,'tls'))
                ->setUsername('freynoso@udal.edu.mx')
                ->setPassword('lpt042rE')
            ;
            
            // Create the Mailer using your created Transport
            $mailer = new \Swift_Mailer($transport);

            // Create a message
            $message = (new \Swift_Message('Wonderful Subject'))
                ->setFrom(['freynoso@udal.edu.mx' => 'Franco Reynoso'])
                ->setTo([$alumno->getCorreoElectronico() => $alumno->getNombreCompleto()])
                ->setBody(
                     $this->renderView(
                        // templates/emails/registration.html.twig
                        'emails/'.$seguimiento->getTipoCorreo()->getTemplate(),
                        ['name' => $alumno->getNombreCompleto()]
                    ),
                    'text/html'
                )
            ;

            // Send the message
            $result = $mailer->send($message);
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seguimiento);
            $entityManager->flush();

            return $this->redirectToRoute('seguimiento_historial', [
                'matricula' => $alumno->getMatricula(),
            ]);
        }

        return $this->render('seguimiento/new.html.twig', [
            'seguimiento' => $seguimiento,
            'form' => $form->createView(),
            'alumno' => $alumno,
        ]);
    }
}
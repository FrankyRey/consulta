<?php
    namespace App\Controller;
    //Librerias Symfony
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    //Entidades
    use App\Entity\OfertaAcademica;
    use App\Entity\Alumno;

    //Tipos de Entrada de datos

    class MainController extends AbstractController
    {
        /**
         * @Route("/", name="home")
         */
        public function index()
        {
            $user = $this->getUser();
            if($user)
            {
                return $this->render('bundles/FOSUserBundle/layout.html.twig');
            }
            else
            {
                return $this->redirect('/login');
            }
        }

        /**
         * @Route("/portal/profile", name="profile")
         */
        public function profile()
        {
            return $this->render('bundles/FOSUserBundle/layout.html.twig');
        }

        /**
         * @Route("/portal/paypal", name="paypal")
         */
        public function paypal()
        {
            return $this->render('paypal.html.twig');
        }

        /**
         * @Route("/portal/inscritos/{idOfertaAcademica}", name="inscritos", methods={"GET"})
         */
        public function inscritos(OfertaAcademica $ofertaAcademica)
        {
            $alumnos = $this->getDoctrine()
                ->getRepository(Alumno::class)
                ->findBy([
                    'idOfertaAcademica' => $ofertaAcademica->getIdOfertaAcademica(),
                ]);

            return $this->render('inscritos/index.html.twig', [
                'alumnos' => $alumnos,
                'expandir' => 'maestria',
                'activo' => '1mas',
            ]);
        }
    }
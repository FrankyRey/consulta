<?php
    namespace App\Controller;
    
    //Librerias Symfony
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Serializer\Encoder\JsonEncoder;
    use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
    use Symfony\Component\Serializer\Serializer;

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

            $encoders = [new JsonEncoder()];
            $normalizers = [new ObjectNormalizer()];
            $serializer = new Serializer($normalizers, $encoders);

            $conn = $this->getDoctrine()->getManager()->getConnection();

            $sql = '
                SELECT 
                    o.nombre_oferta_academica as "nombreOfertaAcademica", 
                    count(*) as "inscritos"
                FROM
                    oferta_academica o,
                    alumno a
                WHERE
                    o.id_oferta_academica = a.id_oferta_academica
                GROUP BY
                    a.id_oferta_academica
                UNION
                SELECT 
                    nombre_oferta_academica as "nombreOfertaAcademica",
                    0 as "inscritos"
                FROM
                    oferta_academica
                WHERE
                    id_oferta_academica not in (select id_oferta_academica from alumno);
            ';
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $jsonContent = $serializer->serialize($stmt->fetchAll(), 'json');

            if($user)
            {
                return $this->render('bundles/FOSUserBundle/layout.html.twig', [
                    'ofertaAcademica' => $jsonContent,
                ]);
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
                    'idEstatusAlumno' => '4',
                ]);

            return $this->render('inscritos/index.html.twig', [
                'alumnos' => $alumnos,
                'ofertaAcademica' => $ofertaAcademica,
            ]);
        }
    }
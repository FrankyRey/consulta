<?php
    namespace App\Controller;
    //Librerias Symfony
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Component\HttpFoundation\JsonResponse;
    use Symfony\Component\HttpFoundation\Request;
    use Doctrine\ORM\EntityManagerInterface;

    //Entidades

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
    }
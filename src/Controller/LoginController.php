<?php

namespace App\Controller;

use App\Form\LoginFormType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class LoginController extends AbstractController
{
    // private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function loginForm(Request $request, AuthenticationUtils $authenticationUtils)
    {
        
        $builder = $this->createFormBuilder();

        $builder->add('email', EmailType::class, [
            'label' => 'Identifiant',
            'attr' => [
                'placeholder' => 'Identifiant'
            ]
        ])->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'placeholder' => "Mot de passe"
                ]
        ]);
        // ->add('_csrf_token', HiddenType::class);
        
        $form = $builder->getForm();
        $form->handleRequest($request);
        //dump($_POST);
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        // $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {
    }
}

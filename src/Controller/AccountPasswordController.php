<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

class AccountPasswordController extends AbstractController
{
    #[Route('/account/Modifier-mot-de-passe', name: 'account_password')]
    public function index(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $entityManager): Response
    {
        $notification = null;
        $user = $this->getUser();

        // Vérifier que $user n'est pas null avant de continuer
        if ($user instanceof PasswordAuthenticatedUserInterface) {
            $form = $this->createForm(ChangePasswordType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $old_pwd = $form->get('old_password')->getData();

                if ($encoder->isPasswordValid($user, $old_pwd)) {
                    $new_pwd = $form->get('new_password')->getData();
                    $password = $encoder->hashPassword($user, $new_pwd);

                    $user->setPassword($password);

                    $entityManager->persist($user);
                    $entityManager->flush();

                    $notification = 'Votre mot de passe a été changé';
                } else {
                    $notification = 'Mot de passe incorrect';
                }
            }
        } else {
            // Gérer le cas où $user est null, si nécessaire
            $notification = 'Utilisateur non authentifié';
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}

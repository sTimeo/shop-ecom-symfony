<?php
/*
// Définition du namespace du contrôleur
namespace App\Controller;

// Importation des classes nécessaires
use App\Entity\User; // La classe User représente l'entité utilisateur
use App\Form\RegisterType; // La classe RegisterType représente le formulaire d'inscription

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Classe de base pour les contrôleurs Symfony
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response; // Classe pour gérer les réponses HTTP
use Symfony\Component\Routing\Annotation\Route; // Annotation utilisée pour définir les routes

// Déclaration du contrôleur qui hérite de la classe de base AbstractController
class RegisterController extends AbstractController
{
    
    #[Route('/Inscription', name: 'app_register')]


    public function index(Request $request): Response
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
*/

 
namespace App\Controller;
 
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//use Doctrine\Persistence\ManagerRegistry;
 
class RegisterController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Attributs depuis PHP 8 :
    #[Route('/inscription', name: 'register')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
 
        $form = $this->createForm(RegisterType::class, $user);
 
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {
 
            $user = $form->getData();
            $password = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }
 
        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}

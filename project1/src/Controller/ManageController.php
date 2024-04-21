<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;

class ManageController extends AbstractController
{
    #[Route('/manage', name: 'app_manage')]
    public function index(): Response
    {

        $post = new Post(); //créer un nouvel objet (un espace ds la table post)

        // Créer un formulaire Symfony pour l'entité Post
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request); //La méthode handleRequest() du la classe Form 
        //permet de récupérer les valeurs des champs dans les inputs du formulaire.

        // Vérifier si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) { //savoir si on est effectivement en méthode POST //a méthode isValid() permet de valider les données saisies
            // Enregistrer le nouveau post dans la base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }
        // Afficher le formulaire dans un template Twig
        return $this->render('blog/add.html.twig', [
            'form' => $form->createView(),
        ]);

        return $this->render('manage/index.html.twig', [
            'controller_name' => 'ManageController',
        ]);
    }
}

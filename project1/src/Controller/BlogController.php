<?php
//fonctionnalitées du site 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BlogController extends AbstractController
{

    private $entitymanager;

    public function __construct(EntityManagerInterface $entitymanager)
    {
        $this->entitymanager = $entitymanager;
    }

    #[Route('/blog', name: 'blog')] //renvoyer la page :blog sur le bon twig
    public function blog(): Response
    {
        $post = $this->entitymanager->getRepository(Post::class)->findAll();

        return $this->render('blog/index.html.twig', [
            'post' => $post,
        ]);
    }


    #[Route('/blog/{id}', name: 'detail')] //renvoyer la page :blog/id sur le bon twig
    public function detailOfArticle($id): Response
    {
        $detail = $this->entitymanager->getRepository(Post::class)->findOneBy(['id' => $id]);

        return $this->render('blog/detail.html.twig', [
            'detail' => $detail,
        ]);
    }

    // #[Route('/formulaire', name: 'form')] //renvoyer la page :blog sur le bon twig
    // public function form(): Response
    // {
    //     $form = $this->entitymanager->getRepository(Post::class)->findAll();

    //     return $this->render('formulaire/form.html.twig', [
    //         'form' => $form,
    //     ]);
    // }

    #[Route('/blog/{id}/delete', name: 'blog_delete')]
    public function deleteBlog($id, EntityManagerInterface $entityManager): Response
    {
        $blog = $entityManager->getRepository(Post::class)->find($id); //recupere l'entité blog qui correspond a l'id a partir de la bdd

        // Vérifier si l'utilisateur a le droit de supprimer le blog
        if (!$this->isGranted('ROLE_ADMIN') || !$blog) {
            throw $this->createAccessDeniedException();
        }

        $entityManager->remove($blog);
        $entityManager->flush();

        // Rediriger vers la page de blog après la suppression
        return $this->redirectToRoute('blog');
    }

    #[Route('/formulaire/add', name: 'add_blog')]
    public function add(): Response
    {
        return $this->render('formulaire/form.html.twig');
    }

    #[Route('/formulaire/add', name: 'add_blog_submit', methods: ['POST'])]
    public function addSubmit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $title = $request->request->get('title');
        $content = $request->request->get('content');
        $author = $request->request->get('author'); // Récupération de l'auteur depuis le formulaire
        $dateString = $request->request->get('date');
        $date = \DateTime::createFromFormat('Y-m-d', $dateString);

        // Création d'une nouvelle instance de l'entité Post
        $post = new Post();
        $post->setTitle($title);
        $post->setContent($content);
        $post->setAuthor($author); // Attribution de l'auteur à l'article
        $post->setDate($date); // Attribution de la date à l'article


        // Enregistrement de l'article dans la base de données
        $entityManager->persist($post);
        $entityManager->flush();

        // Redirection vers la page de blog après l'ajout de l'article
        return $this->redirectToRoute('blog_index');
    }
}

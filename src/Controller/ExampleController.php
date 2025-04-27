<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController
{
    public function __construct(readonly EntityManagerInterface $em)
    {
    }

    #[Route('example', name: 'example')]
    public function index()
    {
        $post = new Post();
        $post->setTitle('newTitle');
        $post->setDescription('newDescription');

        $this->em->persist($post);

        $this->em->flush();

        return new Response('done');
    }

    #[Route('show/{id}', name: 'show')]
    public function show(Post $id)
    {
        $this->em->getRepository(Post::class)->findOneBySomeField($id)->setTitle('editTitle');
    }
}
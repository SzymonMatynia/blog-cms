<?php

namespace App\Controller;

use App\Service\MessageGenerator;
use App\Service\PostCommentsService\PostCommentsServiceInterface;
use App\Entity\Post;
use App\Entity\PostComments;
use App\Form\PostCommentsType;
use App\Repository\PostRepository\PostRepositoryPrimaryInterface;
use App\Service\PostService\PostServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Service\CustomSerializer\CustomSerializerInterface;


/**
 * @Route("/")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="post_index", methods="GET")
     * @param PostRepositoryPrimaryInterface $postRepository
     * @param MessageGenerator $messageGenerator
     * @return Response
     */
    public function index(PostServiceInterface $postService, MessageGenerator $messageGenerator,
                          CustomSerializerInterface $customSerializer): Response
    {
        $x = $customSerializer->normalizeObject($messageGenerator);
        return $this->render('post/index.html.twig', [
            'posts' => $postService->findAll(),
            'message' => $messageGenerator->getHappyMessage(),
            'x' => $x
        ]);
    }




    /**
    * @Route("/{id}", name="post_show", methods="GET|POST", requirements={"id"="\d+"})
    * @param Request $request
    * @param Post $post
    * @param PostCommentsServiceInterface $postCommentsService
    * @return Response
    */
    public function show(Request $request, Post $post, PostCommentsServiceInterface $postCommentsService): Response
    {
        $form = $this->createForm(PostCommentsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postCommentsService->addComment($post, $form->getData());

            return $this->redirectToRoute('post_show', [
                'id' => $post->getId()
            ]);
            /*return $this->render('post/show.html.twig', [
                'post' => $post,
                'form' => $form->createView()

            ]);*/
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),

            ]);
    }

}

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
    private $postService;
    private $messageGenerator;
    private $postCommentsService;
    //todo
    public function __construct(PostServiceInterface $postService,
                                MessageGenerator $messageGenerator,
                                PostCommentsServiceInterface $postCommentsService)
    {
        $this->postService = $postService;
        $this->messageGenerator = $messageGenerator;
        $this->postCommentsService = $postCommentsService;
    }

    /**
     * @Route("/", name="post_index", methods="GET")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'posts' => $this->postService->findAll(),
            'message' => $this->messageGenerator->getHappyMessage(),
        ]);
    }




    /**
    * @Route("/{id}", name="post_show", methods="GET|POST", requirements={"id"="\d+"})
    * @param Request $request
    * @param Post $post
    * @return Response
    */
    public function show(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostCommentsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $this->postCommentsService->addComment($post, $form->getData());

            return $this->redirectToRoute('post_show', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),

            ]);
    }

}

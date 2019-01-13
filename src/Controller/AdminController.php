<?php

namespace App\Controller;


use App\Entity\PostTags;
use App\Service\PostService\PostServiceInterface;
use App\Service\PostTagsService\PostTagsService;
use App\Service\PostTagsService\PostTagsServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Post;
use App\Form\PostType;
use App\Form\PostTagsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    private $postService;
    private $postTagsService;


    public function __construct(PostServiceInterface $postService, PostTagsServiceInterface $postTagsService)
    {
        $this->postService = $postService;
        $this->postTagsService = $postTagsService;
    }


    /**
     * @Route("/", name="admin", methods="GET")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'posts' => $this->postService->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_new", methods="GET|POST")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->postService->addPost($form->getData());
            return $this->redirectToRoute('post_index');
        }

        return $this->render('admin/new.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/{id}/edit", name="post_edit", methods="GET|POST", requirements={"id"="\d+"})
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function edit(Request $request, Post $post): Response
    {

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->postService->editPost($post, $form->getData());

            return $this->redirectToRoute('post_edit', ['id' => $post->getId()]);

        }

        return $this->render('admin/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="post_delete", methods="DELETE", requirements={"id"="\d+"})
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function delete(Request $request, Post $post): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $this->postService->deletePost($post);
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * @Route("/{id}/tags/add", name="add_tags", methods="GET|POST", requirements={"id"="\d+"})
     * @param Request $request
     * @param Post $post
     * @return Response
     */
    public function newTags(Request $request, Post $post): Response
    {
        $form = $this->createForm(PostTagsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->postTagsService->addTags($post, $form->getData());

            return $this->redirectToRoute('add_tags', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('admin/tags.html.twig', [
            'form' => $form->createView(),
            'postTags' => $post->getPostTags(),
            'post' => $post

        ]);
    }

    

}

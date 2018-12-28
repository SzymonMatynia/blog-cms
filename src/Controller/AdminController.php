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

/**
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{


    /**
     * @Route("/", name="admin", methods="GET")
     */
    public function index(PostServiceInterface $postService)
    {
        return $this->render('admin/index.html.twig', [
            'posts' => $postService->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="post_new", methods="GET|POST")
     * @param Request $request
     * @param PostServiceInterface $postService
     * @return Response
     */
    public function new(Request $request, PostServiceInterface $postService, PostTagsServiceInterface $postTagsService): Response
    {
        $form = $this->createForm(PostType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postService->addPost($form->getData());
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
     * @param PostServiceInterface $postService
     * @return Response
     * @throws \Exception
     */
    public function edit(Request $request, Post $post, PostServiceInterface $postService): Response
    {

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postService->editPost($post, $form->getData());

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
     * @param PostServiceInterface $postService
     * @return Response
     */
    public function delete(Request $request, Post $post, PostServiceInterface $postService): Response
    {
        if ($this->isCsrfTokenValid('delete'.$post->getId(), $request->request->get('_token'))) {
            $postService->deletePost($post);
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * @Route("/{id}/addtags", name="add_tags", methods="GET|POST", requirements={"id"="\d+"})
     * @param Request $request
     * @param Post $post
     * @param PostTagsServiceInterface $postTagsService
     * @return Response
     */
    public function newTags(Request $request, Post $post, PostTagsService $postTagsService): Response
    {
        $form = $this->createForm(PostTagsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $postTagsService->addTags($post, $form->getData());
            return $this->redirectToRoute('post_index');
        }

        return $this->render('admin/_form.html.twig', [
            'form' => $form->createView(),

        ]);
    }
    

}

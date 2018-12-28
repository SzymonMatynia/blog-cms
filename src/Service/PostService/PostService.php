<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 18.12.18
 * Time: 20:46
 */

namespace App\Service\PostService;
use App\Entity\Post;
use App\Repository\PostRepository\PostRepositoryPrimaryInterface;
use App\Repository\PostTagsRepository\PostTagsRepositoryPrimaryInterface;
class PostService implements PostServiceInterface
{
    private $postRepository;
    private $postTagsRepository;
    public function __construct(PostRepositoryPrimaryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @param $data
     */
    public function addPost($data)
    {
        $this->postRepository->addPost($data);
    }

    /**
     * @param Post $post
     * @param $data
     */
    public function editPost(Post $post, $data)
    {
        $this->postRepository->editPost($post, $data);
    }

    /**
     * @param Post $post
     */
    public function deletePost(Post $post)
    {
        $this->postRepository->deletePost($post);
    }

    /**
     *
     */

    public function findAll()
    {
        return $this->postRepository->findAll();
    }

}

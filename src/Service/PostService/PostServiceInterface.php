<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 21.12.18
 * Time: 14:35
 */

namespace App\Service\PostService;
use App\Entity\Post;

interface PostServiceInterface
{
    public function addPost($data);
    public function editPost(Post $post, $data);
    public function deletePost(Post $post);
    public function findAll();
}
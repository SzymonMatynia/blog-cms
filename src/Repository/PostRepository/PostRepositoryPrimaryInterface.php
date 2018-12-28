<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 21.12.18
 * Time: 14:25
 */

namespace App\Repository\PostRepository;
use App\Entity\Post;


interface PostRepositoryPrimaryInterface
{
    public function addPost($data);
    public function editPost(Post $post, $data);
    public function deletePost(Post $post);
    public function findAll();

}
<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 22.12.18
 * Time: 16:50
 */

namespace App\Service\PostCommentsService;
use App\Entity\PostComments;
use App\Entity\Post;

interface PostCommentsServiceInterface
{
    public function addComment(Post $post, $form);

}
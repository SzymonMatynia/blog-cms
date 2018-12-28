<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 22.12.18
 * Time: 16:49
 */

namespace App\Repository\PostCommentsRepository;
use App\Entity\PostComments;
use App\Entity\Post;
interface PostCommentsRepositoryPrimaryInterface
{
    public function addComment(Post $post, $form);
}
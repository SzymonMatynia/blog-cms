<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 27.12.18
 * Time: 20:44
 */

namespace App\Service\PostTagsService;
use App\Entity\Post;

interface PostTagsServiceInterface
{
    public function addTags(Post $post, $tag);
}
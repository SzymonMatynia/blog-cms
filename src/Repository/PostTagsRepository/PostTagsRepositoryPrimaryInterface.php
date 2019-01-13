<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 27.12.18
 * Time: 19:42
 */

namespace App\Repository\PostTagsRepository;
use App\Entity\Post;
use App\Entity\PostTags;
interface PostTagsRepositoryPrimaryInterface
{
    public function addTags(Post $post, $tag);
}
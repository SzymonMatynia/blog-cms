<?php
/**
 * Created by PhpStorm.
 * User: eterxoz
 * Date: 22.12.18
 * Time: 16:50
 */

namespace App\Service\PostCommentsService;

use App\Service\PostCommentsService\PostCommentsServiceInterface;
use App\Entity\PostComments;
use App\Entity\Post;
use App\Repository\PostCommentsRepository\PostCommentsRepositoryPrimaryInterface;

class PostCommentsService implements PostCommentsServiceInterface
{
    private $postCommentsRepository;
    public function __construct(PostCommentsRepositoryPrimaryInterface $postCommentsRepository)
    {
        $this->postCommentsRepository = $postCommentsRepository;
    }

    public function addComment(Post $post, $form)
    {
        $this->postCommentsRepository->addComment($post, $form);
    }
}
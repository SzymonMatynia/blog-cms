<?php

namespace App\Repository\PostCommentsRepository;

use App\Entity\PostComments;
use App\Entity\Post;
use App\Repository\PostCommentsRepository\PostCommentsRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method PostComments|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostComments|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostComments[]    findAll()
 * @method PostComments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostCommentsRepository extends ServiceEntityRepository implements PostCommentsRepositoryInterface
{
    private $entityManager;
    public function __construct(RegistryInterface $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, PostComments::class);
    }

    // /**
    //  * @return PostComments[] Returns an array of PostComments objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PostComments
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function addComment(Post $post, $form)
    {
        $post->addPostComment($form);
        $this->entityManager->persist($form);
        $this->entityManager->flush();
    }
}

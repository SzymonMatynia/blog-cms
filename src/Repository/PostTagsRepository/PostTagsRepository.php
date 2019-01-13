<?php

namespace App\Repository\PostTagsRepository;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\PostTags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Service\CustomSerializer\CustomSerializerInterface;

/**
 * @method PostTags|null find($id, $lockMode = null, $lockVersion = null)
 * @method PostTags|null findOneBy(array $criteria, array $orderBy = null)
 * @method PostTags[]    findAll()
 * @method PostTags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostTagsRepository extends ServiceEntityRepository implements PostTagsRepositoryInterface
{
    private $customSerializer;
    private $entityManager;
    //private $postTags;
    public function __construct(RegistryInterface $registry,
                                EntityManagerInterface $entityManager,
                                CustomSerializerInterface $customSerializer
                                )
    {
        $this->customSerializer = $customSerializer;
        $this->entityManager = $entityManager;
        parent::__construct($registry, PostTags::class);
    }

    // /**
    //  * @return PostTags[] Returns an array of PostTags objects
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
    public function findOneBySomeField($value): ?PostTags
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function addTags(Post $post, $tag)
    {
        $tagArray = explode(' ', $tag->getTag());
        foreach($tagArray as $value)
        {
            $postTag =  new PostTags();
            $postTag->setTag($value)->setPost($post);
            $this->entityManager->persist($postTag);

        }

        $this->entityManager->flush();


    }

}

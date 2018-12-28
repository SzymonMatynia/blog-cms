<?php

namespace App\Repository\PostRepository;


use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    private $entityManager;
    public function __construct(RegistryInterface $registry, EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
        parent::__construct($registry, Post::class);
    }

    // /**
    //  * @return Post[] Returns an array of Post objects
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
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    /**
     * @param $data
     */
    public function addPost($data)
    {
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    /**
     * @param Post $post
     * @param $data
     * @throws \Exception
     */
    public function editPost(Post $post, $data)
    {
        $this->updateUpdateAt($post)
            ->entityManager
            ->persist($data);

        $this->entityManager->flush();
    }

    /**
     * @param Post $post
     * @return $this
     * @throws \Exception
     */
    private function updateUpdateAt(Post $post)
    {
        $post->setUpdatedAt(new \DateTime('now'));
        return $this;
    }

    /**
     * @param Post $post
     */
    public function deletePost(Post $post)
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }

}

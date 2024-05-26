<?php

namespace App\Repository;

use App\Entity\Borrowing;
use App\Entity\BookSearch;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use App\Form\BookSearchType;

/**
 * @extends ServiceEntityRepository<Borrowing>
 *
 * @method Borrowing|null find($id, $lockMode = null, $lockVersion = null)
 * @method Borrowing|null findOneBy(array $criteria, array $orderBy = null)
 * @method Borrowing[]    findAll()
 * @method Borrowing[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BorrowingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Borrowing::class);
    }

    public function findMostPopularBooks()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT b.title, COUNT(b.id) AS howMany
        FROM App\Entity\Borrowing br
        INNER JOIN br.book b
        GROUP BY b.title
        ORDER BY howMany DESC'
    );

    return $query->getResult();
}

public function findMostPopularBooksQb()
{
    return $this->createQueryBuilder('b')
        ->addSelect('bk.title, COUNT(b) AS howMany')
        ->join('b.book', 'bk')
        ->groupBy('bk.title')
        ->orderBy('howMany','DESC')
        ->getQuery()
        ->getResult();
}

public function findMostPopularBooksDql()
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery('
        SELECT bk.title, COUNT(b) AS howMany
        FROM App\Entity\Borrowing b
        JOIN b.book bk
        GROUP BY bk.title
        ORDER BY howMany DESC'
    );

    return $query->getResult();
}

public function BorrowingBook(Request $request, BorrowingRepository $repository) {
    $bookSearch = new BookSearch();
    $form = $this->createForm(BookSearchType::class,$bookSearch);
    $form->handleRequest($request);
    $borrowings= [];
    if($form->isSubmitted() && $form->isValid()) {
        $book = $bookSearch->getBook();
        if ($book!="")
        $borrowings=$repository->findBy( array('book' => $book) );
        else
            $borrowings= $repository->findAll();
    }
    return $this->render('report/BorrowingBook.html.twig',
    ['form' => $form->createView(),'borrowings' => $borrowings]);
}


//    /**
//     * @return Borrowing[] Returns an array of Borrowing objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Borrowing
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

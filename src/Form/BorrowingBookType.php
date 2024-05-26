<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Borrowing;
use App\Entity\Student;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class BorrowingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateBorrowed', DateTimeType::class, [
                'date_label' =>'Starts On',
            ])
            ->add('bookReturned')
            ->add('student', EntityType::class, [
                'class' => Student::class,
'choice_label' => 'id',
            ])
            ->add('book', EntityType::class, [
                'class' => Book::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Borrowing::class,
        ]);
    }
}

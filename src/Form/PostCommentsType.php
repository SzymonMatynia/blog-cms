<?php

namespace App\Form;

use App\Entity\PostComments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;


class PostCommentsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author')
            ->add('body', TextareaType::class)
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'attr'        => array(
                    'options' => array(
                        'theme' => 'dark',
                        'type'  => 'image',
                        'size'  => 'normal'
                    )
                ),
                'mapped'      => false,
                'constraints' => array(
                    new RecaptchaTrue()
                )
            ))
            ->add('save', SubmitType::class, ['label' => 'Dodaj komentarz'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PostComments::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomPrenom', TextType::class, array(
                'label'=> 'الإســـم واللقـــب',
                'attr'=> array(
                    'placeholder'=> 'الإســـم واللقـــب'
                )
            ))
            ->add('email', TextType::class, array(
                'label'=> 'البريد الإلكتروني',
                'attr'=> array(
                    'placeholder'=> 'البريد الإلكتروني'
                )
            ))
            ->add('telephone', TextType::class, array(
                'label'=> 'رقم الهاتف',
                'attr'=> array(
                    'placeholder'=> 'رقم الهاتف'
                )
            ))
            ->add('sujet', TextType::class, array(
                'label'=> 'الموضوع',
                'attr'=> array(
                    'placeholder'=> 'الموضوع'
                )
            ) )
            ->add('message', TextareaType::class, array(
                'label'=> 'الرسالة',
                'attr'=> array(
                    'placeholder'=> 'الرسالة'
                )
            ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

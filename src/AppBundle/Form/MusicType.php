<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MusicType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('titre',          TextType::class)
        ->add('genre',          TextType::class)
        ->add('photo',          PhotoType::class)
        ->add('description',    TextareaType::class)
        ->add('artiste',        TextType::class)
        ->add('temps',          IntegerType::class)
        ->add('telechargeable', CheckboxType::class,
        array(
                'required' => false,
         ))
        ->add('date_creation',  DateType::class, 
            array(
            'widget' => 'single_text',
       ))
        ->add('morceau',        MorceauType::class)
        ->add('save',           SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Music'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_music';
    }


}

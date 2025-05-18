<?php

namespace App\Form;

use App\Entity\Cliente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClienteTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('nombre', TextType::class, [
                'label' => 'Tu Nombre',
                // 'disaabled' => true,
                // 'disabled' => $options['isEdit'],
            ])
            ->add('fechaNacimiento', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('pais', CountryType::class)
            ->add('categoria', ChoiceType::class, [
                'multiple' => true,
                // 'choices' => $categorias,
                'choices' => $options['categorias'],
                'expanded' => true,
            ])
            ->add('observaciones')
            ->add('grabar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('categorias');

        // $resolver->setDefault('isEdit', false);

        $resolver->setDefaults([
            'data_class' => Cliente::class,
        ]);
    }
}

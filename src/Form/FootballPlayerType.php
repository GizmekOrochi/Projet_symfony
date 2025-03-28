<?php

namespace App\Form;

use App\Entity\Product\FootballPlayer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FootballPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, ['label' => 'Name'])
            ->add('FirstName', TextType::class, ['label' => 'First Name'])
            ->add('valueMoney', IntegerType::class, ['label' => 'Value Money'])
            ->add('CurrentClub', TextType::class, [
                'label'    => 'Current Club',
                'required' => false,
            ])
            ->add('CurrentRole', TextType::class, [
                'label'    => 'Current Role',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FootballPlayer::class,
        ]);
    }
}

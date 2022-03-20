<?php

namespace App\Form\Settings\WorkingTime;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class WorkingTimeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('monday', WorkingDayFormType::class, [
                'required' => true,
            ])
            ->add('tuesday', WorkingDayFormType::class, [
                'required' => true,
            ])
            ->add('wednesday', WorkingDayFormType::class, [
                'required' => true,
            ])
            ->add('thursday', WorkingDayFormType::class, [
                'required' => true,
            ])
            ->add('friday', WorkingDayFormType::class, [
                'required' => true,
            ])
            ->add('vacation', WorkingDayFormType::class, [
                'required' => true,
            ]);
    }
}

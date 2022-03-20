<?php

namespace App\Form\Settings;

use App\Entity\MedicalSpecialty;
use App\Form\Settings\WorkingTime\WorkingTimeFormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class DoctorSettingsFormType extends AbstractSettingsFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('medicalSpecialty', EntityType::class, [
                'required' => true,
                'class' => MedicalSpecialty::class
            ])
            ->add('workingHours', WorkingTimeFormType::class, [
                'required' => true,
            ]);
    }
}

<?php

namespace App\Controller\Patient\Chat;

use App\Controller\AbstractParticularConversationController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/patient")
 */
class ParticularViewController extends AbstractParticularConversationController
{
    protected function getHeader(): string
    {
        $doctor = $this->conversation->getDoctor()->getDoctor();

        return sprintf('Czat z lek. %s %s', $doctor->getFirstName(), $doctor->getLastName());
    }

    protected function getTemplatePath(): string
    {
        return 'patient/particular_chat.html.twig';
    }
}

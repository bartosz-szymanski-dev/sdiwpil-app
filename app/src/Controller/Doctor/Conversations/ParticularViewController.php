<?php

namespace App\Controller\Doctor\Conversations;

use App\Controller\AbstractParticularConversationController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/doctor")
 */
class ParticularViewController extends AbstractParticularConversationController
{
    protected function getHeader(): string
    {
        // TODO: Implement getHeader() method.
        return '';
    }

    protected function getTemplatePath(): string
    {
        // TODO: Implement getTemplatePath() method.
        return '';
    }
}

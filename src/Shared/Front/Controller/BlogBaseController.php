<?php

namespace App\Shared\Front\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

abstract class BlogBaseController extends AbstractController
{
    public function response(string $view, array $params = []): Response
    {
        return $this->render($view, $this->getParameters($params));
    }

    private function getParameters(array $params = []): array
    {
        return array_merge(
            ['title' => 'Is a wonderfull Blog'],
            $params
        );
    }
}

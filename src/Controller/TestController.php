<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/test")
 */
class TestController extends AbstractController
{
    /**
     * @Route("/car")
     */
    public function car()
    {
        $msg = 'Testing car';

        return new Response($msg,  Response::HTTP_OK,
            ['content-type' => 'text/plain']);
    }

    /**
     * @Route("/book")
     */
    public function book()
    {
        $msg = 'Testing book';

        return new Response($msg,  Response::HTTP_OK,
            ['content-type' => 'text/plain']);
    }
}
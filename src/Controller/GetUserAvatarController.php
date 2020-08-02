<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class GetUserAvatarController extends AbstractController
{
    
    public function __invoke(){
        $avatar = $this->getUser()->getAvatar();
        $response = new Response(stream_get_contents($avatar));
        $response->headers->set('Content-Type', 'image/png');
        $response->send();
    }
}

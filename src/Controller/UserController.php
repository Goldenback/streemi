<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
	#[Route('/mon-profil', name: 'user_show')]
	public function user_show(): Response
	{
		dd($this->getUser());
		return $this->render('user/index.html.twig', [
			'user' => $this->getUser(),
		]);
	}
}

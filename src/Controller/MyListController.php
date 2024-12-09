<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MyListController extends AbstractController
{
	#[Route('/my_list', name: 'my_list')]
	public function my_list(): Response
	{
		return $this->render('pages/my_list/index.html.twig', [
			'controller_name' => 'MyListController',
		]);
	}
}
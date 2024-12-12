<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionController extends AbstractController
{
	#[Route('/subscription', name: 'user_subscriptions')]
	public function index(): Response
	{
		return $this->render('subscription/index.html.twig', [
			'controller_name' => 'SubscriptionController',
		]);
	}
}

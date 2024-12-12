<?php

namespace App\Controller;

use App\Entity\Subscription;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SubscriptionController extends AbstractController
{
	#[Route('/subscription', name: 'user_subscriptions_show')]
	public function index(EntityManagerInterface $manager): Response
	{
		/**@var User $user */
		$user = $this->getUser();

		return $this->render('pages/subscribe/index.html.twig', [
			'currentSubscription' => $user->getCurrentSubscription(),
			'subscriptions' => $manager->getRepository(Subscription::class)->findAll(),
		]);
	}
}

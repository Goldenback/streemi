<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
	#[Route('/admin', name: 'admin_index')]
	public function admin_index(): Response
	{
		return $this->render('pages/admin/admin.html.twig');
	}
}

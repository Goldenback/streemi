<?php

namespace App\Controller;

use App\Entity\Media;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MediaController extends AbstractController
{
	#[Route('/discover', name: 'discover')]
	public function discover(MediaRepository $mediaRepository): Response
	{
		return $this->render('pages/media/discover.html.twig', [
			'movies' => $mediaRepository->findTrendingMedias(3),
		]);
	}

	#[Route('/media/{id}', name: 'media_show')]
	public function media_show(Media $media): Response
	{
		return $this->render('pages/media/show.html.twig', [
			'media' => $media,
		]);
	}
}

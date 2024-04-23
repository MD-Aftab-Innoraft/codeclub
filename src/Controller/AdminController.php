<?php

namespace App\Controller;

use App\Entity\Profile;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AdminController acting as the entry point of the application
 */
class AdminController extends AbstractController
{
  /**
   * @var EntityManagerInterface $em
   *  An object of type EntityManagerInterface.
   */
  private $em;

  /**
   * Constructor to inject dependencies.
   *
   * @var EntityManagerInterface $em
   *  Initializes an object of type EntityManagerInterface.
   */
  public function __construct(EntityManagerInterface $em)
  {
    $this->em = $em;
  }

  /**
   * Method to redirect to the dashboard.
   */
  #[Route('/dashboard', name: 'app_dashboard')]
  public function showDashboard()
  {
    $userId = $this->getUser()->getId();
    if ($this->getUser()->getUserType() == "admin") {
      return $this->redirectToRoute("app_admin-dashboard");
    }
    $profile = $this->em->getRepository(Profile::class)->findOneBy(['user' => $userId]);

    return $this->render('dashboard/dashboard.html.twig', [
      'profile' => $profile,
    ]);
  }
}

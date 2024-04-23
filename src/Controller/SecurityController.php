<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController manages routes related to security.
 */
class SecurityController extends AbstractController
{
  /**
   * Method to handle the route '/login'.
   */
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, EntityManagerInterface $em): Response
    {
      //
      if ($this->getUser()) {
        $user = $em->getRepository(User::class)->findOneBy(['id' => $this->getUser()->getId()]);
        $userRole = $user->getUserType();

        if ($userRole == 'admin') {
          return $this->redirectToRoute('app_admin-dashboard');
        }
        return $this->redirectToRoute('app_dashboard');
      }
      // Get the login error if there is one.
      $error = $authenticationUtils->getLastAuthenticationError();
      // Last username entered by the user.
      $lastUsername = $authenticationUtils->getLastUsername();

      // Specifying the twig file to be rendered and passing relevant data.
      return $this->render('security/login.html.twig', [
        'last_username' => $lastUsername, 'error' => $error]);
    }

  /**
   * Method to handle the route '/logout'.
   */
    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
      throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

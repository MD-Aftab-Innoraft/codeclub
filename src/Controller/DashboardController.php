<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Profile;
use App\Form\ProfileType;
use Symfony\Bridge\Twig\AppVariable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class DashboardController manages routes related to dashboard.
 */
class DashboardController extends AbstractController
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
   * Method to handle the route '/admin-dashboard'.
   */
  #[Route('/admin-dashboard', name: 'app_admin-dashboard')]
  public function showAdminDashboard()
  {
    // Getting the user id of the user.
    $userId = $this->getUser()->getId();

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('dashboard/adminDashboard.html.twig', [
      'userId'=> $userId,
    ]);
  }

  /**
   * Method to handle the route '/edit-profile'.
   */
  #[Route('/edit-profile', name: 'app_edit-profile')]
  public function editProfile(Request $request)
  {
    // To deny users access to the opage unless they are authenticated.
    $this->denyAccessUnlessGranted(attribute: 'IS_AUTHENTICATED_FULLY');
    // Getting the user id of the user.
    $id = $this->getUser()->getId();
    $profile = $this->em->getRepository(Profile::class)->findOneBy(['user'=> $id]);
    // If user hasn't created his profile, redirect to create one.
    if (!$profile) {
      return $this->redirectToRoute('app_create-profile');
    }

    $form = $this->createForm(ProfileType::class, $profile);
    // Handling theform submit request.
    $form->handleRequest($request);

    // If the form is submitted without errors.
    if ($form->isSubmitted() && $form->isValid()) {
      // We want to save the profile data to the database.
      $this->em->persist($profile);
      // Synchronizes the in-memory state of managed objects with the database.
      $this->em->flush();
      // Flash message for successful user action.
      $this->addFlash('success', 'Profile changes saved successfully!');
      // Redirecting to the dashboard on successful profile updation.
      return $this->redirectToRoute('app_dashboard');
    }

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('profile/editProfile.html.twig', [
      'profileForm' => $form->createView(),
    ]);
  }

  /**
   * Method to handle the route '/create-profile'.
   */
  #[Route('/create-profile', name: 'app_create-profile')]
  public function newProfile(Request $request)
  {
    // Creating a new Profile object.
    $profile = new Profile();
    // Hnadling form responsible for profile creation.
    $form = $this->createForm(ProfileType::class, $profile);
    // Handling the submit action on the form.
    $form->handleRequest($request);

    // If form is submitted without errors.
    if ($form->isSubmitted() && $form->isValid()) {
      $this->em->persist($profile);
      $this->em->flush();
      // Flash message for successful user action.
      $this->addFlash('success', 'Profile saved successfully!');
      // Redirecting to dashboard on successful profile creation.
      return $this->redirectToRoute('app_dashboard');
    }
    // Specifying the twig template to render along with relevant data.
    return $this->render('profile/createProfile.html.twig', [
      'profileForm' => $form->createView(),
    ]);
  }

  /**
   * Method to handle the route '/user-profile'.
   */
  #[Route('/user-profile', name: 'app_user_profile')]
  public function showProfile(Request $request)
  {
    // Fetching the profile of the user with the help of user id.
    $id = $this->getUser()->getId();
    $profile = $this->em->getRepository(Profile::class)->findOneBy(['user' => $id]);

    // If the profile of the user doesn't exist, redirect to create one.
    if (!$profile) {
      return $this->redirectToRoute('app_create-profile');
    }

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('profile/showProfile.html.twig', [
      'profile' => $profile,
    ]);
  }
}


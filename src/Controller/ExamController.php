<?php

namespace App\Controller;

use App\Entity\Exams;
use App\Entity\ExamUserMap;
use App\Form\ExamsType;
use App\Entity\Questions;
use App\Form\ExamUserMapType;
use App\Form\QuestionsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class ExamController manages routes related to exams.
 */
class ExamController extends AbstractController
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
   * Method to handle the route '/create-exam'.
   */
  #[Route('/create-exam', name:'app_create-exam')]
  public function createExam(Request $request)
  {
    // Creating a new Exams object.
    $exam = new Exams();

    // Handling the creation of a new Exam with the help of form.
    $form = $this->createForm(ExamsType::class, $exam);
    $form->handleRequest($request);

    // If the form is submitted without errors.
    if ($form->isSubmitted() && $form->isValid())
    {
      $this->em->persist($exam);
      $this->em->flush();
      // Flash messasge for successful exam creation.
      $this->addFlash('success', 'Exam created successfully!');
      // Redirecting to allow another exam creation.
      return $this->redirectToRoute('app_create-exam');
    }

    // Synchronizes the in-memory state of managed objects with the database.
  return $this->render('exams/createExam.html.twig',[
      'createExam' => $form->createView(),
    ]);
  }

  /**
   * Method to handle the route '/upcoming-exams'.
   */
  #[Route('/upcoming-exams', name: 'app_upcoming-exams')]
  public function showUpcomingExams()
  {
    // Deny access to the page if user isn't authenticated.
    $this->denyAccessUnlessGranted(attribute: 'IS_AUTHENTICATED_FULLY');
    // Getting the list of all exams and applied exams.
    $userId = $this->getUser()->getId();
    $allExams = $this->em->getRepository(Exams::class)->findAll();
    $appliedExams = $this->em->getRepository(ExamUserMap::class)->findBy(['userId' => $userId]);

    // Saving the exam ids of the applied exams.
    $appliedExamsId = array();
    foreach ($appliedExams as $exam) {
      // $appliedExamsId = $exam->getId();
      array_push($appliedExamsId, $exam->getId());
    }

    // Getting the list of upcoming exams.
    $upcomingExams = array();
    foreach ($allExams as $exam)
    {
      // If an exam isn't applied for, we add it to upcoming exams.
      if(!in_array($exam->getId(), $appliedExamsId)) {
        array_push($upcomingExams, $exam);
      }
    }

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('exams/upcomingExams.html.twig',[
      'upcomingExams' => $upcomingExams,
    ]);
  }

  /**
   * Method to handle the route '/created-exams'.
   */
  #[Route('/created-exams', name: 'app_created-exams')]
  public function showCreatedExams(Request $request)
  {
    // Getting the list of applied exams with the help of user id.
    $id = $this->getUser()->getId();
    $createdExams = $this->em->getRepository(Exams::class)->findBy(['userid' => $id]);

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('exams/createdExams.html.twig', [
      'createdExams' => $createdExams,
    ]);
  }

  /**
   * Method to handle the route '/apply-exam/{examId}'.
   */
  #[Route('/apply-exam/{examId}', name:'app_apply-exam')]
  public function applyExam(Request $request, int $examId)
  {
    // Creating an object of ExamUserMap.
    $examUserMapping = new ExamUserMap();

    $myexamId = $examId;
    $examDetails = $this->em->getRepository(Exams::class)->findOneBy(['id' => $myexamId]);

    // Handling the creation of a new ExamUserMap with the help of form.
    $form = $this->createForm(ExamUserMapType::class, $examUserMapping);
    $form->handleRequest($request);

    // If form is submitted without errors.
    if ($form->isSubmitted() && $form->isValid()) {
      // We want to save the profile data to the database.
      $this->em->persist($examUserMapping);
      // Synchronizes the in-memory state of managed objects with the database.
      $this->em->flush();

      // Flash message for successful user action.
      $this->addFlash('success', 'Succesfully applied for exam.');
      return $this->redirectToRoute('app_upcoming-exams');
    }

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('exams/applyForExam.html.twig', [
        'examUserMapping'=> $form->createView(),
        'examDetails' => $examDetails,
    ]);
  }

  /*
   * Method to handle the route '/applied-exams'.
   */
  #[Route('/applied-exams', name:'app_applied-exams')]
  public function showAppliedExams(Request $request)
  {
    // Getting the list of applied exams.
    $userId = $this->getUser()->getId();
    $appliedExams = $this->em->getRepository(ExamUserMap::class)->findBy(['userId' => $userId]);

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('exams/appliedExams.html.twig',[
      'appliedExams' => $appliedExams,
    ]);
  }

  /*
   * Method to handle the route 'begin-exam/{examId}'.
   */
  #[Route('begin-exam/{examId}', name: 'app_begin-exam')]
  public function beginExam(Request $request, int $examId)
  {
    // Getting the exam details with the help of exam id.
    $myExamId = $examId;
    $examDetails = $this->em->getRepository(Exams::class)->findOneBy(['id'=> $myExamId]);

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('exams/examInstructions.html.twig', [
      'examDetails' => $examDetails,
    ]);
  }

  /*
   * Method to handle the route '/add-question'.
   */
  #[Route('/add-question', name: 'app_add-question')]
  public function addQuestion(Request $request)
  {
    // Creating a new Question object.
    $question = new Questions();

    // Handling the creation of a new Question with the help of form.
    $form = $this->createForm(QuestionsType::class, $question);
    $form->handleRequest($request);

    // If the form is submitted without errors.
    if ($form->isSubmitted() && $form->isValid()) {
      // We want to save the question to the database.
      $this->em->persist($question);
      // Synchronizes the in-memory state of managed objects with the database.
      $this->em->flush();
      // Flash message for successful user action.
      $this->addFlash('success', 'Question added successfully!');

      // Redirecting to add question page to allow another question creation.
      return $this->redirectToRoute('app_add-question');
    }

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('questions/addQuestion.html.twig',[
      'questionForm' => $form->createView(),
    ]);
  }

  /**
   * Method to handle the route '/show-questions'.
   */
  #[Route('/show-questions', name: 'app_show-questions')]
  public function showQuestions() {
    // Getting the list of questions.
    $questions = $this->em->getRepository(Questions::class)->findAll();

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('questions/showQuestions.html.twig',[
      'questions' => $questions,
    ]);
  }
}

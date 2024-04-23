<?php

namespace App\Controller;

use App\Entity\Questions;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class QuizContoller manages routes related to the exam(quiz).
 */
class QuizController extends AbstractController
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
   * Method to handle the route '/quiz'.
   */
  #[Route('/quiz', name: 'app_quiz')]
  public function index(): Response
  {
    // Getting the list of pre-defined questions from the database.
    $questions = $this->em->getRepository(Questions::class)->findAll();

    // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('quiz/index.html.twig', [
      'questions' => $questions,
    ]);
  }

  /**
   * Method to handle the route '/quiz/submit'.
   */
  #[Route('/quiz/submit', name: 'submit_quiz', methods: ['POST'])]
  public function submit(Request $request): Response
  {
    // Fetching the submitted answers as a 2D array.
    $submittedDetails = $request->request->all();
    $submittedAnswers = $submittedDetails['answers'];

    // Initially total and obtained marks is assumed to be 0.
    $totalMarks = 0;
    $marksObtained = 0;
    $totalQuestions = count($submittedAnswers);
    $correctCount = 0;

    // Getting the question and respective answer one by one.
    foreach ($submittedAnswers as $questionId => $answer) {
      $question = $this->em->getRepository(Questions::class)->find($questionId);
      // If question is not found, we move to the next question.
      if (!$question) {
        continue;
      }
      // Adding the marks for the question to get the total marks.
      $totalMarks += $question->getMarks();
      // Getting the correct answer for the particular Question id.
      $correctAnswer = $question->getCorrect();
      // If correct answer exists and the user given answer is correct.
      if ($correctAnswer && $answer == $correctAnswer) {
        // Increase the count for questions correctly answered.
        $correctCount++;
        // Adding the marks for that question to marks obtained.
        $marksObtained += $question->getMarks();
      }
    }

    // Calculating the percentage obtained by the user in the exam.
    $percentObtained = round(($correctCount / $totalQuestions) * 100, 2);

     // Specifying the twig file to be rendered and passing relevant data.
    return $this->render('quiz/result.html.twig', [
      'totalMarks' => $totalMarks,
      'marksObtained'=> $marksObtained,
      'correctCount' => $correctCount,
      'totalQuestions' => $totalQuestions,
      'percentObtained' => $percentObtained,
    ]);
  }

}


<?php

namespace App\Entity;

use App\Repository\QuestionsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Questions to store Questions.
 */
#[ORM\Entity(repositoryClass: QuestionsRepository::class)]
class Questions
{
    /**
     * @var int $id
     *  To store the question id.
     */
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   * @var string $Question
   *  Stores the question statement.
   */
  #[ORM\Column(length: 100)]
  private ?string $Question = null;

  /**
   * @var string $A
   *  Stores the option A.
   */
  #[ORM\Column(length: 100)]
  private ?string $A = null;

  /**
   * @var string $B
   *  Stores the option B.
   */
  #[ORM\Column(length: 100)]
  private ?string $B = null;

  /**
   * @var string $C
   *  Stores the option C.
   */
  #[ORM\Column(length: 100)]
  private ?string $C = null;

  /**
   * @var string $D
   *  Stores the option D.
   */
  #[ORM\Column(length: 100)]
  private ?string $D = null;

  /**
   * @var string $correct
   *  Stores the correct answer.
   */
  #[ORM\Column(length: 100)]
  private ?string $correct = null;

  /**
   * @var int $marks
   *  Stores the marks for the question.
   */
  #[ORM\Column]
  private ?int $marks = null;

  /**
   * Getter to get the question id.
   *
   * @return int
   *  Returns the question id.
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Getter to get the question statement.
   *
   * @return string
   *  Returns the question statement.
   */
  public function getQuestion(): ?string
  {
    return $this->Question;
  }

  /**
   * Setter to set the question statement.
   *
   * @param string $Question
   *  The question statement.
   */
  public function setQuestion(string $Question): static
  {
    $this->Question = $Question;
    return $this;
  }

  /**
   * Getter to get the option A.
   *
   * @return string
   *  Returns the option A.
   */
  public function getA(): ?string
  {
    return $this->A;
  }

  /**
   * Setter to set the option A.
   *
   * @param string $A
   *  The option A.
   */
  public function setA(string $A): static
  {
    $this->A = $A;
    return $this;
  }

  /**
   * Getter to get the option B.
   *
   * @return string
   *  Returns the option B.
   */
  public function getB(): ?string
  {
    return $this->B;
  }

  /**
   * Setter to set the option B.
   *
   * @param string $B
   *  The option B.
   */
  public function setB(string $B): static
  {
    $this->B = $B;
    return $this;
  }

  /**
   * Getter to get the option C.
   *
   * @return string
   *  Returns the option C.
   */
  public function getC(): ?string
  {
    return $this->C;
  }

  /**
   * Setter to set the option C.
   *
   * @param string $C
   *  The option C.
   */
  public function setC(string $C): static
  {
    $this->C = $C;
    return $this;
  }

  /**
   * Getter to get the option D.
   *
   * @return string
   *  Returns the option D.
   */
  public function getD(): ?string
  {
    return $this->D;
  }

  /**
   * Setter to set the option D.
   *
   * @param string $D
   *  The option D.
   */
  public function setD(string $D): static
  {
    $this->D = $D;
    return $this;
  }

  /**
   * Getter to get the correct answer.
   *
   * @return string
   *  The correct answer.
   */
  public function getCorrect(): ?string
  {
    return $this->correct;
  }

  /**
   * Setter to set the correct answer.
   *
   * @param string $correct
   *  The correct answer to be set.
   */
  public function setCorrect(string $correct): static
  {
    $this->correct = $correct;
    return $this;
  }

  /**
   * Getter to get the marks for the question.
   *
   * @return int
   *  The marks for the question.
   */
  public function getMarks(): ?int
  {
    return $this->marks;
  }

  /**
   * Setter to set the marks for the question.
   *
   * @param int $marks
   *  The marks to be set for the question.
   */
  public function setMarks(int $marks): static
  {
    $this->marks = $marks;
    return $this;
  }
}

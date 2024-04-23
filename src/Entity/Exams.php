<?php

namespace App\Entity;

use App\Repository\ExamsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Exams to manage the table exams in the database.
 */
#[ORM\Entity(repositoryClass: ExamsRepository::class)]
class Exams
{
  /**
   * @var int $id
   *  Stores the exam id.
   */
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   * @var string $Title
   *  Stores the title of the exam.
   */
  #[ORM\Column(length: 100)]
  private ?string $Title = null;

  /**
   * @var DateTimeInterface $StartTime
   *  Stores the start time of the exam.
   */
  #[ORM\Column(type: Types::DATETIME_MUTABLE)]
  private ?\DateTimeInterface $StartTime = null;

  /**
   * @var DateTimeInterface $EndTime
   *  Stores the end time of the exam.
   */
  #[ORM\Column(type: Types::DATETIME_MUTABLE)]
  private ?\DateTimeInterface $EndTime = null;

  /**
   * @var int $Duration
   *  Stores the exam duration.
   */
  #[ORM\Column]
  private ?int $Duration = null;

  /**
   * @var int $TotalMarks
   *  Stores the total marks of the exam.
   */
  #[ORM\Column]
  private ?int $TotalMarks = null;

  /**
   * @var int $NoOfQuestions
   *  Stores the number of questions in exam.
   */
  #[ORM\Column(type: Types::SMALLINT)]
  private ?int $NoOfQuestions = null;

  /**
   * @var int userid
   *  Stores the userid who creates the exam.
   */
  #[ORM\ManyToOne(inversedBy: 'ExamsCreated')]
  #[ORM\JoinColumn(nullable: false)]
  private ?User $userid = null;

  /**
   * Getter to get the exam id.
   *
   * @return int
   *  The exam id.
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Getter to get the exam title.
   *
   * @return string
   *  The title of the exam.
   */
  public function getTitle(): ?string
  {
    return $this->Title;
  }

  /**
   * Setter to set the exam title.
   *
   * @param string $Title
   *  The exam title.
   */
  public function setTitle(string $Title): static
  {
    $this->Title = $Title;
    return $this;
  }

  /**
   * Getter to get the start time of the exam.
   *
   * @return DateTimeInterface
   *  The start time of the exam.
   */
  public function getStartTime(): ?\DateTimeInterface
  {
    return $this->StartTime;
  }

  /**
   * Setter to set the start time of exam.
   *
   * @param DateTimeInterface $StartTime
   *  The start of time of the exam.
   */
  public function setStartTime(\DateTimeInterface $StartTime): static
  {
    $this->StartTime = $StartTime;
    return $this;
  }

  /**
   * Getter to get the end time of the exam.
   *
   * @return DateTimeInterface
   */
  public function getEndTime(): ?\DateTimeInterface
  {
    return $this->EndTime;
  }

  /**
   * Setter to set the end time of exam.
   *
   * @param DateTimeInterface $EndTime
   *  The end time of the exam.
   */
  public function setEndTime(\DateTimeInterface $EndTime): static
  {
    $this->EndTime = $EndTime;
    return $this;
  }

  /**
   * Getter to get the Duration of the exam.
   *
   * @return int
   *  The duration of the exam.
   */
  public function getDuration(): ?int
  {
    return $this->Duration;
  }

  /**
   * Setter to set the duration of the exam.
   *
   * @param int $Duration
   *  The duration of the exam.
   */
  public function setDuration(int $Duration): static
  {
    $this->Duration = $Duration;
    return $this;
  }

  /**
   * Getter to get the total marks.
   *
   * @return int
   *  The total markd for the exam.
   */
  public function getTotalMarks(): ?int
  {
    return $this->TotalMarks;
  }

  /**
   * Setter to set the total marks for the exam.
   *
   * @param int $TotalMarks
   *  The total marks for the exam.
   */
  public function setTotalMarks(int $TotalMarks): static
  {
    $this->TotalMarks = $TotalMarks;
    return $this;
  }

  /**
   * Getter to get the number of questions in exam.
   *
   * @return int
   *  Number of questions in the exam.
   */
  public function getNoOfQuestions(): ?int
  {
    return $this->NoOfQuestions;
  }

  /**
   * Setter to set the number of questions in exam.
   *
   * @param int $NoOfQuestions
   *  The number of questions in the exam.
   */
  public function setNoOfQuestions(int $NoOfQuestions): static
  {
    $this->NoOfQuestions = $NoOfQuestions;
    return $this;
  }

  /**
   * Getter to get the user id.
   *
   * @return int userid
   *  Returns the user id.
   */
  public function getUserid(): ?User
  {
    return $this->userid;
  }

  /**
   * Setter to set the user id.
   *
   * @param int $userid
   *  The userd id to be set.
   */
  public function setUserid(?User $userid): static
  {
    $this->userid = $userid;
    return $this;
  }
}

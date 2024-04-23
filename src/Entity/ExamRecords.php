<?php

namespace App\Entity;

use App\Repository\ExamRecordsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ExamRecords to manage the table exam_records in the database.
 */
  #[ORM\Entity(repositoryClass: ExamRecordsRepository::class)]
class ExamRecords
{
  /**
   * @var int $id
   *  Stores the ExamRecord id.
   */
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   * @var int $userId
   *  Foreign key referencing the id of User table.
   */
  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?User $userId = null;

  /**
   * @var int examId
   *  Foreign Key referencing the id of Exam table.
   */
  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?Exams $examId = null;

  /**
   * @var int $marksObtained
   *  Stores the marks obtained by a user in an exam.
   */
  #[ORM\Column(type: Types::SMALLINT)]
  #[Assert\GreaterThan(value: 0)]
  private ?int $marksObtained = 0;

  /**
   * Getter to get the id.
   *
   * @return int
   *  Returns the ExamRecords id.
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Getter to get the User id.
   *
   * @return User
   *  Returns the user id.
   */
  public function getUserId(): ?User
  {
    return $this->userId;
  }

  /**
   * Setter to set the User id.
   *
   * @param int $userId
   *  The user id to be set.
   */
  public function setUserId(?User $userId): static
  {
    $this->userId = $userId;
    return $this;
  }

  /**
   * Getter to get the Exam id.
   *
   * @return Exams
   *  Returns the exam id.
   */
  public function getExamId(): ?Exams
  {
    return $this->examId;
  }

  /**
   * Setter to set the $examId.
   *
   *  @param int $examId
   *  Exam id to be set.
   */
  public function setExamId(?Exams $examId): static
  {
    $this->examId = $examId;
    return $this;
  }

  /**
   * Getter to get the obtained marks.
   *
   * @return int
   *  Marks obtained by the user in the exam.
   */
  public function getMarksObtained(): ?int
  {
    return $this->marksObtained;
  }

  /**
   * Setter to set the marks obtained by user in the exam.
   */
  public function setMarksObtained(int $marksObtained): static
  {
    $this->marksObtained = $marksObtained;
    return $this;
  }
}

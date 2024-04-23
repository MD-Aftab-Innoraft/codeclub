<?php

namespace App\Entity;

use App\Repository\ExamUserMapRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ExamUserMap to store exam_user records in the database.
 */
#[ORM\Entity(repositoryClass: ExamUserMapRepository::class)]
class ExamUserMap
{
  /**
   * @var int $id
   *  Stores the id of respective entries.
   */
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   * @var int $userId
   *  Stores the user id.
   */
  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?User $userId = null;

  /**
   * @var int $examId
   *  Stores the exam id.
   */
  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?Exams $examId = null;

  /**
   * Getter to get the id.
   *
   * @return int
   *  The id of the record.
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Getter to get the user id.
   *
   * @return int
   *  The user id.
   */
  public function getUserId(): ?User
  {
    return $this->userId;
  }

  /**
   * Setter to set the user id.
   */
  public function setUserId(?User $userId): static
  {
    $this->userId = $userId;
    return $this;
  }

  /**
   * Getter to get the exam id.
   *
   * @return int
   *  Returns the exam id.
   */
  public function getExamId(): ?Exams
  {
    return $this->examId;
  }

  public function setExamId(?Exams $examId): static
  {
    $this->examId = $examId;
    return $this;
  }
}

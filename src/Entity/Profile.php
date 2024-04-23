<?php

namespace App\Entity;

use App\Repository\ProfileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Profile to store user profiles.
 */
#[ORM\Entity(repositoryClass: ProfileRepository::class)]
class Profile
{
  /**
   * @var int $id
   *  The id of the user profile.
   */
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  /**
   * @var string $Fullname
   *  Stores the full name of the user.
   */
  #[ORM\Column(length: 40)]
  private ?string $Fullname = null;

  /**
   * @var string @email
   *  Stores the email of the user.
   */
  #[ORM\Column(length: 70)]
  private ?string $email = null;

  /**
   * @var string $phone
   *  Stores the user's phone number.
   */
  #[ORM\Column(type: Types::BIGINT)]
  private ?string $phone = null;

  /**
   * @var DateTimeInterface $DOB
   *  Stores the date of birth of user.
   */
  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTimeInterface $DOB = null;

  /**
   * @var int $Age
   *  Stores the age of the user.
   */
  #[ORM\Column(type: Types::SMALLINT)]
  private ?int $Age = null;

  /**
   * @var int marks
   *  Stores the marks of user in Xth standard.
   */
  #[ORM\Column(type: Types::SMALLINT)]
  private ?int $Xmarks = null;

  /**
   * Stores the marks of user in XII'th standard.
   */
  #[ORM\Column(type: Types::SMALLINT)]
  private ?int $XIImarks = null;

  /**
   * @var $resume
   *  Stores the resume of the user.
   */
  #[ORM\Column(type: Types::BLOB, nullable: true)]
  private $resume;

  /**
   * @var User $user
   *  Foreign key referencing the user id.
   */
  #[ORM\OneToOne(inversedBy: 'profile', cascade: ['persist', 'remove'])]
  #[ORM\JoinColumn(nullable: false)]
  private ?User $user = null;

  /**
   * Getter to get the id of the Profile.
   */
  public function getId(): ?int
  {
    return $this->id;
  }

  /**
   * Getter to get the Fullname of the Profile.
   *
   * @return string
   *  The fullname of the Profile.
   */
  public function getFullname(): ?string
  {
    return $this->Fullname;
  }

  /**
   * Setter to set the fullname.
   *
   * @param string $Fullname
   *  Sets the fullname of the Profile.
   */
  public function setFullname(string $Fullname): static
  {
    $this->Fullname = $Fullname;
    return $this;
  }

  /**
   * Getter to get the email id of the user.
   *
   * @return string
   *  The enail id associated with the Profile.
   */
  public function getEmail(): ?string
  {
    return $this->email;
  }

  /**
   * Setter to set the email id.
   *
   * @param string $email
   *  The email id to be set for the Profile.
   */
  public function setEmail(string $email): static
  {
    $this->email = $email;
    return $this;
  }

  /**
   * Getter to get the phone number for the Profile.
   *
   * @return string
   *  The phone number associated with the profile.
   */
  public function getPhone(): ?string
  {
    return $this->phone;
  }

  /**
   * Setter to set the Phone number for the Profile.
   *
   * @param string $phone
   *  The phone number to be set for the profile.
   */
  public function setPhone(string $phone): static
  {
    $this->phone = $phone;
    return $this;
  }

    /**
     * Getter to get the Date-Of-Birth of user.
     *
     * @return DateTimeInterface
     *  The Date-Of-Birth of the user to be set for his Profile.
     */
  public function getDOB(): ?\DateTimeInterface
  {
    return $this->DOB;
  }

    /**
     * Setter to set the Date-Of-Birth of the user profile.
     *
     * @param DateTimeInterface $DOB
     *  The Date-Of-Birth to be set for the user profile.
     */
  public function setDOB(\DateTimeInterface $DOB): static
  {
    $this->DOB = $DOB;
    return $this;
  }

  /**
   * Getter to get the age of the user.
   *
   * @return int
   *  The age of the user.
   */
  public function getAge(): ?int
  {
    return $this->Age;
  }

  /**
   * Setter to set the user's age.
   *
   * @param int $Age
   *  The age of the suer to be set.
   */
  public function setAge(int $Age): static
  {
    $this->Age = $Age;
    return $this;
  }

  /**
   * Getter to get user's X'th standard's marks
   *
   * @return int
   *  The user's X'th standard's marks.
   */
  public function getXmarks(): ?int
  {
    return $this->Xmarks;
  }

  /**
   * Setter to set the user's X'th standard's marks.
   */
  public function setXmarks(int $Xmarks): static
  {
    $this->Xmarks = $Xmarks;
    return $this;
  }

  /**
   * Getter to get the XII'th standard's marks.
   */
  public function getXIImarks(): ?int
  {
    return $this->XIImarks;
  }

  /**
   * Setter to set the XII'th standard's marks.
   */
  public function setXIImarks(int $XIImarks): static
  {
    $this->XIImarks = $XIImarks;
    return $this;
  }

  /**
   * Getter to get the user's resume.
   *
   * @return $resume
   *  The resume of the user.
   */
  public function getResume()
  {
    return $this->resume;
  }

  /**
   * Setter to set the resume of the user.
   *
   * @param $resume
   *  The resume of the user.
   */
  public function setResume($resume): static
  {
    $this->resume = $resume;
    return $this;
  }

  /**
   * Getter to get the User.
   *
   * @return User
   *  Returns the current User.
   */
  public function getUser(): ?User
  {
    return $this->user;
  }

  /**
   * Setter to set the User.
   *
   * @param User $user
   *  The user to be set.
   */
  public function setUser(User $user): static
  {
    $this->user = $user;
    return $this;
  }
}

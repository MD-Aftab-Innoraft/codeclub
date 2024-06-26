<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Profile $profile = null;

    /**
     * @var Collection<int, Questions>
     */
    #[ORM\ManyToMany(targetEntity: Questions::class, mappedBy: 'userid')]
    private Collection $QuestionId;

    /**
     * @var Collection<int, Exams>
     */
    #[ORM\OneToMany(targetEntity: Exams::class, mappedBy: 'userid')]
    private Collection $ExamsCreated;

    #[ORM\Column(length: 40, nullable: true)]
    private ?string $userType = null;

    // /**
    //  * @var Collection<int, ExamRecords>
    //  */
    // #[ORM\OneToMany(targetEntity: ExamRecords::class, mappedBy: 'userId', orphanRemoval: true)]
    // private Collection $examId;

    public function __construct()
    {
        $this->QuestionId = new ArrayCollection();
        $this->ExamsCreated = new ArrayCollection();
        $this->examId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile): static
    {
        // set the owning side of the relation if necessary
        if ($profile->getUser() !== $this) {
            $profile->setUser($this);
        }

        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Collection<int, Questions>
     */
    public function getQuestionId(): Collection
    {
        return $this->QuestionId;
    }

    public function addQuestionId(Questions $questionId): static
    {
        if (!$this->QuestionId->contains($questionId)) {
            $this->QuestionId->add($questionId);
            $questionId->addUserid($this);
        }

        return $this;
    }

    public function removeQuestionId(Questions $questionId): static
    {
        if ($this->QuestionId->removeElement($questionId)) {
            $questionId->removeUserid($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Exams>
     */
    public function getExamsCreated(): Collection
    {
        return $this->ExamsCreated;
    }

    public function addExamsCreated(Exams $examsCreated): static
    {
        if (!$this->ExamsCreated->contains($examsCreated)) {
            $this->ExamsCreated->add($examsCreated);
            $examsCreated->setUserid($this);
        }

        return $this;
    }

    public function removeExamsCreated(Exams $examsCreated): static
    {
        if ($this->ExamsCreated->removeElement($examsCreated)) {
            // set the owning side to null (unless already changed)
            if ($examsCreated->getUserid() === $this) {
                $examsCreated->setUserid(null);
            }
        }

        return $this;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(?string $userType): static
    {
        $this->userType = $userType;

        return $this;
    }

    /**
     * @return Collection<int, ExamRecords>
     */
    public function getExamId(): Collection
    {
        return $this->examId;
    }

    public function addExamId(ExamRecords $examId): static
    {
        if (!$this->examId->contains($examId)) {
            $this->examId->add($examId);
            $examId->setUserId($this);
        }

        return $this;
    }

    public function removeExamId(ExamRecords $examId): static
    {
        if ($this->examId->removeElement($examId)) {
            // set the owning side to null (unless already changed)
            if ($examId->getUserId() === $this) {
                $examId->setUserId(null);
            }
        }

        return $this;
    }
}

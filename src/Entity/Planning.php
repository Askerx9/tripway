<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 * @Vich\Uploadable()
 * @ApiResource(
 *     attributes={"order"={"createdAt":"DESC"}},
 *     normalizationContext={"groups"={"read:planning"}},
 *     collectionOperations={"get"},
 *     itemOperations={"get"}
 * )
// * @ApiFilter(SearchFilter::class, properties={"user": "exact"})
 */
class Planning
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"read:planning"})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:planning"})
     */
    private string $name = '';

    /**
     * @Gedmo\Slug(fields={"id","daysCount","name"})
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"read:planning"})
     */
    private string $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $start_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $finish_at;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:planning"})
     */
    private int $daysCount;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="plannings_image", fileNameProperty="imageName")
     */
    private ?File $image_file = null;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:planning"})
     */
    private ?string $imageName;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="plannings")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"read:planning"})
     */
    private ?User $user;

    /**
     * @ORM\Column(type="datetime")
     */
    private \DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read:planning"})
     */
    private int $people;

    /**
     * @ORM\OneToMany(targetEntity=Activity::class, mappedBy="planning", orphanRemoval=true)
     */
    private Collection $activity;

    public function __construct()
    {
        $this->setCreatedAt( new \DateTime());
        $this->activity = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->start_at;
    }

    public function setStartAt(\DateTimeInterface $start_at): self
    {
        $this->start_at = $start_at;

        return $this;
    }

    public function getFinishAt(): ?\DateTimeInterface
    {
        return $this->finish_at;
    }

    public function setFinishAt(\DateTimeInterface $finish_at): self
    {
        $this->finish_at = $finish_at;

        return $this;
    }

    public function getDaysCount(): int
    {
        return $this->daysCount;
    }

    public function setDaysCount(int $daysCount): self
    {
        $this->daysCount = $daysCount;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->image_file;
    }

    /**
     * @param File|null $image_file
     * @return Planning
     */
    public function setImageFile(?File $image_file): Planning
    {
        $this->image_file = $image_file;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     * @return Planning
     */
    public function setImageName(?string $imageName): Planning
    {
        $this->imageName = $imageName;
        return $this;
    }

    public function getPeople(): ?int
    {
        return $this->people;
    }

    public function setPeople(int $people): self
    {
        $this->people = $people;

        return $this;
    }

    /**
     * @return Collection|Activity[]
     */
    public function getActivity(): Collection
    {
        return $this->activity;
    }

    public function addActivity(Activity $Activity): self
    {
        if (!$this->activity->contains($Activity)) {
            $this->activity[] = $Activity;
            $Activity->setPlanning($this);
        }

        return $this;
    }

    public function removeActivity(Activity $Activity): self
    {
        if ($this->activity->contains($Activity)) {
            $this->activity->removeElement($Activity);
            // set the owning side to null (unless already changed)
            if ($Activity->getPlanning() === $this) {
                $Activity->setPlanning(null);
            }
        }

        return $this;
    }


}

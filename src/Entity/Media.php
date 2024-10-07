<?php

namespace App\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["movie" => Movie::class, "serie" => Serie::class])]
#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 255)]
	private ?string $title = null;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $shortDescription = null;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $longDescription = null;

	#[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
	private ?\DateTimeInterface $releaseDate = null;

	#[ORM\Column(length: 255, nullable: true)]
	private ?string $coverImage = null;

	#[ORM\Column(nullable: true)]
	private ?array $staffMembers = null;

	#[ORM\Column(nullable: true)]
	private ?array $castMembers = null;

    /**
     * @var Collection<int, Category>
     */
    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'media')]
    private Collection $categories;

    /**
     * @var Collection<int, Language>
     */
    #[ORM\ManyToMany(targetEntity: Language::class, inversedBy: 'media')]
    private Collection $languages;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'media', orphanRemoval: true)]
    private Collection $comments;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->languages = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(string $title): static
	{
		$this->title = $title;

		return $this;
	}

	public function getShortDescription(): ?string
	{
		return $this->shortDescription;
	}

	public function setShortDescription(?string $shortDescription): static
	{
		$this->shortDescription = $shortDescription;

		return $this;
	}

	public function getLongDescription(): ?string
	{
		return $this->longDescription;
	}

	public function setLongDescription(?string $longDescription): static
	{
		$this->longDescription = $longDescription;

		return $this;
	}

	public function getReleaseDate(): ?\DateTimeInterface
	{
		return $this->releaseDate;
	}

	public function setReleaseDate(?\DateTimeInterface $releaseDate): static
	{
		$this->releaseDate = $releaseDate;

		return $this;
	}

	public function getCoverImage(): ?string
	{
		return $this->coverImage;
	}

	public function setCoverImage(?string $coverImage): static
	{
		$this->coverImage = $coverImage;

		return $this;
	}

	public function getStaffMembers(): ?array
	{
		return $this->staffMembers;
	}

	public function setStaffMembers(?array $staffMembers): static
	{
		$this->staffMembers = $staffMembers;

		return $this;
	}

	public function getCastMembers(): ?array
	{
		return $this->castMembers;
	}

	public function setCastMembers(?array $castMembers): static
	{
		$this->castMembers = $castMembers;

		return $this;
	}

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Language>
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): static
    {
        if (!$this->languages->contains($language)) {
            $this->languages->add($language);
        }

        return $this;
    }

    public function removeLanguage(Language $language): static
    {
        $this->languages->removeElement($language);

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMedia($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMedia() === $this) {
                $comment->setMedia(null);
            }
        }

        return $this;
    }
}

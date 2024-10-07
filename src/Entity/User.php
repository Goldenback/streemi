<?php

namespace App\Entity;

use App\Enum\UserStatusEnum;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 255)]
	private ?string $username = null;

	#[ORM\Column(length: 255)]
	private ?string $email = null;

	#[ORM\Column(length: 255)]
	private ?string $password = null;

	#[ORM\Column(enumType: UserStatusEnum::class)]
	private ?UserStatusEnum $status = null;

	/**
	 * @var Collection<int, Comment>
	 */
	#[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'author')]
	private Collection $comments;

	/**
	 * @var Collection<int, Playlist>
	 */
	#[ORM\OneToMany(targetEntity: Playlist::class, mappedBy: 'creator', orphanRemoval: true)]
	private Collection $playlists;

	/**
	 * @var Collection<int, PlaylistSubscription>
	 */
	#[ORM\OneToMany(targetEntity: PlaylistSubscription::class, mappedBy: 'subscriber', orphanRemoval: true)]
	private Collection $playlistSubscriptions;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?Subscription $currentSubscription = null;

    /**
     * @var Collection<int, SubscriptionHistory>
     */
    #[ORM\OneToMany(targetEntity: SubscriptionHistory::class, mappedBy: 'subscriber', orphanRemoval: true)]
    private Collection $subscriptionHistories;

	public function __construct()
	{
		$this->comments = new ArrayCollection();
		$this->playlists = new ArrayCollection();
		$this->playlistSubscriptions = new ArrayCollection();
        $this->subscriptionHistories = new ArrayCollection();
	}

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getUsername(): ?string
	{
		return $this->username;
	}

	public function setUsername(string $username): static
	{
		$this->username = $username;

		return $this;
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

	public function getPassword(): ?string
	{
		return $this->password;
	}

	public function setPassword(string $password): static
	{
		$this->password = $password;

		return $this;
	}

	public function getStatus(): ?UserStatusEnum
	{
		return $this->status;
	}

	public function setStatus(UserStatusEnum $status): static
	{
		$this->status = $status;

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
			$comment->setAuthor($this);
		}

		return $this;
	}

	public function removeComment(Comment $comment): static
	{
		if ($this->comments->removeElement($comment)) {
			// set the owning side to null (unless already changed)
			if ($comment->getAuthor() === $this) {
				$comment->setAuthor(null);
			}
		}

		return $this;
	}

	/**
	 * @return Collection<int, Playlist>
	 */
	public function getPlaylists(): Collection
	{
		return $this->playlists;
	}

	public function addPlaylist(Playlist $playlist): static
	{
		if (!$this->playlists->contains($playlist)) {
			$this->playlists->add($playlist);
			$playlist->setCreator($this);
		}

		return $this;
	}

	public function removePlaylist(Playlist $playlist): static
	{
		if ($this->playlists->removeElement($playlist)) {
			// set the owning side to null (unless already changed)
			if ($playlist->getCreator() === $this) {
				$playlist->setCreator(null);
			}
		}

		return $this;
	}

	/**
	 * @return Collection<int, PlaylistSubscription>
	 */
	public function getPlaylistSubscriptions(): Collection
	{
		return $this->playlistSubscriptions;
	}

	public function addPlaylistSubscription(PlaylistSubscription $playlistSubscription): static
	{
		if (!$this->playlistSubscriptions->contains($playlistSubscription)) {
			$this->playlistSubscriptions->add($playlistSubscription);
			$playlistSubscription->setSubscriber($this);
		}

		return $this;
	}

	public function removePlaylistSubscription(PlaylistSubscription $playlistSubscription): static
	{
		if ($this->playlistSubscriptions->removeElement($playlistSubscription)) {
			// set the owning side to null (unless already changed)
			if ($playlistSubscription->getSubscriber() === $this) {
				$playlistSubscription->setSubscriber(null);
			}
		}

		return $this;
	}

    public function getCurrentSubscription(): ?Subscription
    {
        return $this->currentSubscription;
    }

    public function setCurrentSubscription(?Subscription $currentSubscription): static
    {
        $this->currentSubscription = $currentSubscription;

        return $this;
    }

    /**
     * @return Collection<int, SubscriptionHistory>
     */
    public function getSubscriptionHistories(): Collection
    {
        return $this->subscriptionHistories;
    }

    public function addSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if (!$this->subscriptionHistories->contains($subscriptionHistory)) {
            $this->subscriptionHistories->add($subscriptionHistory);
            $subscriptionHistory->setSubscriber($this);
        }

        return $this;
    }

    public function removeSubscriptionHistory(SubscriptionHistory $subscriptionHistory): static
    {
        if ($this->subscriptionHistories->removeElement($subscriptionHistory)) {
            // set the owning side to null (unless already changed)
            if ($subscriptionHistory->getSubscriber() === $this) {
                $subscriptionHistory->setSubscriber(null);
            }
        }

        return $this;
    }
}

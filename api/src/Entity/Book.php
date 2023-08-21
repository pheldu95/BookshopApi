<?php
// api/src/Entity/Book.php
namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/** A book. */
#[ORM\Entity]
#[ApiResource(normalizationContext: ['groups' => ['book']])]
class Book
{
    /** The ID of this book. */
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    #[Groups('book')]
    private ?int $id = null;

    /** The ISBN of this book (or null if doesn't have one). */
    #[Groups('book')]
    #[ORM\Column(nullable: true)]
    public ?string $isbn = null;

    /** The title of this book. */
    #[Groups('book')]
    #[ORM\Column]
    public string $title = '';

    /** The description of this book. */
    #[Groups('book')]
    #[ORM\Column(type: 'text')]
    public string $description = '';

    /** The author of this book. */
    #[Groups('book')]
    #[ORM\ManyToOne(inversedBy: 'books')]
    public ?Author $author = null;

    /** The publication date of this book. */
    #[ORM\Column]
    #[Groups('book')]
    public ?\DateTimeImmutable $publicationDate = null;

    /** @var Review[] Available reviews for this book. */
    #[Groups('book')]
    #[ORM\OneToMany(targetEntity: Review::class, mappedBy: 'book', cascade: ['persist', 'remove'])]
    public iterable $reviews;
    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
}

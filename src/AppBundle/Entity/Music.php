<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Music
 *
 * @ORM\Table(name="music")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MusicRepository")
 */
class Music
{

    /**
   * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
   * @ORM\JoinColumn(nullable=false)
   */
    private $user;

    /**
   * @ORM\OneToOne(targetEntity="AppBundle\Entity\Morceau", cascade={"persist"})
   * @ORM\JoinColumn(nullable=false)
   */
    private $morceau;

    /**
   * @ORM\OneToOne(targetEntity="AppBundle\Entity\Photo", cascade={"persist"})
   */
  private $photo;



    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255)
     */
    private $description;


    /**
     * @var int
     *
     * @ORM\Column(name="Temps", type="integer")
     */
    private $temps;

    /**
     * @var bool
     *
     * @ORM\Column(name="Telechargeable", type="boolean")
     */
    private $telechargeable;

    /**
     * @var string
     *
     * @ORM\Column(name="Artiste", type="string", length=255)
     */
    private $artiste;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre.
     *
     * @param string $titre
     *
     * @return Music
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre.
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set genre.
     *
     * @param string $genre
     *
     * @return Music
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre.
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Music
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Set temps.
     *
     * @param int $temps
     *
     * @return Music
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;

        return $this;
    }

    /**
     * Get temps.
     *
     * @return int
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * Set telechargeable.
     *
     * @param bool $telechargeable
     *
     * @return Music
     */
    public function setTelechargeable($telechargeable)
    {
        $this->telechargeable = $telechargeable;

        return $this;
    }

    /**
     * Get telechargeable.
     *
     * @return bool
     */
    public function getTelechargeable()
    {
        return $this->telechargeable;
    }

    /**
     * Set artiste.
     *
     * @param string $artiste
     *
     * @return Music
     */
    public function setArtiste($artiste)
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * Get artiste.
     *
     * @return string
     */
    public function getArtiste()
    {
        return $this->artiste;
    }

    /**
     * Set dateCreation.
     *
     * @param \DateTime $dateCreation
     *
     * @return Music
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation.
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Music
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    

    /**
     * Set morceau.
     *
     * @param \AppBundle\Entity\Morceau $morceau
     *
     * @return Music
     */
    public function setMorceau(\AppBundle\Entity\Morceau $morceau)
    {
        $this->morceau = $morceau;

        return $this;
    }

    /**
     * Get morceau.
     *
     * @return \AppBundle\Entity\Morceau
     */
    public function getMorceau()
    {
        return $this->morceau;
    }

    /**
     * Set photo.
     *
     * @param \AppBundle\Entity\Photo|null $photo
     *
     * @return Music
     */
    public function setPhoto(\AppBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo.
     *
     * @return \AppBundle\Entity\Photo|null
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}

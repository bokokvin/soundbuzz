<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlaylistRepository")
 */
class Playlist
{

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
    * @ORM\JoinColumn(nullable=false)
    */
    private $user;

    /**
    * Many songs have Many playlists.
    * @ORM\ManyToMany(targetEntity="Music")
    * @ORM\JoinTable(name="playlist_music",
    *      joinColumns={@ORM\JoinColumn(name="playlist_id", referencedColumnName="id")},
    *      inverseJoinColumns={@ORM\JoinColumn(name="music_id", referencedColumnName="id")}
    *      )
    */
    private $musics;



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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Playlist
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Playlist
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
     * Set user.
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Playlist
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


    public function __construct() {
        $this->musics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add music.
     *
     * @param \AppBundle\Entity\Music $music
     *
     * @return Playlist
     */
    public function addMusic(\AppBundle\Entity\Music $music)
    {
        $this->musics[] = $music;

        return $this;
    }

    /**
     * Remove music.
     *
     * @param \AppBundle\Entity\Music $music
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMusic(\AppBundle\Entity\Music $music)
    {
        return $this->musics->removeElement($music);
    }

    /**
     * Get musics.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMusics()
    {
        return $this->musics;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Appreciation
 *
 * @ORM\Table(name="appreciation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AppreciationRepository")
 */
class Appreciation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

       /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $date;


    /**
     * Music of this like
     *
     * @var Music
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Music")
     */
    protected $music;


    /**
     * Author of the like
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @var User
     */
    protected $liker;


    public function setLiker(UserInterface $liker)
    {
        $this->liker = $liker;
    }


    public function getLiker()
    {
        return $this->liker;
    }


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
     * Set value.
     *
     * @param int $value
     *
     * @return Appreciation
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value.
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Appreciation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set music.
     *
     * @param \AppBundle\Entity\Music $music
     *
     * @return Appreciation
     */
    public function setMusic(\AppBundle\Entity\Music $music)
    {
        $this->music = $music;

        return $this;
    }

    /**
     * Get music.
     *
     * @return \AppBundle\Entity\Music
     */
    public function getMusic()
    {
        return $this->music;
    }


}

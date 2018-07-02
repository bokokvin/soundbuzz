<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Ecoute
 *
 * @ORM\Table(name="ecoute")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EcouteRepository")
 */
class Ecoute
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @var User
     */
    protected $ecouteur;


    public function setEcouteur(UserInterface $ecouteur)
    {
        $this->ecouteur = $ecouteur;
    }


    public function getEcouteur()
    {
        return $this->ecouteur;
    }



    /**
     * Music of this like
     *
     * @var Music
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Music")
     */
    protected $music;


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


    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="value", type="integer")
     */
    private $value;


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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Ecoute
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
     * Set value.
     *
     * @param int $value
     *
     * @return Ecoute
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
}

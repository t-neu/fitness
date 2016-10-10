<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as ID_USER;

/**
 * GymLogin
 *
 * @ORM\Table(name="gym_login")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GymLoginRepository")
 */
class GymLogin
{
    
    /**
     * @var Userid 
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\UserBundle\Entity\User", inversedBy="user_ids")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $userid;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return GymLogin
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
     /**
     * @param ID_USER $userid
     */
    public function setUserid(ID_USER $userid)
    {
        $this->userid = $userid;
        
        return $this;
    }
    
     /**
     * @return ID_USER
     */
    public function getUserid()
    {
        return $this->user_id;
    }
    
}


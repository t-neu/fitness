<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calculation
 *
 * @ORM\Table(name="calculation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CalculationRepository")
 */
class Calculation
{
    
    /** 
     * 
     * @ORM\ManyToOne(targetEntity="Activity", inversedBy="activities")
     * @ORM\JoinColumn(name="activity_id", referencedColumnName="id")
     */
    private $activity;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight;

    /**
     * @var int
     *
     * @ORM\Column(name="feet", type="integer")
     */
    private $feet;

    /**
     * @var int
     *
     * @ORM\Column(name="inches", type="integer")
     */
    private $inches;

    /**
     * @var bool
     *
     * @ORM\Column(name="sex", type="boolean")
     */
    private $sex;
    
    
    /**
     * @var int
     * 
     */
    private $activity_id;

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
     * Set age
     *
     * @param integer $age
     *
     * @return Calculation
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Calculation
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return int
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set feet
     *
     * @param integer $feet
     *
     * @return Calculation
     */
    public function setFeet($feet)
    {
        $this->feet = $feet;

        return $this;
    }

    /**
     * Get feet
     *
     * @return int
     */
    public function getFeet()
    {
        return $this->feet;
    }

    /**
     * Set inches
     *
     * @param integer $inches
     *
     * @return Calculation
     */
    public function setInches($inches)
    {
        $this->inches = $inches;

        return $this;
    }

    /**
     * Get inches
     *
     * @return int
     */
    public function getInches()
    {
        return $this->inches;
    }

    /**
     * Set sex
     *
     * @param boolean $sex
     *
     * @return Calculation
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return bool
     */
    public function getSex()
    {
        return $this->sex;
    }
    
    /**
     * Set activity
     *
     * @param \AppBundle\Entity\Activity $activity
     *
     * @return Calculation
     */
    public function setActivity(\AppBundle\Entity\Activity $activity = null)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return \AppBundle\Entity\Activity
     */
    public function getActivity()
    {
        return $this->activity;
    }
    
     /**
     * Set activity_id
     *
     * @param Calculation $activity_id
     *
     * @return Calculation
     */
    public function setActivity_id($activity_id)
    {
        $this->activity_id = $activity_id;

        return $this;
    }
     
    /**
     * Get activity_id
     *
     * @return Calculation
     */
    public function getActivity_id()
    {
        return $this->activity_id;
    }
    
}

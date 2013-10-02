<?php

namespace B55\Bundle\YargBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Cv", mappedBy="user")
     */
    protected $cvs;

    /**
     * @ORM\OneToMany(targetEntity="Information", mappedBy="user")
     */
    protected $informations;

    public function __construct()
    {
        $this->cvs = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add cvs
     *
     * @param \B55\Bundle\YargBundle\Entity\Cv $cvs
     * @return User
     */
    public function addCv(\B55\Bundle\YargBundle\Entity\Cv $cvs)
    {
        $this->cvs[] = $cvs;

        return $this;
    }

    /**
     * Remove cvs
     *
     * @param \B55\Bundle\YargBundle\Entity\Cv $cvs
     */
    public function removeCv(\B55\Bundle\YargBundle\Entity\Cv $cvs)
    {
        $this->cvs->removeElement($cvs);
    }

    /**
     * Get cvs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCvs()
    {
        return $this->cvs;
    }

    /**
     * Add informations
     *
     * @param \B55\Bundle\YargBundle\Entity\Information $informations
     * @return User
     */
    public function addInformation(\B55\Bundle\YargBundle\Entity\Information $informations)
    {
        $this->informations[] = $informations;
    
        return $this;
    }

    /**
     * Remove informations
     *
     * @param \B55\Bundle\YargBundle\Entity\Information $informations
     */
    public function removeInformation(\B55\Bundle\YargBundle\Entity\Information $informations)
    {
        $this->informations->removeElement($informations);
    }

    /**
     * Get informations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInformations()
    {
        return $this->informations;
    }
}
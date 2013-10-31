<?php

namespace B55\Bundle\YargBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="B55\Bundle\YargBundle\Entity\InformationRepository")
 */
class Information
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
     * @var string
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="informations")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Cv", inversedBy="informations")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    private $cv;

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
     * Set title
     *
     * @param string $title
     * @return Information
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Information
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Information
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set category
     *
     * @param \B55\Bundle\YargBundle\Entity\Category $category
     * @return Information
     */
    public function setCategory(\B55\Bundle\YargBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \B55\Bundle\YargBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \B55\Bundle\YargBundle\Entity\User $user
     * @return Information
     */
    public function setUser(\B55\Bundle\YargBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \B55\Bundle\YargBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set cv
     *
     * @param \B55\Bundle\YargBundle\Entity\Cv $cv
     * @return Information
     */
    public function setCv(\B55\Bundle\YargBundle\Entity\Cv $cv = null)
    {
        $this->cv = $cv;
    
        return $this;
    }

    /**
     * Get cv
     *
     * @return \B55\Bundle\YargBundle\Entity\Cv 
     */
    public function getCv()
    {
        return $this->cv;
    }
}
<?php

namespace B55\Bundle\YargBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="B55\Bundle\YargBundle\Entity\CategoryRepository")
 */
class Category
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
     *
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=55)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="weight", type="integer")
     */
    private $weight = 0;

    /**
     * @ORM\ManyToOne(targetEntity="Cv", inversedBy="categories")
     * @ORM\JoinColumn(name="cv_id", referencedColumnName="id")
     */
    protected $cv;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="parent", cascade={"persist", "remove"})
     */
    protected $children;

    /**
     * @ORM\OneToMany(targetEntity="Information", mappedBy="category", cascade={"persist", "remove"})
     */
    protected $informations;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->informations = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     * @return Category
     */
    public function setWeight($weight = 0)
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
     * Set cv
     *
     * @param \B55\Bundle\YargBundle\Entity\Cv $cv
     * @return Category
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

    /**
     * Set parent
     *
     * @param \B55\Bundle\YargBundle\Entity\Category $parent
     * @return Category
     */
    public function setParent(\B55\Bundle\YargBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \B55\Bundle\YargBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add children
     *
     * @param \B55\Bundle\YargBundle\Entity\Category $children
     * @return Category
     */
    public function addChildren(\B55\Bundle\YargBundle\Entity\Category $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \B55\Bundle\YargBundle\Entity\Category $children
     */
    public function removeChildren(\B55\Bundle\YargBundle\Entity\Category $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add informations
     *
     * @param \B55\Bundle\YargBundle\Entity\Information $informations
     * @return Category
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

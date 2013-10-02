<?php

namespace B55\Bundle\YargBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cv
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="B55\Bundle\YargBundle\Entity\CvRepository")
 */
class Cv
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
     * @ORM\Column(name="title", type="string", length=55)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="catch", type="string", length=255)
     */
    private $catch;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="cv")
     */
    protected $categories;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cvs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;


    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title.
     *
     * @param string $title
     * @return Cv
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set catch.
     *
     * @param string $catch
     * @return Cv
     */
    public function setCatch($catch)
    {
        $this->catch = $catch;

        return $this;
    }

    /**
     * Get catch.
     *
     * @return string
     */
    public function getCatch()
    {
        return $this->catch;
    }

    /**
     * Set description.
     *
     * @param string $description
     * @return Cv
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
     * Add categories
     *
     * @param \B55\Bundle\YargBundle\Entity\Category $categories
     * @return Cv
     */
    public function addCategorie(\B55\Bundle\YargBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \B55\Bundle\YargBundle\Entity\Category $categories
     */
    public function removeCategorie(\B55\Bundle\YargBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set user
     *
     * @param \B55\Bundle\YargBundle\Entity\User $user
     * @return Cv
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
}
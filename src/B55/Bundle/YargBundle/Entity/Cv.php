<?php
namespace B55\Bundle\YargBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo;

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
     * @Assert\NotBlank()
     *
     * @ORM\Column(name="title", type="string", length=55)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="catch", type="string", length=255, nullable=true)
     */
    private $catch;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = 0;

    /**
     * @var datetime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255, unique=true)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="cv", cascade={"persist", "remove"})
     */
    protected $categories;

    /**
     * @ORM\OneToMany(targetEntity="Information", mappedBy="cv", cascade={"persist", "remove"})
     */
    protected $informations;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="cvs")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * Find a category (via its id) in this Cv.
     *
     * @param integer $needle
     *   The Category id needed.
     *
     * @return Mixed
     *   The Category matching the given id if found.
     *   False otherwise.
     */
    public function findCategory($needle)
    {
        foreach ($this->categories as $category) {
            if ($category->getId() == $needle) {
                return $category;
            }
        }

        return false;
    }

    /**
     * Find an information (via its id) in this Cv.
     *
     * @param integer $needle
     *   The Information id needed.
     *
     * @return Mixed
     *   The Information matching the given id if found.
     *   False otherwise.
     */
    public function findInformation($needle)
    {
        foreach ($this->categories as $category) {
            if ($information = $category->findInformation($needle)) {
                return $information;
            }

            foreach ($category->getChildren() as $subcategory) {
                if ($information = $subcategory->findInformation($needle)) {
                    return $information;
                }
            }
        }

        return false;
    }


    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->informations = new ArrayCollection();
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

    /**
     * Set slug
     *
     * @param string $slug
     * @return Cv
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Cv
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Cv
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set published
     *
     * @param boolean $published
     * @return Cv
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Add informations
     *
     * @param \B55\Bundle\YargBundle\Entity\Information $informations
     * @return Cv
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

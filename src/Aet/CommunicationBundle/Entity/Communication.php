<?php

namespace Aet\CommunicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Communication
 *
 * @ORM\Table(name="aet_communication")
 * @ORM\Entity(repositoryClass="Aet\CommunicationBundle\Entity\CommunicationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Communication
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="short_description", type="string", length=255)
     * * @Assert\Length(
     *      min = "0",
     *      max = "255",
     *      minMessage = "",
     *      maxMessage = "La description de votre communication ne peut comporter plus de 255 caratéres"
     * )
     */
    private $shortDesc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @ORM\ManyToMany(targetEntity="Aet\CommunicationBundle\Entity\Category", cascade={"persist"})
     */
    private $categories;

    /*
     * @ORM\OneToMany(targetEntity="Aet\CommunicationBundle\Entity\Comment", mappedBy="communication", cascade={"remove"})
     */
    //private $comments;

    /**
     * Thread of this communication
     *
     * @var Thread
     *
     * @ORM\Column(name="threadId", type="string", length=100)
     */
    protected $thread;
    private $tempThreadId;
	
	/**
     * Thread of this communication
     *
	 * @ORM\OneToOne(targetEntity="Aet\CommunicationBundle\Entity\Image", cascade={"persist", "remove"})
	 */
	private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Aet\AnnuaireBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;



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
     * @return Communication
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
     * Set body
     *
     * @param string $body
     * @return Communication
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categories
     *
     * @param \Aet\AnnuaireBundle\Entity\Category $categories
     * @return Communication
     */
    public function addCategory(\Aet\CommunicationBundle\Entity\Category $category)
    {
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Aet\CommunicationBundle\Entity\Category $categories
     */
    public function removeCategory(\Aet\CommunicationBundle\Entity\Category $category)
    {
        $this->categories->removeElement($category);
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

    /*
     * Add comments
     *
     * @param \Aet\CommunicationBundle\Entity\Comment $comments
     * @return Communication
     */
    /*public function addComment(\Aet\CommunicationBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }*/

    /*
     * Remove comments
     *
     * @param \Aet\CommunicationBundle\Entity\Comment $comments
     */
    /*public function removeComment(\Aet\CommunicationBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }*/

    /*
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    /*public function getComments()
    {
        return $this->comments;
    }*/

    /**
     * Set user
     *
     * @param \Aet\AnnuaireBundle\Entity\User $user
     * @return Communication
     */
    public function setUser(\Aet\AnnuaireBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Aet\AnnuaireBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set thread
     *
     * @param string $thread
     * @return Communication
     */
    public function setThread($thread)
    {
        $this->thread = $thread;

        return $this;
    }

    /**
     * Get thread
     *
     * @return string 
     */
    public function getThread()
    {
        return $this->thread;
    }


    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Communication
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
     * Set image
     *
     * @param \Aet\CommunicationBundle\Entity\Image $image
     * @return Communication
     */
    public function setImage(\Aet\CommunicationBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Aet\CommunicationBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set shortDesc
     *
     * @param string $shortDesc
     * @return Communication
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;

        return $this;
    }

    /**
     * Get shortDesc
     *
     * @return string 
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }
}

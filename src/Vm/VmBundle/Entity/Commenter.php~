<?php

namespace Vm\VmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vm\VmBundle\Utils\Vms as Vms;

/**
 * Commenter
 */
class Commenter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nama;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $is_approved;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;
    private $comment;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nama
     *
     * @param string $nama
     * @return Commenter
     */
    public function setNama($nama)
    {
        $this->nama = $nama;

        return $this;
    }

    /**
     * Get nama
     *
     * @return string 
     */
    public function getNama()
    {
        return $this->nama;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Commenter
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Commenter
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }
    
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set is_approved
     *
     * @param boolean $isApproved
     * @return Commenter
     */
    public function setIsApproved($isApproved)
    {
        $this->is_approved = $isApproved;

        return $this;
    }

    /**
     * Get is_approved
     *
     * @return boolean 
     */
    public function getIsApproved()
    {
        return $this->is_approved;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Commenter
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Add comments
     *
     * @param \Vm\VmBundle\Entity\Comments $comments
     * @return Commenter
     */
    public function addComment(\Vm\VmBundle\Entity\Comments $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Vm\VmBundle\Entity\Comments $comments
     */
    public function removeComment(\Vm\VmBundle\Entity\Comments $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->created_at = new \DateTime();
    }

    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        if(!$this->getToken())
        {
			$st = date('Y-m-d H:i:s');
			$st = $st.$this->getEmail();
			$this->token = sha1($st.rand(11111, 99999));
		}
    }
    /**
     * @var \DateTime
     */
    private $updated_at;


    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Commenter
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }
    
    public function __toString()
    {
		return $this->getNama()? $this->getNama() : "";
	}
}

<?php

namespace Vm\VmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vm\VmBundle\Utils\Vms as Vms;
/**
 * Comments
 */
class Comments
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comments;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $is_activated;

    /**
     * @var boolean
     */
    private $is_reply;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Vm\VmBundle\Entity\Knowledge
     */
    private $knowledges;

    /**
     * @var \Vm\VmBundle\Entity\Commenter
     */
    private $commenter;


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
     * Set comments
     *
     * @param string $comments
     * @return Comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Comments
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

    /**
     * Set is_activated
     *
     * @param boolean $isActivated
     * @return Comments
     */
    public function setIsActivated($isActivated)
    {
        $this->is_activated = $isActivated;

        return $this;
    }

    /**
     * Get is_activated
     *
     * @return boolean 
     */
    public function getIsActivated()
    {
        return $this->is_activated;
    }

    /**
     * Set is_reply
     *
     * @param boolean $isReply
     * @return Comments
     */
    public function setIsReply($isReply)
    {
        $this->is_reply = $isReply;

        return $this;
    }

    /**
     * Get is_reply
     *
     * @return boolean 
     */
    public function getIsReply()
    {
        return $this->is_reply;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Comments
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
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Comments
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
     * Set knowledges
     *
     * @param \Vm\VmBundle\Entity\Knowledge $knowledges
     * @return Comments
     */
    public function setKnowledges(\Vm\VmBundle\Entity\Knowledge $knowledges = null)
    {
        $this->knowledges = $knowledges;

        return $this;
    }

    /**
     * Get knowledges
     *
     * @return \Vm\VmBundle\Entity\Knowledge 
     */
    public function getKnowledges()
    {
        return $this->knowledges;
    }

    /**
     * Set commenter
     *
     * @param \Vm\VmBundle\Entity\Commenter $commenter
     * @return Comments
     */
    public function setCommenter(\Vm\VmBundle\Entity\Commenter $commenter = null)
    {
        $this->commenter = $commenter;

        return $this;
    }

    /**
     * Get commenter
     *
     * @return \Vm\VmBundle\Entity\Commenter 
     */
    public function getCommenter()
    {
        return $this->commenter;
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
			$this->token = sha1($st.rand(11111, 99999));
		}
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }
    /**
     * @var int
     */
    private $ref_comments_id;


    /**
     * Set ref_comments_id
     *
     * @param \int $refCommentsId
     * @return Comments
     */
    public function setRefCommentsId($refCommentsId)
    {
        $this->ref_comments_id = $refCommentsId;

        return $this;
    }

    /**
     * Get ref_comments_id
     *
     * @return \int 
     */
    public function getRefCommentsId()
    {
        return $this->ref_comments_id;
    }
}

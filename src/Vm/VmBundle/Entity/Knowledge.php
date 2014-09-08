<?php

namespace Vm\VmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vm\VmBundle\Utils\Vms as Vms;
/**
 * Knowledge
 */
class Knowledge
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $writer;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $knowledge;

    /**
     * @var string
     */
    private $token;

    /**
     * @var boolean
     */
    private $is_activated;

    /**
     * @var string
     */
    private $writer_email;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;

    /**
     * @var \Vm\VmBundle\Entity\Category
     */
    private $category;
    
    public $file;

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
     * Set writer
     *
     * @param string $writer
     * @return Knowledge
     */
    public function setWriter($writer)
    {
        $this->writer = $writer;

        return $this;
    }

    /**
     * Get writer
     *
     * @return string 
     */
    public function getWriter()
    {
        return $this->writer;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Knowledge
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Knowledge
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
     * Set knowledge
     *
     * @param string $knowledge
     * @return Knowledge
     */
    public function setKnowledge($knowledge)
    {
        $this->knowledge = $knowledge;

        return $this;
    }

    /**
     * Get knowledge
     *
     * @return string 
     */
    public function getKnowledge()
    {
        return $this->knowledge;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Knowledge
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
     * @return Knowledge
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
     * Set writer_email
     *
     * @param string $writerEmail
     * @return Knowledge
     */
    public function setWriterEmail($writerEmail)
    {
        $this->writer_email = $writerEmail;

        return $this;
    }

    /**
     * Get writer_email
     *
     * @return string 
     */
    public function getWriterEmail()
    {
        return $this->writer_email;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Knowledge
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
     * @return Knowledge
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
     * Add comments
     *
     * @param \Vm\VmBundle\Entity\Comments $comments
     * @return Knowledge
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
     * Set category
     *
     * @param \Vm\VmBundle\Entity\Category $category
     * @return Knowledge
     */
    public function setCategory(\Vm\VmBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Vm\VmBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * @ORM\PrePersist
     */
    public function setTokenValue()
    {
        if(!$this->getToken())
        {
			$st = date('Y-m-d H:i:s');
			$st = $st.$this->getWriterEmail();
			$this->token = sha1($st.rand(11111, 99999));
		}
    }
    
    protected function getUploadDir()
    {
		return 'uploads/knowledges';
	}
	
	protected function getUploadRootDir()
	{
		return __DIR__.'/../../../../web/'.$this->getUploadDir();
	}
	
	public function getWebPath()
	{
		return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
	}
	
	public function getAbsolutePath()
	{
		return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
	}

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if(null !== $this->file)
        {
			$this->image = uniqid().'.'.$this->file->guessExtension();
		}
    }
    public function __toString()
    {
		return $this->getTitle()? $this->getTitle() : "";
	}

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if(!$this->getCreatedAt()){
			$this->created_at = new \DateTime();
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
     * @ORM\PostPersist
     */
    public function upload()
    {
        if(null === $this->file)
        {
			return;
		}
		$this->file->move($this->getUploadDir(), $this->image);
		unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        $file = $this->getAbsolutePath();
        if(file_exists($file))
        {
			unlink($file);
		}
    }
    
    public function publish()
    {
		$this->setIsActivated(true);
	}
	
	public function getTitleSlug()
    {
		return Vms::slugify($this->getTitle());
	}
	
	public function getWriterSlug()
	{
		return Vms::slugify($this->getWriter());
	}
	
	public function getCategorySlug()
	{
		return Vms::slugify($this->getCategory());
	}
	
	public function getChunkKnowledge()
	{
		return Vms::chunk($this->getKnowledge(),161);
	}

    /**
     * @ORM\PreUpdate
     */
    public function removeUpdate()
    {
      
    }
    
    public function asArray($host)
    {
		return array(
			'category' => $this->getCategory()->getName(),
			'title' => $this->getTitle(),
			'writer' => $this->getWriter(),
			'knowledges' => $this->getKnowledge(),
			'image' => $this->getImage() ? 'http://'.$host.'/uploads/knowledges/'.$this->getImage() : null,
		);
	}
	
	static public function getLucineIndex()
	{
		if(file_exists($index = self::getLuceneIndexFile())){
				return \Zend_Search_Lucene::open($index);
			}
		
		return \Zend_Search_Lucene::create($index);
	}
	
	static public function getLuceneIndexFile()
	{
		return __DIR__.'/../../../../web/data/knowledge.index';
	}

    /**
     * @ORM\PostPersist
     */
    public function updateLuceneIndex()
    {
        $index = self::getLucineIndex();
        
        foreach ($index->find('pk:'.$this->getId()) as $hit)
        {
			$index->delete($hit->id);
		}
		
		if(!$this->getIsActivated()){
			return;
			}
			
		$doc = new \Zend_Search_Lucene_Document();
		
		$doc->addField(\Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
		
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('title', $this->getTitle(), 'utf-8'));
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('knowledge', $this->getKnowledge(), 'utf-8'));
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('writer', $this->getWriter(), 'utf-8'));
		$doc->addField(\Zend_Search_Lucene_Field::UnStored('category', $this->getCategory(), 'utf-8'));
		
		$index->addDocument($doc);
		$index->commit();
    }

    /**
     * @ORM\PostRemove
     */
    public function deleteLuceneIndex()
    {
        $index = self::getLucineIndex();
        
        foreach ($index->find('pk:', $this->getId()) as $hit){
				$index->delete($hit->id);
			}
    }
}

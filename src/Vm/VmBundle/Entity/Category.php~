<?php

namespace Vm\VmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vm\VmBundle\Utils\Vms as Vms;
/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $knowledges;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $affiliates;
    private $new_knowledge;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->knowledges = new \Doctrine\Common\Collections\ArrayCollection();
        $this->affiliates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add knowledges
     *
     * @param \Vm\VmBundle\Entity\Knowledge $knowledges
     * @return Category
     */
    public function addKnowledge(\Vm\VmBundle\Entity\Knowledge $knowledges)
    {
        $this->knowledges[] = $knowledges;

        return $this;
    }

    /**
     * Remove knowledges
     *
     * @param \Vm\VmBundle\Entity\Knowledge $knowledges
     */
    public function removeKnowledge(\Vm\VmBundle\Entity\Knowledge $knowledges)
    {
        $this->knowledges->removeElement($knowledges);
    }

    /**
     * Get knowledges
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKnowledges()
    {
        return $this->knowledges;
    }

    /**
     * Add affiliates
     *
     * @param \Vm\VmBundle\Entity\Affiliate $affiliates
     * @return Category
     */
    public function addAffiliate(\Vm\VmBundle\Entity\Affiliate $affiliates)
    {
        $this->affiliates[] = $affiliates;

        return $this;
    }

    /**
     * Remove affiliates
     *
     * @param \Vm\VmBundle\Entity\Affiliate $affiliates
     */
    public function removeAffiliate(\Vm\VmBundle\Entity\Affiliate $affiliates)
    {
        $this->affiliates->removeElement($affiliates);
    }

    /**
     * Get affiliates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffiliates()
    {
        return $this->affiliates;
    }
    
    public function __toString()
    {
		return $this->getName()? $this->getName() : "";
	}
	
	public function setNewKnowledge($knowledge)
	{
		$this->new_knowledge = $knowledge;
	}
	
	public function getNewKnowledge()
	{
		return $this->new_knowledge;
	}
	
	public function getNameSlug()
	{
		return Vms::slugify($this->getName());
	}
    /**
     * @var string
     */
    private $slug;


    /**
     * Set slug
     *
     * @param string $slug
     * @return Category
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
        return Vms::slugify($this->getName());
    }
    /**
     * @ORM\PrePersist
     */
    public function setSlugValue()
    {
        $this->slug = Vms::slugify($this->getName());
    }
    
    private $more_knowledge;
    
    public function setMoreKnowledge($knowledge)
    {
		$this->more_knowledge = $knowledge >= 0 ? $knowledge : 0;
	}
	
	public function getMoreKnowledge()
	{
		return $this->more_knowledge;
	}
}

<?php
namespace Vm\VmBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vm\VmBundle\Entity\Affiliate;

class LoadAffiliateData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $em)
    {
        $affiliate = new Affiliate();
 
        $affiliate->setUrl('http://sensio-labs.com/');
        $affiliate->setEmail('address1@example.com');
        $affiliate->setToken('sensio-labs');
        $affiliate->setIsActive(true);
        $affiliate->addCategory($em->merge($this->getReference('category-fisika2')));
 
        $em->persist($affiliate);
 
        $affiliate = new Affiliate();
 
        $affiliate->setUrl('/');
        $affiliate->setEmail('address2@example.org');
        $affiliate->setToken('symfony');
        $affiliate->setIsActive(false);
        $affiliate->addCategory($em->merge($this->getReference('category-fisika4')), $em->merge($this->getReference('category-matematika4')));
 
        $em->persist($affiliate);
        $em->flush();
 
        $this->addReference('affiliate', $affiliate);
    }
 
    public function getOrder()
    {
        return 5; // This represents the order in which fixtures will be loaded
    }
}

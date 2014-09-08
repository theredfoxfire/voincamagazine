<?php
namespace Vm\VmBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vm\VmBundle\Entity\Comments;

class LoadCommentsData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $em)
	{
		for($i=0;$i<10; $i++)
		{
			$cm = new Comments();
			$cm->setKnowledges($em->merge($this->getReference('knowledge-matematika'.$i)));
			$cm->setCommenter($em->merge($this->getReference('commenter'.$i)));
			$cm->setComments('Saya pikir semua hal tentang perkalian adalah hal yang bagus');
			
			$em->persist($cm);
		}
			$em->flush();
	}
	public function getOrder()
	{
		return 4;
	}
}

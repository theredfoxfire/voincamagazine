<?php
namespace Vm\VmBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vm\VmBundle\Entity\Commenter;

class LoadCommenterData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $em)
	{
		for ($i=0; $i<10; $i++)
		{
			$cm = new Commenter();
			$cm->setNama('Supardi Wikromo');
			$cm->setEmail('supardi.wikromo7'.$i.'@gmail.com');
			
			$this->addReference('commenter'.$i, $cm);
			
			$em->persist($cm);
		}
			$em->flush();
	}
	public function getOrder()
	{
		return 3;
	}
}

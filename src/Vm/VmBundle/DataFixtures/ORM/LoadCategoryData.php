<?php
namespace Vm\VmBundle\DataFixtures\ORM;

use Doctrine\Common\persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vm\VmBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $em)
	{
		$mtk = new Category();
		$mtk->setName('Matematika');
		
		$fsk = new Category();
		$fsk->setName('Fisika');
		
		$bpk = new Category();
		$bpk->setName('Budi Pekerti');
		
		$sja = new Category();
		$sja->setName('Sastra Jawa');
		
		$em->persist($mtk);
		$em->persist($fsk);
		$em->persist($bpk);
		$em->persist($sja);
		
		for($i=1;$i<5;$i++){
		$mtk = new Category();
		$mtk->setName('Matematika'.$i);
		
		$fsk = new Category();
		$fsk->setName('Fisika'.$i);
		
		$bpk = new Category();
		$bpk->setName('Budi Pekerti'.$i);
		
		$sja = new Category();
		$sja->setName('Sastra Jawa'.$i);
		
		$this->addReference('category-matematika'.$i, $mtk);
		$this->addReference('category-fisika'.$i, $fsk);
		$this->addReference('category-budipekerti'.$i, $bpk);
		$this->addReference('category-sastrajawa'.$i, $sja);
		
		$em->persist($mtk);
		$em->persist($fsk);
		$em->persist($bpk);
		$em->persist($sja);
		}
		$em->flush();
		
		$this->addReference('category-matematika', $mtk);
		$this->addReference('category-fisika', $fsk);
		$this->addReference('category-budipekerti', $bpk);
		$this->addReference('category-sastrajawa', $sja);
	}
	public function getOrder()
	{
		return 1;
	}
}

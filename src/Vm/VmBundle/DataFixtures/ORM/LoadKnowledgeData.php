<?php
namespace Vm\Vmbundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Vm\VmBundle\Entity\Knowledge;

class LoadKnowledgeData extends AbstractFixture implements OrderedFixtureInterface
{
	public function load(ObjectManager $em)
	{
		for($i=0;$i<14;$i++){
		$mtk = new Knowledge();
		$mtk->setCategory($em->merge($this->getReference('category-matematika')));
		$mtk->setWriter('Rudy Wijaya');
		$mtk->setTitle('Persamaan Linear Tiga Variabel');
		$mtk->setKnowledge('Kedua SPLTV tersebut merupakan dua sistem yang ekuivalen karena selesaiannya sama, yaitu (–3, 1, 1). Akan tetapi, SPLTV yang kedua lebih sederhana daripada SPLTV yang pertama karena persamaan 2 dan 3 pada SPLTV kedua memiliki variabel yang sedikit daripada SPLTV yang pertama. (Catatan: Persamaan 2 dan 3 secara berturut-turut artinya persamaan yang terletak di baris ke-2 dan ke-3 dari suatu sistem). Pada SPLTV yang kedua, kita dapat mensubstitusi z = 1 ke persamaan ke-2 untuk mendapatkan y = 1, dan mensubstitusi kedua nilai tersebut ke dalam persamaan 1 untuk memperoleh x = –3.');
		$mtk->setToken('mtk_persamaan_linear_tiga_variabel'.$i);
		$mtk->setIsActivated(true);
		$mtk->setWriterEmail('rudy.wijaya88@gmail.com');
		
		$fsk = new Knowledge();
		$fsk->setCategory($em->merge($this->getReference('category-fisika')));
		$fsk->setWriter('Steave Kaznyzk');
		$fsk->setTitle('Black Hole in Physics');
		$fsk->setKnowledge('Quantum mechanics (QM; also known as quantum physics, or quantum theory) is a branch of physics which deals with physical phenomena at nanoscopic scales where the action is on the order of the Planck constant. It departs from classical mechanics primarily at the quantum realm of atomic and subatomic length scales. Quantum mechanics provides a mathematical description of much of the dual particle-like and wave-like behavior and interactions of energy and matter. Quantum mechanics provides a substantially useful framework for many features of the modern periodic table of elements including the behavior of atoms during chemical bonding and has played a significant role in the development of many modern technologies.');
		$fsk->setToken('fsk_black_hole_in_physics'.$i);
		$fsk->setIsActivated(true);
		$fsk->setWriterEmail('steave.kaznyzk@gmail.com');
		
		$bpk = new Knowledge();
		$bpk->setCategory($em->merge($this->getReference('category-budipekerti')));
		$bpk->setWriter('Sumitro Kromo Wijoyo');
		$bpk->setTitle('Pituduh Budi Pakerti kelawan Dharma');
		$bpk->setKnowledge('Sifat Perbuatan Lahiriyah Agampang janma sembayang, nora angel wong angaji, pakewuhe wong agesang, angadu sukma lan jisim, salang surup urip, akeh wong bisa celathu, sajatine tan wikan, lir wong dagang madu gendhis, iya iku wong kandheng ahli sarengat. Sang Dyah kasmaran ing ngelmi, tan nyipta pinundhut garwa, amaguru ing batine, kalangkung bekti ing priya. Ping tiga ran bayuara, ya tapaning estri ingkang utami, lire bangkit nyaring tutur, rembuge pawong sanak, tan ………, kang tinekadken ing driya, pituturing guru laki.');
		$bpk->setToken('bpk_pituduh_budi_pakerti_kelawan_dharma'.$i);
		$bpk->setIsActivated(true);
		$bpk->setWriterEmail('sumitro.joyo@gmail.com');
		
		$sja = new Knowledge();
		$sja->setCategory($em->merge($this->getReference('category-sastrajawa')));
		$sja->setWriter('Nur Ya Wikrama');
		$sja->setTitle('Megatruh lan Pemahamanipun');
		$sja->setKnowledge('kacarita kyana patih dhendhabahu pan sarwia teken encis amenggang gesar wawulung apindha jakir nagari yen ka anggul janma menggok Aywa kliru kang jeneng urip iku. Ya kang gumelar neng bumi. Sing bisa branahan iku .Run tumurun ing salami Tetuwuhan kewan janma. Kabeh iku mung manungsa kang pinujul marga duwe lahir batin jroning urip iku mau isi ati klawan budi iku pirantine ewong.');
		$sja->setToken('sja_megatruh_lan_pemahamanipun'.$i);
		$sja->setIsActivated(true);
		$sja->setWriterEmail('nur.krama@gmail.com');
		
		$this->addReference('knowledge-matematika'.$i, $mtk);
		$this->addReference('knowledge-fisika'.$i, $fsk);
		$this->addReference('knowledge-budipekerti'.$i, $bpk);
		$this->addReference('knowledge-sastrajawa'.$i, $sja);
		
		$em->persist($mtk);
		$em->persist($fsk);
		$em->persist($bpk);
		$em->persist($sja);
		}
		$em->flush();
	}
	
	public function getOrder()
	{
		return 2;
	}
}

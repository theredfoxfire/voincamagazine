<?php

namespace Vm\VmBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
	public function getWithKnowledge( $max = null )
	{
		$query = $this->getEntityManager()->createQuery(
		'SELECT c FROM VmVmBundle:Category c LEFT JOIN c.knowledges k WHERE k.is_activated = :is'
		)->setParameter('is',1);
		if($max){
		$query->setMaxResults($max);
		}
		$results = new Paginator($query);
		return $results;
	}
	
	public function getOthersCategory($fr = null, $max = null)
	{
		$qb = $this->createQueryBuilder('c')
			->orderBy('c.id', 'ASC');
		$query = $qb->getQuery();
		$query->setFirstResult($fr);
		$query->setMaxResults($max);
		$results = new Paginator($query);
		return $results;
	}
}

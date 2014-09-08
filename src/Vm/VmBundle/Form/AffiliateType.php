<?php
namespace Vm\VmBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vm\VmBundle\Entity\Affiliate;
use Vm\VmBundle\Entity\Category;

class AffiliateType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $oprions)
	{
		$builder
			->add('url', 'url', array('label' => 'Url web/blog, ex:(http://www.blogmu.com)', 'attr' => array('value' => 'http://www.')))
			->add('email')
			->add('categories', null, array('expanded' => true, 'label' => 'Pilih kategori'))
			->add('submit', 'submit', array('label' => 'Saya minta Api!'))
		;
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
		'data_class' => 'Vm\VmBundle\Entity\Affiliate',
		));
	}
	
	public function getName()
	{
		return 'affiliate';
	}
}

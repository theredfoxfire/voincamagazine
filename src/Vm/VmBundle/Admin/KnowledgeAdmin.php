<?php
namespace Vm\VmBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vm\VmBundle\Entity\Knowledge;

class KnowledgeAdmin extends Admin
{
	protected $datagridValues = array(
		'_sort_order' => 'DESC',
		'_sort_by' => 'created_at'
	);
	
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('writer')
            ->add('file', 'file', array('label' => 'Gambar', 'required' => false))
            ->add('title')
            ->add('knowledge')
            ->add('is_activated')
            ->add('writer_email')
            ->add('category')
            ;
	}
	
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('writer')
		->add('title')
		->add('knowledge')
		->add('is_activated')
		->add('writer_email')
		->add('category')
		;
	}
	
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('writer')
		->add('knowledge')
		->add('is_activated')
		->add('writer_email')
		->add('category')
		->add('_action', 'actions', array(
			'actions' => array(
				'show' => array(),
				'edit' => array(),
				'delete' => array(),
			)))
		;
	}
	
	protected function configureShowField(ShowMapper $showMapper)
	{
		$showMapper
		->add('category')
		->add('title')
		->add('knowledge')
		->add('webPath', 'string', array('template' => 'VmVmBundle:KnowledgeAdmin:list_image.html.twig'))
		->add('is_activated')
		->add('writer')
		->add('writer_email')
		->add('token')
		;
	}
	
	public function getBatchActions()
	{
		$actions = parent::getBatchActions();
		
		if ($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE'))
		{
			$actions['extend'] = array(
			'label' => 'Extend',
			'ask_confirmation' => true
			);
		}
		
		return $actions;
	}
}

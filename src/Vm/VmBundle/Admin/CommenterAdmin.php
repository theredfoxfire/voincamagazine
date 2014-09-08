<?php
namespace Vm\VmBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validation\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vm\VmBundle\Entity\Commenter;

class CommenterAdmin extends Admin
{
	protected $datagridValues = array(
		'_sort_order' => 'DESC',
		'_sort_by' => 'created_at'
	);
	
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
			->add('nama')
            ->add('email')
            ->add('is_approved')
            ->add('created_at')
            ->add('updated_at')
            ;
	}
	
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
			->add('nama')
            ->add('email')
            ->add('is_approved')
            ->add('created_at')
            ->add('updated_at')
            ;
	}
	
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
			->add('nama')
            ->addIdentifier('email')
            ->add('is_approved')
            ->add('created_at')
            ->add('updated_at')
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
			->add('nama')
            ->add('email')
            ->add('is_approved')
            ->add('created_at')
            ->add('updated_at')
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

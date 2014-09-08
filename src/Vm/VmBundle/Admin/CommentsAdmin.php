<?php
namespace Vm\VmBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validation\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Vm\VmBundle\Entity\Comments;

class CommentsAdmin extends Admin
{
	protected $datagridValues = array(
		'_sort_order' => 'DESC',
		'_sort_by' => 'created_at'
	);
	
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->add('ref_comments_id')
        ->add('comments')
        ->add('is_activated')
        ->add('is_reply')
        ->add('knowledges')
        ->add('commenter')
		;
	}
	
	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('ref_comments_id')
        ->add('comments')
        ->add('is_activated')
        ->add('is_reply')
        ->add('knowledges')
        ->add('commenter')
        ;
	}
	
	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('ref_comments_id')
        ->add('comments')
        ->add('is_activated')
        ->add('is_reply')
        ->add('knowledges')
        ->add('commenter')
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
		->add('ref_comments_id')
        ->add('comments')
        ->add('is_activated')
        ->add('is_reply')
        ->add('created_at')
        ->add('updated_at')
        ->add('knowledges')
        ->add('commenter')
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

<?php
namespace Vm\VmBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController as Controller;
use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as ProxyQueryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CommenterAdminController extends Controller
{
	public function batchActionExtend(ProxyQueryInterface $selectedModelQuery)
	{
		if ($this->admin->isGranted('EDIT') === false || $this->admin->isGranted('DELETE') === false )
		{
			throw new AccessDeniedException();
		}
		
		$modelManager = $this->admin->getModelManager();
		$selectedModels = $selectedModelQuery->execute();
		try{
			foreach ($selectedModels as $selectedModel){
				$selectedModel->extend();
				$modelManager->update($selectedModel);
				}
			} catch (\Exception $e){
				$this->get('session')->getFlashBag()->add('sonata_flash_error', $e->getMessage());
				return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
				}
			$this->get('session')->getFlashBag()->add('sonata_flash_succes', sprintf('The selected commenter validity has been extnds until %s.',
			date('m/d/Y', time() + 86400 * 30)));
			
			return new RedirectResponse($this->admin->generateUrl('list', $this->admin->getFilterParameters()));
	}
}

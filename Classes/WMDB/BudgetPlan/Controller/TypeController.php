<?php
namespace WMDB\BudgetPlan\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use WMDB\BudgetPlan\Domain\Model\Type;

/**
 * Class StandardController
 *
 * @package WMDB\BudgetPlan\Controller
 */
class TypeController extends ActionController {

	/**
	 * @var \WMDB\BudgetPlan\Domain\Repository\TypeRepository
	 * @Flow\Inject
	 */
	protected $typeRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$types = $this->typeRepository->findAll();
		$this->view->assign('types', $types);
	}

	public function newAction() {}

	/**
	 * Creates a new Type
	 *
	 * @param Type $type
	 */
	public function createAction(Type $type) {
		$this->typeRepository->add($type);
		$this->addFlashMessage('Type '.$type->getTitle().' added.');
		$this->redirect('index');
	}

}
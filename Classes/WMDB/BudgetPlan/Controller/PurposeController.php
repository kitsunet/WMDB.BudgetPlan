<?php
namespace WMDB\BudgetPlan\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use WMDB\BudgetPlan\Domain\Model\Purpose;

/**
 * Class StandardController
 *
 * @package WMDB\BudgetPlan\Controller
 */
class PurposeController extends ActionController {

	/**
	 * @var \WMDB\BudgetPlan\Domain\Repository\PurposeRepository
	 * @Flow\Inject
	 */
	protected $purposeRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$purposes = $this->purposeRepository->findAll();
		$this->view->assign('purposes', $purposes);
	}

	public function newAction() {}

	/**
	 * Creates a new Purpose
	 *
	 * @param Purpose $purpose
	 */
	public function createAction(Purpose $purpose) {
		$this->purposeRepository->add($purpose);
		$this->addFlashMessage('Purpose '.$purpose->getTitle().' added.');
		$this->redirect('index');
	}

	/**
	 * Edit Action
	 *
	 * @param Purpose $purpose
	 */
	public function editAction(Purpose $purpose) {
		$this->view->assign('purpose', $purpose);
	}

	/**
	 * Update Action
	 *
	 * @param Purpose $purpose
	 */
	public function updateAction(Purpose $purpose) {
		$this->purposeRepository->update($purpose);
		$this->addFlashMessage('Purpose '.$purpose->getTitle().' updated.');
		$this->redirect('index');
	}

	/**
	 * Delete Action
	 *
	 * @param Purpose $purpose
	 */
	public function deleteAction(Purpose $purpose) {
		$this->purposeRepository->remove($purpose);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Purpose '.$purpose->getTitle().' deleted.');
		$this->redirect('index');
	}

}
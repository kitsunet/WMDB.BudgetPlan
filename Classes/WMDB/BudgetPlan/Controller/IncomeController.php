<?php
namespace WMDB\BudgetPlan\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use WMDB\BudgetPlan\Domain\Model\Income;

/**
 * Class StandardController
 *
 * @package WMDB\BudgetPlan\Controller
 */
class IncomeController extends ActionController {

	/**
	 * @var \WMDB\BudgetPlan\Domain\Repository\IncomeRepository
	 * @Flow\Inject
	 */
	protected $incomeRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$incomes = $this->incomeRepository->findAll();
		$this->view->assign('incomes', $incomes);
	}

	public function newAction() {}

	/**
	 * Creates a new Income
	 *
	 * @param Income $income
	 */
	public function createAction(Income $income) {
		$this->incomeRepository->add($income);
		$this->addFlashMessage('Income '.$income->getTitle().' added.');
		$this->redirect('index');
	}

	/**
	 * Pre-Processing for the create acrtion
	 */
	public function initializeCreateAction() {
		$propertyMappingConfiguration = $this->fixDate();
	}

	/**
	 * Pre-Processing for the create acrtion
	 */
	public function initializeUpdateAction() {
		$propertyMappingConfiguration = $this->fixDate();
	}

	/**
	 * Edit Action
	 *
	 * @param Income $income
	 */
	public function editAction(Income $income) {
		$this->view->assign('income', $income);
	}

	/**
	 * Update Action
	 *
	 * @param Income $income
	 */
	public function updateAction(Income $income) {
		$this->incomeRepository->update($income);
		$this->addFlashMessage('Income '.$income->getTitle().' updated.');
		$this->redirect('index');
	}

	/**
	 * Delete Action
	 *
	 * @param Income $income
	 */
	public function deleteAction(Income $income) {
		$this->incomeRepository->remove($income);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Income '.$income->getTitle().' deleted.');
		$this->redirect('index');
	}

	/**
	 * @return \TYPO3\Flow\Property\PropertyMappingConfiguration
	 */
	protected function fixDate(){
		$propertyMappingConfiguration = $this->arguments->getArgument('income')->getPropertyMappingConfiguration();
		$propertyMappingConfiguration
			->forProperty('date')
			->setTypeConverterOption(
				'TYPO3\Flow\Property\TypeConverter\DateTimeConverter',
				\TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT,
				'd.m.Y'
			);
		return $propertyMappingConfiguration->forProperty('end')->setTypeConverterOption('TYPO3\Flow\Property\TypeConverter\DateTimeConverter', \TYPO3\Flow\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
	}

}
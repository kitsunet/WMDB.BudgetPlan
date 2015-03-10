<?php
namespace WMDB\BudgetPlan\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter;
use WMDB\BudgetPlan\Domain\Model\Purpose;
use WMDB\BudgetPlan\Domain\Model\Reimbursement;

/**
 * Class StandardController
 *
 * @package WMDB\BudgetPlan\Controller
 */
class ReimbursementController extends ActionController {

	/**
	 * @var \WMDB\BudgetPlan\Domain\Repository\PurposeRepository
	 * @Flow\Inject
	 */
	protected $purposeRepository;

	/**
	 * Inject the TypeRepository
	 *
	 * @var \WMDB\BudgetPlan\Domain\Repository\TypeRepository
	 * @Flow\Inject
	 */
	protected $typeRepository;

	/**
	 * Inject the PersonRepository
	 *
	 * @var \WMDB\BudgetPlan\Domain\Repository\PersonRepository
	 * @Flow\Inject
	 */
	protected $personRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 */
	protected $authManager;

	/**
	 * Inject the AccountRepository
	 *
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;

	/**
	 * @return void
	 */
	public function indexAction() {

	}

	public function newAction() {
		$types = $this->typeRepository->findAll();
		$this->view->assign('types', $types);
		$currentUser = $this->authManager->getSecurityContext()->getAccount();
		$this->view->assign('username', $currentUser->getAccountIdentifier());
		$personObject = $this->personRepository->findOneByUserAccount($currentUser);
		if ($personObject === NULL) {
			// Create dummy object
			$personObject = new Person();
			$personObject->setUserAccount($currentUser = $this->authManager->getSecurityContext()->getAccount());
		}
		$this->view->assign('person', $personObject);
	}

	/**
	 * Pre-Processing for the create acrtion
	 */
	public function initializeCreateAction() {
		$this->fixDate();
		$propertyMappingConfiguration = $this->arguments->getArgument('reimbursement')->getPropertyMappingConfiguration();
		$entriesConfiguration = $propertyMappingConfiguration->forProperty('entries')->allowAllProperties()->forProperty('*');
		$entriesConfiguration->allowAllProperties();
		$entriesConfiguration->setTypeConverterOption(PersistentObjectConverter::class, PersistentObjectConverter::CONFIGURATION_CREATION_ALLOWED, TRUE);
	}

	/**
	 * Pre-Processing for the create acrtion
	 */
	public function initializeUpdateAction() {
		$propertyMappingConfiguration = $this->fixDate();
	}

	/**
	 * Creates a new Purpose
	 *
	 * @param Reimbursement $reimbursement
	 */
	public function createAction(Reimbursement $reimbursement) {
		\TYPO3\Flow\var_dump($reimbursement);
//		$this->purposeRepository->add($purpose);
//		$this->addFlashMessage('Purpose '.$purpose->getTitle().' added.');
//		$this->redirect('index');
	}

	/**
	 * Edit Action
	 *
	 * @param Purpose $purpose
	 */
	public function editAction(Purpose $purpose) {
		$types = $this->typeRepository->findAll();
		$this->view->assign('types', $types);
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

	/**
	 * @return \TYPO3\Flow\Property\PropertyMappingConfiguration
	 */
	protected function fixDate(){
		$propertyMappingConfiguration = $this->arguments->getArgument('reimbursement')->getPropertyMappingConfiguration();
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
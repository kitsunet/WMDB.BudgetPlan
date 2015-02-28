<?php
namespace WMDB\BudgetPlan\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use WMDB\BudgetPlan\Domain\Model\Income;
use WMDB\BudgetPlan\Domain\Model\Person;

/**
 * Class StandardController
 *
 * @package WMDB\BudgetPlan\Controller
 */
class ProfileController extends ActionController {

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
	 * @param Person $person
	 */
	public function updateAction(Person $person) {
		$person->setUserAccount($currentUser = $this->authManager->getSecurityContext()->getAccount());
		try {
			$this->personRepository->update($person);
		} catch (\Exception $e) {
			$this->personRepository->add($person);
		}
		$this->redirect('index');
	}

}
<?php
namespace WMDB\BudgetPlan\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Security\Account;
use WMDB\BudgetPlan\Domain\Model\Income;

/**
 * Class StandardController
 *
 * @package WMDB\BudgetPlan\Controller
 */
class UserController extends ActionController {

	/**
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;

	/**
	 * Inject the RoleRepository
	 *
	 * @var \TYPO3\Flow\Security\Policy\RoleRepository
	 * @Flow\Inject
	 */
	protected $roleRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$users = $this->getUsers();
		$this->view->assign('users', $users);
	}

	/**
	 * Promotes a user up one group
	 *
	 * @param Account $user
	 */
	public function promoteAction(Account $user){
		$roles = $user->getRoles();
		if (count($roles) > 1) {
			throw new \InvalidArgumentException('More than one Role? naaaa');
		}
		$role = array_keys($roles);
		$oldRole = $this->roleRepository->findByIdentifier($role[0]);
		switch($oldRole->getName()) {
			case 'Guest':
				$newRole = $this->roleRepository->findByIdentifier('WMDB.BudgetPlan:User');
				break;
			case 'User':
				$newRole = $this->roleRepository->findByIdentifier('WMDB.BudgetPlan:Admin');
				break;
			default:
				$newRole = $this->roleRepository->findByIdentifier('WMDB.BudgetPlan:Guest');
		}
		$user->removeRole($oldRole);
		$user->addRole($newRole);
		$this->accountRepository->update($user);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Promoted '.$user->getAccountIdentifier().' from '.$oldRole->getIdentifier().' to '.$newRole->getIdentifier());
		$this->redirect('index');
	}

	/**
	 * Demotes a user down one group
	 *
	 * @param Account $user
	 */
	public function demoteAction(Account $user){
		$roles = $user->getRoles();
		if (count($roles) > 1) {
			throw new \InvalidArgumentException('More than one Role? naaaa');
		}
		$role = array_keys($roles);
		$oldRole = $this->roleRepository->findByIdentifier($role[0]);
		switch($oldRole->getName()) {
			case 'Admin':
				$newRole = $this->roleRepository->findByIdentifier('WMDB.BudgetPlan:User');
				break;
			case 'User':
				$newRole = $this->roleRepository->findByIdentifier('WMDB.BudgetPlan:Guest');
				break;
			default:
				$newRole = $this->roleRepository->findByIdentifier('WMDB.BudgetPlan:Guest');
		}
		$user->removeRole($oldRole);
		$user->addRole($newRole);
		$this->accountRepository->update($user);
		$this->persistenceManager->persistAll();
		$this->addFlashMessage('Demoted '.$user->getAccountIdentifier().' from '.$oldRole->getIdentifier().' to '.$newRole->getIdentifier());
		$this->redirect('index');
	}

	/**
	 * @return array
	 */
	protected function getUsers() {
		$out = array();
		$userList = $this->accountRepository->findAll();
		/**
		 * @var $userRow \TYPO3\Flow\Security\Account
		 */
		foreach ($userList as $userRow) {
			$roles = $userRow->getRoles();
			$grouping = 'Guests';
			if(in_array('WMDB.BudgetPlan:User', $roles)) {
				$grouping = 'Users';
			}
			if(in_array('WMDB.BudgetPlan:Admin', $roles)) {
				$grouping = 'Admins';
			}
			$out[$grouping][] = $userRow;
		}
		return $out;
	}

}
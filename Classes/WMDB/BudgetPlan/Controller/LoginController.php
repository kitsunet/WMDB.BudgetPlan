<?php
namespace WMDB\BudgetPlan\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Error\Message;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Security\Context;
use TYPO3\Flow\Security\Exception\AuthenticationRequiredException;

/**
 * LoginController
 *
 * Handles all stuff that has to do with the login
 */
class LoginController extends ActionController {

	/**
	 * @var \TYPO3\Flow\Security\Authentication\AuthenticationManagerInterface
	 * @Flow\Inject
	 */
	protected $authenticationManager;

	/**
	 * @var \TYPO3\Flow\Security\AccountRepository
	 * @Flow\Inject
	 */
	protected $accountRepository;

	/**
	 * @var \TYPO3\Flow\Security\AccountFactory
	 * @Flow\Inject
	 */
	protected $accountFactory;

	/**
	 * @var Context
	 */
	protected $securityContext;

	/**
	 * Injects the security context
	 *
	 * @param Context $securityContext The security context
	 * @return void
	 */
	public function injectSecurityContext(Context $securityContext) {
		$this->securityContext = $securityContext;
	}

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {
		// example how to access account informations
//		$account = $this->securityContext->getAccount();
		//\TYPO3\Flow\var_dump($account);
	}

	/**
	 * @throws AuthenticationRequiredException
	 * @return void
	 */
	public function authenticateAction() {
		try {
			$this->authenticationManager->authenticate();
			$this->addFlashMessage('Successfully logged in.');
			$this->redirect('index', 'Standard');
		} catch (AuthenticationRequiredException $exception) {
			$this->addFlashMessage('Username or Password unknown.', '', Message::SEVERITY_ERROR);
			$this->redirect('index', 'Login');
		}
	}

	/**
	 * @return void
	 */
	public function newAction() {
		// do nothing more than display the register form
	}

	/**
	 * save the registration
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $password2
	 */
	public function createAction($username, $password, $password2) {

		$defaultRole = 'WMDB.BudgetPlan:Guest';

		if ($username == '' || strlen($username) < 3) {
			$this->addFlashMessage('Username too short. Make sure you use at least 3 characters.', '', Message::SEVERITY_ERROR);
			$this->redirect('new', 'Login');
		} else if($password == '' || $password != $password2) {
			$this->addFlashMessage('Password too short or passwords do not match', '', Message::SEVERITY_ERROR);

			$this->redirect('new', 'Login');
		} else {

			// create a account with password an add it to the accountRepository
			$account = $this->accountFactory->createAccountWithPassword($username, $password, array($defaultRole));
			$this->accountRepository->add($account);

			// add a message and redirect to the login form
			$this->addFlashMessage('Account created. You may log in.');
			$this->redirect('index');
		}
		// redirect to the login form
		$this->redirect('index', 'Login');
	}

	/**
	 * Logs the user out
	 */
	public function logoutAction() {
		$this->authenticationManager->logout();
		$this->addFlashMessage('Logged out sucessfully.');
		$this->redirect('index', 'Login');
	}

}
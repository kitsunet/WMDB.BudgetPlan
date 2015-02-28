<?php
namespace WMDB\BudgetPlan\Command;

use TYPO3\Flow\Annotations as Flow;
use Elastica;
use TYPO3\Flow\Security\Policy\Role;
use WMDB\Forger\Utilities\ElasticSearch;
use TYPO3\Flow\Cli;


/**
 * Class testCommandController
 * @package WMDB\Forger\Command
 */
class SetupCommandController extends Cli\CommandController {

	/**
	 * Settings from the YAML files
	 * @var array
	 */
	protected $settings;

	/**
	 * @var \TYPO3\Flow\Security\Policy\RoleRepository
	 * @Flow\Inject
	 */
	protected $roleRepository;

	/**
	 * @param string $roleName
	 * @param string $packageName
	 */
	public function addGroupCommand($roleName, $packageName) {
		// Add Role
		$this->addPolicyRole($packageName.':'.$roleName);
		$this->roleRepository->persistEntities();
		$this->outputLine('Created role '.$packageName.':'.$roleName);
	}

	/**
	 * @param string $identifier
	 * @return string
	 */
	protected function addPolicyRole($identifier){
		if($this->roleRepository->findByIdentifier($identifier) === Null){
			$user = new Role($identifier);
			$this->roleRepository->add($user);
			$this->outputLine('Policy role:' . $identifier .' added ');
		}else{
			$this->outputLine('Policy role:' . $identifier .' allready exists');
		}
	}

	/**
	 * Injects the settings from the yaml file into
	 * @param array $settings
	 */
	public function injectSettings(array $settings) {
		$this->settings = $settings;
	}
}
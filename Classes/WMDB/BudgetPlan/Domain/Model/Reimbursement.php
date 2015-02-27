<?php
namespace WMDB\BudgetPlan\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class Reimbursement {
	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var \WMDB\BudgetPlan\Domain\Model\Person
	 * @ORM\ManyToOne
	 */
	protected $person;

	/**
	 * @var float
	 */
	protected $amount;

	/**
	 * @return \DateTime
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param \DateTime $date
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * @return Person
	 */
	public function getPerson() {
		return $this->person;
	}

	/**
	 * @param Person $person
	 */
	public function setPerson($person) {
		$this->person = $person;
	}

	/**
	 * @return float
	 */
	public function getAmount() {
		return $this->amount;
	}

	/**
	 * @param float $amount
	 */
	public function setAmount($amount) {
		$this->amount = $amount;
	}


}
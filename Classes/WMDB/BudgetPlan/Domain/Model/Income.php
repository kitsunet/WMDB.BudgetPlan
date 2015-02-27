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
class Income {
	/**
	 * @var \WMDB\BudgetPlan\Domain\Model\Type
	 * @ORM\ManyToOne(cascade={"persist"})
	 */
	protected $type;

	/**
	 * @var float
	 */
	protected $amount;

	/**
	 * @var \WMDB\BudgetPlan\Domain\Model\Person
	 * @ORM\ManyToOne
	 */
	protected $person;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @return Type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param Type $type
	 */
	public function setType($type) {
		$this->type = $type;
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

	/**
	 * @return Person
	 */
	public function getPerson() {
		return $this->person;
	}

	/**
	 * @param Person $person
	 */
	public function setPerson(Person $person) {
		$this->person = $person;
	}

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


}
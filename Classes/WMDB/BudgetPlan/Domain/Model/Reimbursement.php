<?php
namespace WMDB\BudgetPlan\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "WMDB.BudgetPlan".       *
 *                                                                        *
 *                                                                        */

use Doctrine\Common\Collections\ArrayCollection;
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
	 * @var ArrayCollection<\WMDB\BudgetPlan\Domain\Model\Entry>
	 * @ORM\OneToMany(cascade={"persist"}, mappedBy="extension")
	 */
	protected $entries;

	/**
	 * @var float
	 * @Flow\Transient
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

	/**
	 * @param \Doctrine\Common\Collections\Collection $entries
	 */
	public function setEntries($entries) {
		$this->entries = $entries;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getEntries() {
		return $this->entries;
	}

	/**
	 * Sets up the Doctrine collections
	 */
	public function __construct() {
		$this->versions = new ArrayCollection();
	}

	/**
	 * @param Entry $entry
	 */
	public function addVersion(Entry $entry) {
		$entry->setReimbursement($this);
		$this->versions->add($entry);
	}

	/**
	 * @param Entry $entry
	 */
	public function removeVersion(Entry $entry) {
		$this->entries->removeElement($entry);
	}


}
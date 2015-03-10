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
class Entry {
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
	 *
	 * @var \TYPO3\Media\Domain\Model\Asset
	 * @ORM\ManyToOne(cascade={"persist"})
	 */
	protected $receipt;

	/**
	 * @var \WMDB\BudgetPlan\Domain\Model\Reimbursement
	 * @ORM\ManyToOne(cascade={"persist"}, inversedBy="entries")
	 */
	protected $reimbursement;

	/**
	 * @return Reimbursement
	 */
	public function getReimbursement() {
		return $this->reimbursement;
	}

	/**
	 * @param Reimbursement $reimbursement
	 */
	public function setReimbursement($reimbursement) {
		$this->reimbursement = $reimbursement;
	}

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
	 * @return \TYPO3\Media\Domain\Model\Asset
	 */
	public function getReceipt() {
		return $this->receipt;
	}

	/**
	 * @param \TYPO3\Media\Domain\Model\Asset $receipt
	 */
	public function setReceipt($receipt) {
		$this->receipt = $receipt;
	}


}
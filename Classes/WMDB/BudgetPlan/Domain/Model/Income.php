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
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var \WMDB\BudgetPlan\Domain\Model\Purpose
	 * @ORM\ManyToOne(cascade={"persist"})
	 * @ORM\Column(nullable=true)
	 */
	protected $purpose;

	/**
	 * Title
	 *
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $title;

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
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return Purpose
	 */
	public function getPurpose() {
		return $this->purpose;
	}

	/**
	 * @param Purpose $purpose
	 */
	public function setPurpose($purpose) {
		$this->purpose = $purpose;
	}


}
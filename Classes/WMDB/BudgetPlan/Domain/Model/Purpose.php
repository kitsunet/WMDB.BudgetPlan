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
class Purpose {
	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=256})
	 */
	protected $title;

	/**
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * @var float
	 */
	protected $estimatedCost;

	/**
	 * @var float
	 * @ORM\Column(nullable=true)
	 */
	protected $effectiveCost;

	/**
	 * @var \WMDB\BudgetPlan\Domain\Model\Type
	 * @ORM\ManyToOne(cascade={"persist"})
	 */
	protected $type;

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
	 * @return float
	 */
	public function getEstimatedCost() {
		return $this->estimatedCost;
	}

	/**
	 * @param float $estimatedCost
	 */
	public function setEstimatedCost($estimatedCost) {
		$this->estimatedCost = $estimatedCost;
	}

	/**
	 * @return float
	 */
	public function getEffectiveCost() {
		return $this->effectiveCost;
	}

	/**
	 * @param float $effectiveCost
	 */
	public function setEffectiveCost($effectiveCost) {
		$this->effectiveCost = $effectiveCost;
	}

	/**
	 * @return \WMDB\BudgetPlan\Domain\Model\Type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param \WMDB\BudgetPlan\Domain\Model\Type $type
	 */
	public function setType(Type $type) {
		$this->type = $type;
	}


}
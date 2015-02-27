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
class BudgetEntry {
	/**
	 * The Budget in EUR
	 *
	 * @var float
	 */
	protected $amount;

	/**
	 * Title of the budget entry
	 *
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $title;

	/**
	 * Relation to the budget type
	 *
	 * @var \WMDB\BudgetPlan\Domain\Model\BudgetType
	 */
	protected $budgetType;

	/**
	 * For which event was the budget used
	 *
	 * @var \WMDB\BudgetPlan\Domain\Model\BudgetEvent
	 */
	protected $budgetEvent;
}
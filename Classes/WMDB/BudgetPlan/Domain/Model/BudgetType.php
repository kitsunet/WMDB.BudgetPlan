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
class BudgetType {

	/**
	 * Title of a budget Type
	 *
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $title;

	/**
	 * Is the budget event internal funding from the T3A?
	 *
	 * @var bool
	 */
	protected $internal;
}
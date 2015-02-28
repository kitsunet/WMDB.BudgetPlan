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
class Person {
	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $firstname;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $lastname;

	/**
	 * @var string
	 * @Flow\Validate(type="EmailAddress")
	 */
	protected $email;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $bankName;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $bankAddress;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $sortCode;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $accountNo;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $accountName;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $swiftCode;

	/**
	 * @var string
	 * @Flow\Validate(type="StringLength", options = {"minimum"=1, "maximum"=128})
	 */
	protected $iban;

	/**
	 * @var \TYPO3\Flow\Security\Account
	 * @ORM\OneToOne(cascade={"persist"})
	 */
	protected $userAccount;

	/**
	 * @return string
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * @param string $firstname
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * @return string
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * @param string $lastname
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getBankName() {
		return $this->bankName;
	}

	/**
	 * @param string $bankName
	 */
	public function setBankName($bankName) {
		$this->bankName = $bankName;
	}

	/**
	 * @return string
	 */
	public function getBankAddress() {
		return $this->bankAddress;
	}

	/**
	 * @param string $bankAddress
	 */
	public function setBankAddress($bankAddress) {
		$this->bankAddress = $bankAddress;
	}

	/**
	 * @return string
	 */
	public function getSortCode() {
		return $this->sortCode;
	}

	/**
	 * @param string $sortCode
	 */
	public function setSortCode($sortCode) {
		$this->sortCode = $sortCode;
	}

	/**
	 * @return string
	 */
	public function getAccountNo() {
		return $this->accountNo;
	}

	/**
	 * @param string $accountNo
	 */
	public function setAccountNo($accountNo) {
		$this->accountNo = $accountNo;
	}

	/**
	 * @return string
	 */
	public function getAccountName() {
		return $this->accountName;
	}

	/**
	 * @param string $accountName
	 */
	public function setAccountName($accountName) {
		$this->accountName = $accountName;
	}

	/**
	 * @return string
	 */
	public function getSwiftCode() {
		return $this->swiftCode;
	}

	/**
	 * @param string $swiftCode
	 */
	public function setSwiftCode($swiftCode) {
		$this->swiftCode = $swiftCode;
	}

	/**
	 * @return string
	 */
	public function getIban() {
		return $this->iban;
	}

	/**
	 * @param string $iban
	 */
	public function setIban($iban) {
		$this->iban = $iban;
	}

	/**
	 * @return \TYPO3\Flow\Security\Account
	 */
	public function getUserAccount() {
		return $this->userAccount;
	}

	/**
	 * @param \TYPO3\Flow\Security\Account $userAccount
	 */
	public function setUserAccount($userAccount) {
		$this->userAccount = $userAccount;
	}


}
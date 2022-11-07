<?php

namespace Hello\InterWorld\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface EmployeeInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    // public function setId($id);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     * @return void
     */
    public function setName($name);

    /**
     * @return \VinaiKopp\Kitchen\Api\Data\IngredientInterface[]
     */
    public function getEmail();

    /**
     * @param \VinaiKopp\Kitchen\Api\Data\IngredientInterface[] $ingredients
     * @return void
     */
    public function setEmail(array $email);

    /**
     * @return string[]
     */
    public function getTelephone();

    /**
     * @param string[] $urls
     * @return void
     */
    public function setTelephone(array $telephone);

    /**
     * @return \VinaiKopp\Kitchen\Api\Data\EmployeeExtensionInterface|null
     */
    // public function getExtensionAttributes();

    /**
     * @param \VinaiKopp\Kitchen\Api\Data\EmployeeExtensionInterface $extensionAttributes
     * @return void
     */
    // public function setExtensionAttributes(HamburgerExtensionInterface $extensionAttributes);
}
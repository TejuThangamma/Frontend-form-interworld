<?php
namespace Hello\InterWorld\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Hello\InterWorld\Api\Data\EmployeeInterface;
use Hello\InterWorld\Model\ResourceModel\View as ResourceModel;


class Employee extends AbstractModel implements
    EmployeeInterface,
    IdentityInterface
{
    const CACHE_TAG = 'emptable';

    /**
     * Init
     */
    protected function _construct() // phpcs:ignore PSR2.Methods.MethodDeclaration
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getid_column()
    {
        return $this->getData('id_column');
    }
    // public function setId($car_id)
    // {
    //     return $this->setData('cars_id', $car_id);
    // }
    public function getName()
    {
        return $this->getData('Name');
    }
    public function setName($name)
    {
        return $this->setData('Name', $name);
    }


    public function getEmail()
    {
        return $this->getData('Email');
    }
    public function setEmail($email)
    {
        return $this->setData('Email', $email);
    }


    public function getTelephone()
    {
        return $this->getData('Telephone');
    }
    public function setTelephone($telephone)
    {
        return $this->setData('Telephone', $telephone);
    }
}
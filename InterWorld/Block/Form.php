<?php

namespace Hello\InterWorld\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Hello\InterWorld\Model\ResourceModel\View\CollectionFactory as EmployeeCollectionFactory;
use Hello\InterWorld\Model\EmployeeFactory;
use Hello\InterWorld\Api\EmployeeRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;

class Form extends \Magento\Framework\View\Element\Template
{
    protected $searchCriteriaBuilder;
    protected $filterBuilder;
    protected $_EmployeeCollectionFactory = null;
    protected $EmployeeFactory;
    protected $_EmployeeRepository;


    public function __construct(
        Context $context,
        EmployeeCollectionFactory $EmployeeCollectionFactory,
        EmployeeRepositoryInterface $EmployeeRepository,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        EmployeeFactory $EmployeeFactory,
        array $data = []
    ) {
        $this->EmployeeFactory = $EmployeeFactory;
        $this->_EmployeeRepository=$EmployeeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_EmployeeCollectionFactory  = $EmployeeCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getAddCarPostUrl() {

        return $this->getUrl('interworld/index/add');
    }
    public function getDeleteurl() {

        return $this->getUrl('interworld/index/delete');
    }

    public function getCollection()
    {
        $EmployeeCollection = $this->_EmployeeCollectionFactory ->create();
        $EmployeeCollection->addFieldToSelect('*')->load();
        return $EmployeeCollection->getItems();
    }
     public function getalldata()
     {
        
        // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $searchCriteriaBuilder= $this->searchCriteriaBuilder->create();
        // $searchCriteria=$searchCriteriaBuilder->addFilter('id_column' ,'%%','like')->create();
        $list=$this->_EmployeeRepository->getList($searchCriteriaBuilder);
        return $list->getItems();
     }

   
}
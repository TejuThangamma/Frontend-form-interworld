<?php
namespace Hello\InterWorld\Api;

use \Hello\InterWorld\Api\Data\EmployeeInterface;
use \Magento\Framework\Api\SearchCriteriaInterface;

interface EmployeeRepositoryInterface
{
    
    public function save(EmployeeInterface $model);

    
    public function delete(EmployeeInterface $model);

    
    public function deleteById($id_column);

   
    public function getById($id_column);

   
    public function getList(SearchCriteriaInterface $criteria);
}
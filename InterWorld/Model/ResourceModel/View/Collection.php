<?php
namespace Hello\InterWorld\Model\ResourceModel\View;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Hello\InterWorld\Model\View as Model;
use Hello\InterWorld\Model\ResourceModel\View as ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
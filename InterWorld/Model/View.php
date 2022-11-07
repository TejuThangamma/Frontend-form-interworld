<?php

namespace Hello\InterWorld\Model;

use Magento\Framework\Model\AbstractModel;
use Hello\InterWorld\Model\ResourceModel\View as ResourceModel;

class View extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
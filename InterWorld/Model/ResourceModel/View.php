<?php

namespace Hello\InterWorld\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class View extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('emptable', 'id_column');
    }
}
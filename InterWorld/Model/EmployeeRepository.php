<?php
    namespace Hello\InterWorld\Model;

    use \Hello\InterWorld\Api\Data\EmployeeInterface;
    use \Hello\InterWorld\Model\ResourceModel\View as ObjectResourceModel;
    use \Magento\Framework\Api\SearchCriteriaInterface;
    use \Magento\Framework\Exception\CouldNotSaveException;
    use \Magento\Framework\Exception\NoSuchEntityException;
    use \Magento\Framework\Exception\CouldNotDeleteException;

    class EmployeeRepository implements \Hello\InterWorld\Api\EmployeeRepositoryInterface
    {
        protected $objectFactory;

        protected $objectResourceModel;

        protected $collectionFactory;

        protected $searchResultsFactory;

        public function __construct(
            \Hello\InterWorld\Model\EmployeeFactory $objectFactory,
            ObjectResourceModel $objectResourceModel,
            \Hello\InterWorld\Model\ResourceModel\View\CollectionFactory $collectionFactory,
            \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultsFactory
        ) {
            $this->objectFactory        = $objectFactory;
            $this->objectResourceModel  = $objectResourceModel;
            $this->collectionFactory    = $collectionFactory;
            $this->searchResultsFactory = $searchResultsFactory;
        }

        public function save(EmployeeInterface $object)
        {
            $name = $object->getName();
           
            // if ($name == true) {
            //     $name = "Mrs. " . $name;
            // } else {
            //     $name = "Miss. " . $name;
            // }
            $object->setName($name);
            try {
                $this->objectResourceModel->save($object);
            } catch (\Exception $e) {
                throw new CouldNotSaveException(__($e->getMessage()));
            }
            return $object;
        }

        /**
         * @inheritdoc
         */
        public function getById($id_column)
        {
            $object = $this->objectFactory->create();
            $this->objectResourceModel->load($object, $id_column);
            if (!$object->getId()) {
                throw new NoSuchEntityException(__('Object with id "%1" does not exist.',$id_column));
            }
            return $object;
        }

        public function delete(EmployeeInterface $object)
        {
            try {
                $this->objectResourceModel->delete($object);
            } catch (\Exception $exception) {
                throw new CouldNotDeleteException(__($exception->getMessage()));
            }
            return true;
        }

        public function deleteById($id_column)
        {
            return $this->delete($this->getById($id_column));
        }

        /**
         * @inheritdoc
         */
        public function getList(SearchCriteriaInterface $criteria)
        {
            $searchResults = $this->searchResultsFactory->create();
            $searchResults->setSearchCriteria($criteria);
            $collection = $this->collectionFactory->create();
            foreach ($criteria->getFilterGroups() as $filterGroup) {
                $fields = [];
                $conditions = [];
                foreach ($filterGroup->getFilters() as $filter) {
                    $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                    $fields[] = $filter->getField();
                    $conditions[] = [$condition => $filter->getValue()];
                }
                if ($fields) {
                    $collection->addFieldToFilter($fields, $conditions);
                }
            }
            $searchResults->setTotalCount($collection->getSize());
            $sortOrders = $criteria->getSortOrders();
            if ($sortOrders) {
                /** @var SortOrder $sortOrder */
                foreach ($sortOrders as $sortOrder) {
                    $collection->addOrder(
                        $sortOrder->getField(),
                        ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                    );
                }
            }
            $collection->setCurPage($criteria->getCurrentPage());
            $collection->setPageSize($criteria->getPageSize());
            $objects = [];
            foreach ($collection as $objectModel) {
                $objects[] = $objectModel;
            }
            $searchResults->setItems($objects);
            return $searchResults;
        }
    }
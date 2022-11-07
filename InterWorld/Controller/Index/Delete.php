<?php
namespace Hello\InterWorld\Controller\Index;

    use Magento\Framework\App\Action\Action;
    use Magento\Framework\App\Action\Context;
    use Magento\Framework\Exception\CouldNotSaveException;
    use Magento\Framework\Exception\LocalizedException;
    use Magento\Framework\Exception\NoSuchEntityException;
    use Magento\Framework\View\Result\PageFactory;

    use Hello\InterWorld\Api\EmployeeRepositoryInterface;
    use Hello\InterWorld\Api\Data\EmployeeInterface;

    class Delete extends Action
    {
        protected $_pageFactory;

        protected $_EmployeeRepository;
        protected $_EmployeeModel;


        public function __construct(
            Context $context,
            PageFactory $pageFactory,
            EmployeeRepositoryInterface $EmployeeRepository,
            EmployeeInterface $EmployeeInterface
        ) {
            $this->_pageFactory = $pageFactory;
            $this->_EmployeeRepository=$EmployeeRepository;
            $this->_EmployeeModel = $EmployeeInterface;
            return parent::__construct($context);
        }

        public function execute()
        {
            $id=$_GET;
            try {
                $this->_EmployeeRepository->deleteById($id);
               
            } catch (NoSuchEntityException $e) {
                echo "No such entity exception - " . $e->getMessage();
            } catch (LocalizedException $e) {
                echo "Localized Exception" . $e->getMessage();
            }
           

            $redirect = $this->resultRedirectFactory->create();
           $redirect->setPath('interworld');
            return $redirect;
        }

    }
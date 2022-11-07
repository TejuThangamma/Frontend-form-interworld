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

    class Add extends Action
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
            
            $data=$this->getRequest()->getParams();
            $name=$data["Name"];
            $email=$data["Email"];
            $telephone=$data["Telephone"];

        $EmployeeModel =$this->_EmployeeModel;
        $this->_EmployeeModel->setName($name);
        $this->_EmployeeModel->setEmail($email);
        $this->_EmployeeModel->setTelephone($telephone);
        
        
            
            
            $this->_EmployeeRepository->save($EmployeeModel);
            $this->messageManager->addSuccessMessage("Car saved successfully!");
        

        
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('interworld');
        return $redirect;
    
            
    }
}
<?php

namespace News\Letter\Controller\Result;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class Result extends \Magento\Framework\App\Action\Action

{

    
    protected $resultPageFactory;

    protected $resultJsonFactory; 
  
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
        )
    {

        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory; 
        return parent::__construct($context);
    }


    public function execute()
    {
        $numone = $this->getRequest()->getParam('numone');
      
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();

        $block = $resultPage->getLayout()
                ->createBlock('News\Letter\Block\Index')
                ->setTemplate('News_Letter::result.phtml')
                ->setData('numone',$numone)
                ->toHtml();
    
        $result->setData(['output' => $block]);
        return $result;

    } 

}
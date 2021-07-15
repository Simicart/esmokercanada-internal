<?php
/**
* Magedelight
* Copyright (C) 2017 Magedelight <info@magedelight.com>
*
* @category Magedelight
* @package Magedelight_Monerisca
* @copyright Copyright (c) 2017 Mage Delight (http://www.magedelight.com/)
* @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
* @author Magedelight <info@magedelight.com>
*/

namespace Magedelight\Monerisca\Controller\Adminhtml\Cards;

use \Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

abstract class Monerisca extends Action
{
    /**
     * Response.
     * @var \Magento\Framework\App\ResponseInterface
     */
    public $response;

    /**
     * @var \Magento\Framework\Registry
     */
    public $registry;

    /**
     * @var \Magento\Framework\DataObjec
     */
    public $requestObject;

    /**
     *
     * @var \Magedelight\Monerisca\Model\CardsFactory
     */
    public $cardsFactory;

    /**
     * Date model
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    public $localeDate;

    /**
     * @var Magento\Customer\Api\CustomerRepositoryInterface
     */
    public $customerRepository;

    /**
     * @var Magento\Framework\Controller\Result\JsonFactory
     */
    public $resultJsonFactory;

     /**
      * @var Magedelight\Monerisca\Model\Api\Monerisca
      */
    public $monerisApi;

    /**
     * @var Magento\Framework\Encryption\EncryptorInterface
     */
    public $encryptor;

    public function __construct(
        Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\DataObject $requestObject,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,
        \Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magedelight\Monerisca\Model\Api\Monerisca $monerisApi,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magedelight\Monerisca\Model\CardsFactory $cardsFactory,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor
    ) {
        parent::__construct($context);
        $this->registry             = $registry;
        $this->requestObject        = $requestObject;
        $this->localeDate           = $localeDate;
        $this->_directoryHelper     = $directoryHelper;
        $this->monerisHelper        = $monerisHelper;
        $this->resultLayoutFactory  = $resultLayoutFactory;
        $this->_jsonEncoder         = $jsonEncoder;
        $this->customerRepository   = $customerRepository;
        $this->resultJsonFactory   = $resultJsonFactory;
        $this->monerisApi          = $monerisApi;
        $this->encryptor          = $encryptor;
        $this->cardsFactory = $cardsFactory;
    }

    public function _isAllowed()
    {
        return true;
    }
}

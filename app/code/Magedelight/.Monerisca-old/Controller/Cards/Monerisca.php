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

namespace Magedelight\Monerisca\Controller\Cards;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;

abstract class Monerisca extends Action
{
    /**
     * Response.
     *
     * @var \Magento\Framework\App\ResponseInterface
     */
    public $response;

    /**
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    public $registry;

    /**
     * Customer session
     *
     * @var \Magento\Customer\Model\Session
     */
    public $customerSession;

    /**
     *
     * @var \Magento\Framework\DataObjec
     */
    public $requestObject;

    /**
     * Date model
     *
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    public $localeDate;

    /**
     * @var Magedelight\Monerisca\Model\Api\Monerisca
     */
    public $monerisApi;

    /**
     * @var Magedelight\Monerisca\Model\CardsFactory
     */
    public $cardsFactory;

    /**
     * @var Magedelight\Monerisca\Helper\Data
     */
    public $monerisHelper;

    /**
     * @var Magento\Framework\Encryption\EncryptorInterface
     */
    public $encryptor;

    public function __construct(
        Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\Session\Proxy $customerSession,
        \Magento\Framework\DataObject $requestObject,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate,
        \Magento\Directory\Helper\Data $directoryHelper,
        \Magedelight\Monerisca\Model\Api\Monerisca $monerisApi,
        \Magedelight\Monerisca\Model\CardsFactory $cardsFactory,
        \Magedelight\Monerisca\Helper\Data $monerisHelper,
        \Magento\Framework\Encryption\EncryptorInterface $encryptor
    ) {
        $this->registry         = $registry;
        $this->customerSession = $customerSession;
        $this->requestObject   = $requestObject;
        $this->localeDate      = $localeDate;
        $this->_directoryHelper = $directoryHelper;
        $this->monerisApi = $monerisApi;
        $this->cardsFactory = $cardsFactory;
        $this->monerisHelper = $monerisHelper;
        $this->encryptor = $encryptor;
        return parent::__construct($context);
    }

    public function getCustomer()
    {
        return $this->_getSession()->getCustomer();
    }

    /**
     * return customer session
     * @return type
     */
    public function _getSession()
    {
        return $this->customerSession;
    }

    /**
     * check customer is logged in
     * @param RequestInterface $request
     * @return type
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->_getSession()->authenticate()) {
            $this->_actionFlag->set('', 'no-dispatch', true);
        }
        return parent::dispatch($request);
    }
}

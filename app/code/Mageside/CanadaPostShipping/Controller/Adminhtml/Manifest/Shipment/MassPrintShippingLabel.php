<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Manifest\Shipment;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Sales\Model\Order\Pdf\Shipment;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\App\Action\Context;
use Magento\Shipping\Model\Shipping\LabelGenerator;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Sales\Model\ResourceModel\Order\Shipment\CollectionFactory as ShipmentCollectionFactory;
use Mageside\CanadaPostShipping\Model\ResourceModel\Shipment\CollectionFactory;

class MassPrintShippingLabel extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Magento_Sales::shipment';

    /**
     * @var string
     */
    protected $redirectUrl = '*/*/';

    /**
     * @var LabelGenerator
     */
    protected $labelGenerator;

    /**
     * @var FileFactory
     */
    protected $fileFactory;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var ShipmentCollectionFactory
     */
    protected $shipmentCollectionFactory;

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;

    /**
     * @var DateTime
     */
    protected $dateTime;

    /**
     * @var Shipment
     */
    protected $pdfShipment;

    /**
     * MassPrintShippingLabel constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param FileFactory $fileFactory
     * @param LabelGenerator $labelGenerator
     * @param ShipmentCollectionFactory $shipmentCollectionFactory
     * @param Shipment $shipment
     * @param DateTime $dateTime
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        FileFactory $fileFactory,
        LabelGenerator $labelGenerator,
        ShipmentCollectionFactory $shipmentCollectionFactory,
        Shipment $shipment,
        DateTime $dateTime
    ) {
        $this->filter = $filter;
        $this->fileFactory = $fileFactory;
        $this->collectionFactory = $collectionFactory;
        $this->shipmentCollectionFactory = $shipmentCollectionFactory;
        $this->labelGenerator = $labelGenerator;
        $this->dateTime = $dateTime;
        $this->pdfShipment = $shipment;
        parent::__construct($context);
    }

    /**
     * Execute action
     *
     * @return ResponseInterface|\Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());
            return $this->massAction($collection);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            return $resultRedirect->setPath($this->redirectUrl);
        }
    }

    /**
     * Batch print shipping labels for whole shipments.
     * Push pdf document with shipping labels to user browser
     *
     * @param AbstractCollection $collection
     * @return ResponseInterface|\Magento\Framework\Controller\Result\Redirect
     * @throws \Zend_Pdf_Exception
     */
    protected function massAction(AbstractCollection $collection)
    {
        $labelsContent = [];
        $shipments = $this->getShipments($collection);

        if ($shipments->getSize()) {
            /** @var \Magento\Sales\Model\Order\Shipment $shipment */
            foreach ($shipments as $shipment) {
                $labelContent = $shipment->getShippingLabel();
                if ($labelContent) {
                    $labelsContent[] = $labelContent;
                }
            }
        }

        if (!empty($labelsContent)) {
            $outputPdf = $this->labelGenerator->combineLabelsPdf($labelsContent);
            return $this->fileFactory->create(
                'ShippingLabels.pdf',
                $outputPdf->render(),
                DirectoryList::VAR_DIR,
                'application/pdf'
            );
        }

        $this->messageManager->addErrorMessage(__('There are no shipping labels related to selected orders.'));

        return $this->resultRedirectFactory->create()->setPath('canadapost/manifest/');
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Sales\Model\ResourceModel\Order\Shipment\Collection
     */
    protected function getShipments(AbstractCollection $collection)
    {
        $shipments = $this->shipmentCollectionFactory->create();

        $condition = [
            'manifest_shipments.sales_shipment_id = main_table.' . $shipments->getIdFieldName(),
            $shipments->getConnection()->prepareSqlCondition(
                $collection->getIdFieldName(),
                ['in' => $collection->getAllIds()]
            )
        ];

        $shipments->getSelect()
            ->joinInner(
                ['manifest_shipments' => $shipments->getResource()->getTable('mageside_canadapost_shipment')],
                implode(' AND ', $condition),
                []
            );

        return $shipments;
    }
}

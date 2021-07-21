<?php
/**
 * Copyright © Mageside. All rights reserved.
 * See MS-LICENSE.txt for license details.
 */
namespace Mageside\CanadaPostShipping\Controller\Adminhtml\Manifest\Shipment;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Pdfshipments extends MassPrintShippingLabel
{
    /**
     * @param AbstractCollection $collection
     * @return ResponseInterface
     * @throws \Exception
     */
    protected function massAction(AbstractCollection $collection)
    {
        $shipments = $this->getShipments($collection);
        $pdf = $this->pdfShipment->getPdf($shipments);
        $fileContent = ['type' => 'string', 'value' => $pdf->render(), 'rm' => true];

        return $this->fileFactory->create(
            sprintf('packingslip%s.pdf', $this->dateTime->date('Y-m-d_H-i-s')),
            $fileContent,
            DirectoryList::VAR_DIR,
            'application/pdf'
        );
    }
}

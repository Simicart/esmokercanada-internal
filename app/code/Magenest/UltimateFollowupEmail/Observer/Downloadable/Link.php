<?php
/**
 * Created by Magenest
 * User: Eric Quach
 * Date: 08/12/2016
 * Time: 16:37
 */
namespace Magenest\UltimateFollowupEmail\Observer\Downloadable;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class Link implements ObserverInterface
{

    protected $linkFactory;

    public function __construct(
        \Magenest\UltimateFollowupEmail\Model\LinkFactory $linkFactory
    ) {
        $this->linkFactory = $linkFactory;
    }
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $objectManager =  \Magento\Framework\App\ObjectManager::getInstance();

        /** @var  \Magento\Framework\Logger\Monolog $logger */
        $logger =  $objectManager->create('Magento\Framework\Logger\Monolog');
        $downloadableLink = $observer->getEvent()->getDataObject();

        /// $downloadableLink
        if ($downloadableLink instanceof \Magento\Downloadable\Model\Link) {
            $theId = $downloadableLink->getId();
            $obj =  \Magento\Framework\App\ObjectManager::getInstance();
            // $logger =  $objectManager->create('Magento\FrameWork\Model\Adapter');
            $data = $downloadableLink->getData();

            $logger->info('link ===========> ', $data);

            if ($theId == null) {
                if (isset($data['link_file'])) {
                    $linkBean = $this->linkFactory->create();
                    $productId  = $data['product_id'];
                    $link_file = $data['link_file'];
                    $linkBean->setData([
                        'link_file'  =>   $link_file,
                        'product_id' =>   $productId,
                         'state'     =>   'pending'
                    ]);
                    $linkBean->save();
                }
            }
        }
    }
    /**
     * generate follow up email
     */
    protected function generateFollowUpEmail($productId, $link_file)
    {
    }
}

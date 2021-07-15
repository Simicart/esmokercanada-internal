<?php
/**
 * Created by Magenest
 * User: Luu Thanh Thuy
 * Date: 16/02/2017
 * Time: 21:51
 */
namespace Magenest\UltimateFollowupEmail\Controller\Uninstall;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class Index extends \Magento\Framework\App\Action\Action
{
    const RULE = "magenest_ultimatefollowupemail_rule";

    const ABANDONED_CART ="magenest_ultimatefollowupemail_guest_abandoned_cart";

    const HISTORY ="magenest_ultimatefollowupemail_history";

    const LOG ="magenest_ultimatefollowupemail_mail_log";

    const NOTI ="magenest_ultimatefollowupemail_mail_notification";

    const SMS = "magenest_ultimatefollowupemail_mail_sms";

    const SMS_LOG = "magenest_ultimatefollowupemail_sms_log";

    /** @var \Magento\Framework\DB\Adapter\Pdo\Mysql  */
    protected $mysql;

    protected $setup;

    public function __construct(
        \Magento\Framework\App\Action\Context $context
    ) {
    
        parent::__construct($context);
       // $this->setup = $setupInterface;
    }
    /**
     * Dispatch REQUEST
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
       // $this->mysql->startSetup();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        //$this->setup->startSetup();
       // $connection = $this->setup->getConnection();

        $this->mysql = $connection;



        if ($connection->isTableExists(self::ABANDONED_CART)) {
            $connection->dropTable(self::ABANDONED_CART);
        }
        if ($this->mysql->isTableExists(self::HISTORY)) {
            $this->mysql->dropTable(self::HISTORY);
        }
        if ($this->mysql->isTableExists(self::LOG)) {
            $this->mysql->dropTable(self::LOG);
        }
        if ($this->mysql->isTableExists(self::NOTI)) {
            $this->mysql->dropTable(self::NOTI);
        }

        if ($this->mysql->isTableExists(self::SMS)) {
            $this->mysql->dropTable(self::SMS);
        }

        if ($this->mysql->isTableExists(self::SMS_LOG)) {
            $this->mysql->dropTable(self::SMS_LOG);
        }
        if ($connection->isTableExists(self::RULE)) {
            $connection->dropTable(self::RULE);
        }
        $query ="DELETE FROM `setup_module` WHERE `module`='Magenest_UltimateFollowupEmail'";
        $this->mysql->query($query);
    }
}

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

namespace Magedelight\Monerisca\Model\Api\Moneris;

class MpgGlobals
{
    public $Globals=[
                    'MONERIS_PROTOCOL' => 'https',
                    'MONERIS_HOST' => 'www3.moneris.com',
                    'MONERIS_TEST_HOST' => 'esqa.moneris.com',
                    'MONERIS_US_HOST' => 'esplus.moneris.com',
                    'MONERIS_US_TEST_HOST' => 'esplusqa.moneris.com',
                    'MONERIS_PORT' =>'443',
                    'MONERIS_FILE' => '/gateway2/servlet/MpgRequest',
                    'MONERIS_US_FILE' => '/gateway_us/servlet/MpgRequest',
                    'MONERIS_MPI_FILE' => '/mpi/servlet/MpiServlet',
                    'MONERIS_US_MPI_FILE' => '/mpi/servlet/MpiServlet',
                    'API_VERSION'  =>'PHP NA - 1.0.5',
                    'CLIENT_TIMEOUT' => '30'
                    ];
    public function getGlobals()
    {
        return($this->Globals);
    }
}

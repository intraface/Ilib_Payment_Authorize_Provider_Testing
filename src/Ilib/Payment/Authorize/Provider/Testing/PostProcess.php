<?php
/**
 * Postprocess Testing online payments 
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.1.0
 * @package Ilib_Payment_Authorize_Provider_Testing
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Postprocess Testing online payments with html template
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.1.0
 * @package Ilib_Payment_Authorize_Provider_Testing
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Testing_Postprocess extends Ilib_Payment_Authorize_PostProcess
{
    /**
     * Contructor
     * 
     * @param string $merchant merchant number
     * @param string $language the language used in the payment
     * 
     * @return void
     */
    public function __construct($merchant, $verification_key, $get, $post, $session, $payment_target)
    {    
        parent::__construct($merchant, $verification_key, $get, $post, $session, $payment_target);
        
        $this->amount = $get['amount'];
        $this->order_number = $get['order_number'];
        $this->currency = $get['currency'];
        
        if($get['status'] != '000') {
            $this->transaction_status = $get['status'];
            $this->transaction_number = 0;
            $this->pbs_status = $get['pbs_status'];
        }
        else {
            $this->pbs_status = '000'; 
            $this->transaction_status = '000';
            $this->transaction_number = $get['transaction_number'];
        }
        
    } 
}
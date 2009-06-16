<?php
/**
 * Prepares Testing online payments
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Ilib_Payment_Authorize_Provider_Testing
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */

/**
 * Prepares Testing online payments 
 * 
 * @author sune jensen <sj@sunet.dk>
 * @version 0.0.1
 * @package Ilib_Payment_Authorize_Provider_Testing
 * @category Payment
 * @license http://www.gnu.org/licenses/lgpl.html LGPL
 */
class Ilib_Payment_Authorize_Provider_Testing_Prepare extends Ilib_Payment_Authorize_Prepare
{
    
    
    /**
     * Contructor
     * 
     * @param string $merchant
     * @param string $verification_key
     * @param string $order_identifier
     * @param integer $order_number
     * @param float $amount
     * @param string $currency
     * @param string $language
     * @param string $okpage
     * @param string $errorpage
     * @param string $resultpage
     * @param string $inputpage
     * @param array $get_vars
     * @param array $post_vars
     * @return void
     */
    public function __construct($merchant, $verification_key, $order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars)
    {
        parent::__construct($merchant, $verification_key, $order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars);
    }
    
    /**
     * prepares the payment values into the fields
     *  
     * @return string post fields
     */
    public function getHiddenFields() 
    {
        return '<input type="hidden" name="order_identifier" value="'.$this->order_identifier.'" />' .
           '<input type="hidden" name="order_id" value="'.$this->order_number.'" />'.
           '<input type="hidden" name="amount" value="'.$this->amount.'" />'.
           '<input type="hidden" name="currency" value="'.$this->currency.'" />';
    }
    
    /**
     * Returns the form action
     * 
     * @return string form action
     */
    public function getAction()
    {
        return 'postform';
    }
    
    /**
     * Returns the name of the provider. Needs to be overridden in extends.
     * 
     * @return string name of provider
     */
    public function getProviderName()
    {
        return 'Testing';
    }
    
    
    /**
     * Returns error message
     * @return string error message
     */
    public function getErrorMessage()
    {
        if(isset($this->get_vars['errormessage'])) {
            return $this->get_vars['errorcode'];
        }
        
        return '';
    }
}
<?php
/**
 * Post form form class
 * @author sune
 *
 */

/**
 * Post form form class
 * @author sune
 *
 */
class Ilib_Payment_Authorize_Provider_Testing_Form extends Ilib_Payment_Authorize_Form
{
    
    /**
     * Constructor
     * 
     * @param string $merchant
     * @param string $verification_key
     * @param integer $order_number
     * @param float $amount
     * @param string $currency
     * @param string $language
     * @param string $okpage
     * @param string $errorpage
     * @param string $resultpage
     * @param array GET vars
     * @param array POST vars
     * @return void
     */
    public function __construct($merchant, $verification_key, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $get_vars, $post_vars)
    {
        parent::__construct($merchant, $verification_key, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $get_vars, $post_vars);
    }
    
    
    
    /**
     * Returns the hidden fields for the form to post to the authorize page.
     * 
     * @return array with hidden post fields.
     */
    public function getHiddenFields()
    {
        
        /**
         * @todo Here we create the error url from base url (errorpage)
         */
        $error_url = $this->errorpage.'/input?error=1';
        
        return '<input type="hidden" name="currency" value="'.$this->currency.'" />' .
                '<input type="hidden" name="merchant" value="'.$this->merchant.'" />' .
                '<input type="hidden" name="order_number" value="'.$this->order_number.'" />' .
                '<input type="hidden" name="amount" value="'.$this->amount.'" />' .
                '<input type="hidden" name="session_id" value="'.session_id().'" />' .
                '<input type="hidden" name="okpage" value="'.$this->okpage.'" />' .
                '<input type="hidden" name="errorpage" value="'.$error_url.'" />' .
                '<input type="hidden" name="resultpage" value="'.$this->resultpage.'" />';
    }
    
    /**
     * Returns the form action
     * 
     * @return string form action
     */
    public function getAction()
    {
        return 'paymentprocess';
    }
    
    /**
     * Return the name of the card number field name
     * 
     * @return string
     */
    public function getCardNumberFieldName()
    {
        return 'card_number';
    }
    
    /**
     * Returns the name of the security number field name
     * 
     * @return unknown_type
     */
    public function getSecurityNumberFieldName()
    {
        return 'security_number';
    }
    
    /**
     * Returns the name of the expire month field name 
     * @return string 
     */
    public function getExpireMonthFieldName() 
    {
        return 'expire_month';
    }
    
    /**
     * Returns the name of the expire year field name
     * @return string
     */
    public function getExpireYearFieldName()
    {
        return 'expire_year';
    }
    
    /**
     * return the currency
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }
    
    /**
     * Returns the amount 
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * Returns errore message if is set
     * @return string
     */
    public function getErrorMessage()
    {
        if(isset($this->get_vars['errorcode'])) {
            $errorcodes = Ilib_Payment_Authorize_Provider_Dandomain_ErrorMessage::getErrorCodes();
            return $errorcodes[$this->get_vars['errorcode']];
        }
        
        return '';
    }
    
    /**
     * Returns the secure tunnel
     * 
     * @return string secture tunnel
     */
    public function getSecureTunnel()
    {
        return '';
    }
}
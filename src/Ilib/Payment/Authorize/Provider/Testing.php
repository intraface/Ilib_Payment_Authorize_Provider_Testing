<?php


class Ilib_Payment_Authorize_Provider_Testing extends Ilib_Payment_Authorize_Provider
{
    
    private $payment_process;
    
    /**
     * Constructor 
     * 
     * @param $merchant merchant
     * @param $verification_key verification key
     * @param $secure_url url to secured payment form
     * @return void 
     */
    public function __construct($merchant, $verification_key)
    {
        parent::__construct($merchant, $verification_key);
    }
    
    /**
     * Returns redirect url to payment page.
     * 
     * @param $identifier payment identifier
     * @param $receipt_url the url to the receipt page
     * @return string url
     */
    public function getRedirectUrlToPayment($order_identifier, $receipt_url)
    {
        return 'onlinepayment/'.$order_identifier.'/postform';
    }
    
    /**
     * Post form object
     * 
     * @param integer $order_number order number
     * @param float $amount amount
     * @param string $currency currency
     * @param string $language 2 letter languagage
     * @param string $okpage url to ok page
     * @param string $errorpage url to error page
     * @param string $resultpage url to result page
     * @param array $get_vars GET vars
     * @param array $post_vars POST vars
     * @return object post form
     */
    public function getForm($order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $get_vars, $post_vars)
    {
        if(!isset($this->form)) {
            $this->form = new Ilib_Payment_Authorize_Provider_Testing_Form($this->getMerchant(), $this->getVerificationKey(), $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $get_vars, $post_vars);
        }
        
        return $this->form;
    }

    /**
     * Prepare object
     * 
     * @param string $order_identifier order identifier
     * @param integer $order_number order number
     * @param float $amount amount
     * @param string $currency currency
     * @param string $language 2 letter languagage
     * @param string $okpage url to ok page
     * @param string $errorpage url to error page
     * @param string $resultpage url to result page
     * @param string $inputpage url to input page
     * @param array $get_var GET vars
     * @param array $post_vars POST vars
     * @return object prepare
     */
    public function getPrepare($order_identifier, $order_number, $amount, $currency, $language, $okpage, $errorpage, $resultpage, $inputpage, $get_vars, $post_vars)
    {
        if(!isset($this->prepare)) {
            $this->prepare = new Ilib_Payment_Authorize_Provider_Testing_Prepare(
                $this->getMerchant(), 
                $this->getVerificationKey(), 
                $order_identifier,
                $order_number, 
                $amount, 
                $currency, 
                $language, 
                $okpage, 
                $errorpage, 
                $resultpage,
                $inputpage, 
                $get_vars,
                $post_vars
            );
        }
        
        return $this->prepare;
    }
    
    /**
     * Returns post process object 
     * 
     * @param array $get
     * @param array $post
     * @param array $session
     * @param array $payment_target
     * @return object
     */
    public function getPostProcess($get, $post, $session, $payment_target)
    {
        if(!isset($this->post_process)) {
            $this->post_process = new Ilib_Payment_Authorize_Provider_Testing_PostProcess(
                $this->getMerchant(), 
                $this->getVerificationKey(),
                $get, 
                $post, 
                $session, 
                $payment_target
            );
        }
        
        return $this->post_process;
    }
    
/**
     * Returns payment process object 
     * 
     * @return object
     */
    public function getPaymentProcess()
    {
        if(!isset($this->payment_process)) {
            $this->payment_process = new Ilib_Payment_Authorize_Provider_Testing_PaymentProcess($this->getMerchant(), $this->getVerificationKey());
        }
        
        return $this->payment_process;
    }
}

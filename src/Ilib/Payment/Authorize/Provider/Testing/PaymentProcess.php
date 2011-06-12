<?php
class Ilib_Payment_Authorize_Provider_Testing_PaymentProcess extends Ilib_Payment_Authorize
{
    private $md5_secret;
    public $http_response_body = '[not set]';

    public function __construct($merchant, $verification_key)
    {
        parent::__construct($merchant, $verification_key);
    }

    /**
     * Process post data.
     *
     * @return string redirect location.
     */
    public function process($input, &$session)
    {
        $time = date('ymdHis');

        require_once 'HTTP/Request.php';
        $client = new HTTP_Request($input['resultpage']);
        $client->setMethod(HTTP_REQUEST_METHOD_POST);
        $client->AddPostData('amount', $input['amount']);
        $client->AddPostData('time', $time);
        $client->AddPostData('order_number', $input['order_number']);
        $client->AddPostData('merchant', $input['merchant']);
        $client->AddPostData('currency', $input['currency']);

        if (empty($input['card_number']) || empty($input['security_number'])) {
            $client->AddPostData('pbs_status', '118');
            $client->AddPostData('status', '001');
            $client->AddPostData('status_message', 'Rejected');
            $return = $input['errorpage'];

        } else {
            $client->AddPostData('pbs_status', '000');
            $client->AddPostData('status', '000');
            $client->AddPostData('status_message', 'Approved');
            $client->AddPostData('transaction_number', '123');
            $return = $input['okpage'];
        }
        $request = $client->sendRequest();

        if (PEAR::isError($request)) {
            throw new Exception('Error in post reguest: '.$request->getUserInfo());
        }

        $this->http_response_body = $client->getResponseBody();

        if ($client->getResponseCode() != 200) { // 200 is SUCCESS
            throw new Exception('Error in processing the order. We got ' . $client->getResponseCode() . ' and this message: '. $this->http_response_body);
        }

        return $return;
    }
}

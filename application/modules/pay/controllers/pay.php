<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay extends MX_Controller {

    protected $PAYMENT_URL = 'http://payment.vigattin.net/api/buy';
    
    public function index($param)
    {
        $clientid       = $param['clientid'];                                // ID of the client. If login with facebook; this is the fb userid 
        $amount         = $param['amount'];                                // Total amount, must be integer
        $name           = $param['name'];                        // Name of the product e.g. Honda Civic
        $description    = $param['description'];        // Description of the item e.g red brand new car
        $firstname      = $param['firstname'];                        
        $lastname       = $param['lastname'];
        $address        = $param['address'];
        $city           = $param['city'];
        $state          = $param['state'];
        $country        = $param['country'];
        $zipcode        = $param['zipcode'];
        $telno          = $param['telno'];
        $email          = $param['email'];
        $page_id        = 'vigattin.org';
        $page_txn       = $param['order_txn'];
        
        $this->redirect($clientid, $amount, $name, $description, $firstname, $lastname, $address, $city, $state, $country, $zipcode, $telno, $email, $page_id, $page_txn);
    }
    public function update()
    {
        $payment_details = $this->get_txn(); // ($payment_details) this is the data return from payeasy
        $status = $payment_details['status'];
        if($status == 1 || $status == 2)
        {
            $name = $payment_details['name'];
            $amount = $payment_details['amount'];
            $time = $payment_details['time'];
            $txnid = $payment_details['txnid'];
            //$clientid = $payment_details['clientid'];
            $reason = $payment_details['reason'];
            $param = array(
            "name"=>$name,
            "amount"=>$amount,
            "time"=>$time,
            "reason"=>$reason,
            "status"=>$status,
            "txnid"=>$txnid
            );
            Modules::run("vigdeals/vigdealswauth/checkcart",$param);
			
			// Auto update order
			if(isset($_GET['mode']) && ($_GET['mode'] == 'api'))
			{
				header('Content-type: text/plain');
				echo json_encode($payment_details);
				exit();
			}
        }
        $this->session->set_flashdata("order_status",$payment_details['status']);
        redirect(base_url()."confirmation");
    }
    protected function redirect($clientid, $amount, $name, $description, $firstname, $lastname, $address, $city, $state, $country, $zipcode, $telno, $email, $page_id, $page_txn)
    {
        header
        (
            'Location: '.$this->PAYMENT_URL.
            '?clientid='.urlencode($clientid).
            '&amount='.urlencode($amount).
            '&name='.urlencode($name).
            '&description='.urlencode($description).
            '&firstname='.urlencode($firstname).
            '&lastname='.urlencode($lastname).
            '&address='.urlencode($address).
            '&city='.urlencode($city).
            '&state='.urlencode($state).
            '&country='.urlencode($country).
            '&zipcode='.urlencode($zipcode).
            '&telno='.urlencode($telno).
            '&email='.urlencode($email).
            '&page_id='.urlencode($page_id).
            '&page_txn='.urlencode($page_txn)
        );
    }
    function get_txn()
    {
        $txn = array();
        if(isset($_GET['txnid'])) 
        {    
            $txn = unserialize
            (
                base64_decode
                (
                    file_get_contents('http://payment.vigattin.net/api/get/'.urlencode($_GET['txnid']))
                )
            );    
        }
        return $txn;
    }    
}
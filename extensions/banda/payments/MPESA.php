<?php 

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MPESA
 *
 * @author /dev/null
 */

class MPESA {

    private $ENDPOINT;
    private $CALLBACK_URL;
    private $CALL_BACK_METHOD;
    private $PAYBILL_NO;
    private $PRODUCT_ID;
    private $MERCHANT_ID;
    private $MERCHANT_TRANSACTION_ID;
    private $INFO;
    private $TIMESTAMP;
    private $PASSWORD;
    private $AMOUNT;
    private $NUMBER; //format 254700000000
    
    private $MySQLiconn;

//put your code here

    public function __construct( $ENDPOINT, $CALLBACK_URL, $CALL_BACK_METHOD, $PAYBILL_NO, $TIMESTAMP, $PASSWORD,$MySQLiconn) {
        $this->ENDPOINT = "https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl";

        $this->CALLBACK_URL = getOption( 'callback' );
        $this->CALL_BACK_METHOD = "POST";

        $this->PAYBILL_NO = getOption( 'paybill' );

        $this->MERCHANT_ID = getOption( 'paybill' );
        

        $this->MERCHANT_TRANSACTION_ID = $this->generateRandomString();
        $this->INFO = getOption( 'paybill' );
        $this->TIMESTAMP = getOption( 'timestamp' );
        $this->PASSWORD = getOption( 'sag' );
        
    }
    
    public function setProductID( $PRODUCT_ID) {
        $this->PRODUCT_ID = $PRODUCT_ID;
    }
    
    public function setAmount( $AMOUNT) {
        $this->AMOUNT = $AMOUNT;
    }

    public function setNumber( $NUMBER) {
        $this->NUMBER = preg_replace(strpos( $NUMBER, '0' ) !== false?"/^0/":"/^+254/", "254", $NUMBER ); //format 254700000000
    }
    
    public function getProductID() {
        return $this->PRODUCT_ID;
    }
    
    public function getAmount() {
        return $this->AMOUNT;
    }

    public function getNumber() {
        return $this->NUMBER; //format 254700000000
    }
    
    // initialize the class
    public function init() {
        $body = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"><soapenv:Header><tns:CheckOutHeader><MERCHANT_ID>' . $this->PAYBILL_NO . '</MERCHANT_ID><PASSWORD>' . $this->PASSWORD . '</PASSWORD><TIMESTAMP>' . $this->TIMESTAMP . '</TIMESTAMP></tns:CheckOutHeader></soapenv:Header><soapenv:Body><tns:processCheckOutRequest><MERCHANT_TRANSACTION_ID>' . $this->MERCHANT_TRANSACTION_ID . '</MERCHANT_TRANSACTION_ID><REFERENCE_ID>' . $this->PRODUCT_ID . '</REFERENCE_ID><AMOUNT>' . $this->AMOUNT . '</AMOUNT><MSISDN>' . $this->NUMBER . '</MSISDN><ENC_PARAMS></ENC_PARAMS><CALL_BACK_URL>' . $this->CALLBACK_URL . '</CALL_BACK_URL><CALL_BACK_METHOD>' . $this->CALL_BACK_METHOD . '</CALL_BACK_METHOD><TIMESTAMP>' . $this->TIMESTAMP . '</TIMESTAMP></tns:processCheckOutRequest></soapenv:Body></soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable
        try {
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $this->ENDPOINT );
            curl_setopt( $ch, CURLOPT_HEADER, 0 );

            curl_setopt( $ch, CURLOPT_VERBOSE, '0' );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );

            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, '0' );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, '0' );

            $output = curl_exec( $ch );
            

// Check if any error occured
            if ( curl_errno( $ch) ) {
                echo 'Error no : ' . curl_errno( $ch) . ' Curl error: ' . curl_error( $ch );
            } else {
                $result = @$this->processcheckout( $this->MERCHANT_TRANSACTION_ID, $this->ENDPOINT, $this->PASSWORD, $this->TIMESTAMP );
                $xml = simplexml_load_string( $result );
                $ns = $xml->getNamespaces(true );
                $soap = $xml->children( $ns['SOAP-ENV'] );
                $sbody = $soap->Body;
                $mpesa_response = $sbody->children( $ns['ns1'] );
                $rstatus = $mpesa_response->transactionConfirmResponse;
                $status = $rstatus->children();
                $s_returncode = $status->RETURN_CODE;
                $s_description = $status->DESCRIPTION; //MERCHANT_TRANSACTION_ID
                $s_merchant_transaction_id = $status->MERCHANT_TRANSACTION_ID; //MERCHANT_TRANSACTION_ID
                $s_transactionid = $status->TRX_ID;
                sleep(5 );
                $sreq = @$this->status_request( $s_merchant_transaction_id, $this->ENDPOINT, $this->PASSWORD, $this->TIMESTAMP, $s_transactionid );
                
                $cresonse = @$this->complete_transaction( $sreq );
                echo ( $cresonse );


            }
            curl_close( $ch );

            // print_r( $transaction );
        } catch (Exception $ex) {
            echo $ex;
        }
    }
    
    public function check() {
        $body = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"><soapenv:Header><tns:CheckOutHeader><MERCHANT_ID>' . $this->PAYBILL_NO . '</MERCHANT_ID><PASSWORD>' . $this->PASSWORD . '</PASSWORD><TIMESTAMP>' . $this->TIMESTAMP . '</TIMESTAMP></tns:CheckOutHeader></soapenv:Header><soapenv:Body><tns:processCheckOutRequest><MERCHANT_TRANSACTION_ID>' . $this->MERCHANT_TRANSACTION_ID . '</MERCHANT_TRANSACTION_ID><REFERENCE_ID>' . $this->PRODUCT_ID . '</REFERENCE_ID><AMOUNT>' . $this->AMOUNT . '</AMOUNT><MSISDN>' . $this->NUMBER . '</MSISDN><ENC_PARAMS></ENC_PARAMS><CALL_BACK_URL>' . $this->CALLBACK_URL . '</CALL_BACK_URL><CALL_BACK_METHOD>' . $this->CALL_BACK_METHOD . '</CALL_BACK_METHOD><TIMESTAMP>' . $this->TIMESTAMP . '</TIMESTAMP></tns:processCheckOutRequest></soapenv:Body></soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable
        try {
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $this->ENDPOINT );
            curl_setopt( $ch, CURLOPT_HEADER, 0 );

            curl_setopt( $ch, CURLOPT_VERBOSE, '0' );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );

            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, '0' );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, '0' );

            $output = curl_exec( $ch );
            

// Check if any error occured
            if ( curl_errno( $ch) ) {
                echo 'Error no : ' . curl_errno( $ch) . ' Curl error: ' . curl_error( $ch );
            } else {
                
                $result = @$this->processcheckout( $this->MERCHANT_TRANSACTION_ID, $this->ENDPOINT, $this->PASSWORD, $this->TIMESTAMP );
                $xml = simplexml_load_string( $result );
                $ns = $xml->getNamespaces(true );
                $soap = $xml->children( $ns['SOAP-ENV'] );
                $sbody = $soap->Body;
                $mpesa_response = $sbody->children( $ns['ns1'] );
                $rstatus = $mpesa_response->transactionConfirmResponse;
                $status = $rstatus->children();
                $s_returncode = $status->RETURN_CODE;
                $s_description = $status->DESCRIPTION; //MERCHANT_TRANSACTION_ID
                $s_merchant_transaction_id = $status->MERCHANT_TRANSACTION_ID; //MERCHANT_TRANSACTION_ID
                $s_transactionid = $status->TRX_ID;
                sleep(5 );
                $sreq = @$this->status_request( $s_merchant_transaction_id, $this->ENDPOINT, $this->PASSWORD, $this->TIMESTAMP, $s_transactionid );
                
                $cresonse = @$this->complete_transaction( $sreq );
                echo ( $cresonse );


            }
            curl_close( $ch );

            // print_r( $transaction );
        } catch (Exception $ex) {
            echo $ex;
        }
    }

    

    public function generateRandomString() {
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen( $characters );
        $randomString = '';
        for ( $i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    //--------------------------------------------------------------------------------------------------

    public function processcheckout( $MERCHANT_TRANSACTION_ID, $ENDPOINT, $PASSWORD, $TIMESTAMP) {


        $bod = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"><soapenv:Header><tns:CheckOutHeader><MERCHANT_ID>'.$this->MERCHANT_ID.'</MERCHANT_ID><PASSWORD>' . $PASSWORD . '</PASSWORD><TIMESTAMP>' . $TIMESTAMP . '</TIMESTAMP></tns:CheckOutHeader></soapenv:Header><soapenv:Body><tns:transactionConfirmRequest><TRX_ID>?</TRX_ID><MERCHANT_TRANSACTION_ID>' . $MERCHANT_TRANSACTION_ID . '</MERCHANT_TRANSACTION_ID></tns:transactionConfirmRequest></soapenv:Body></soapenv:Envelope>';
        
/// Your SOAP XML needs to be in this variable
        try {

            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $ENDPOINT );
            curl_setopt( $ch, CURLOPT_HEADER, false );


            curl_setopt( $ch, CURLOPT_VERBOSE, '0' );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $bod );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, '0' );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, '0' );

            $output = curl_exec( $ch );




            // Check if any error occured
            if ( curl_errno( $ch) ) {
                $data = ["success" => false, "Error_no" => "''.curl_errno( $ch).' Curl error: ' . curl_error( $ch)"];
                return json_encode( $data );
            } else {
                //$response=[];
                $data = [["success" => true, "message" => "no errors occured"]];
                //$info = curl_getinfo( $output,true );
                $xml = simplexml_load_string( $output );
                $ns = $xml->getNamespaces(true );
                $soap = $xml->children( $ns['SOAP-ENV'] );
                $sbody = $soap->Body;
                $mpesa_response = $sbody->children( $ns['ns1'] );
                $rstatus = $mpesa_response->transactionConfirmResponse;
                $status = $rstatus->children();
                $s_returncode = $status->RETURN_CODE;
                $s_description = $status->DESCRIPTION; //MERCHANT_TRANSACTION_ID
                $s_merchant_transaction_id = $status->MERCHANT_TRANSACTION_ID; //MERCHANT_TRANSACTION_ID
                $s_transactionid = $status->TRX_ID;
                $txn = @$this->transaction_confirm( $s_merchant_transaction_id, $ENDPOINT, $PASSWORD, $TIMESTAMP, $s_transactionid );
                return( $txn );
            }

//echo( $output );
            curl_close( $ch );
        } catch (SoapFault $fault) {
            echo $fault;
        }
    }

    public function status_request( $MERCHANT_TRANSACTION_ID, $ENDPOINT, $PASSWORD, $TIMESTAMP, $s_merchant_transaction_id) {
        $bod = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tns="tns:ns">
					   <soapenv:Header>
					      <tns:CheckOutHeader>
					           <MERCHANT_ID>'.$this->MERCHANT_ID.'</MERCHANT_ID>
						<PASSWORD>' . $PASSWORD . '</PASSWORD>
						<TIMESTAMP>' . $TIMESTAMP . '</TIMESTAMP>
					      </tns:CheckOutHeader>
					   </soapenv:Header>
					   <soapenv:Body>
					      <tns:transactionStatusRequest>
					         <!--Optional:-->
					         <TRX_ID>'.$s_merchant_transaction_id.'</TRX_ID>
					         <!--Optional:-->
					         <MERCHANT_TRANSACTION_ID>' . $MERCHANT_TRANSACTION_ID . '</MERCHANT_TRANSACTION_ID>
					      </tns:transactionStatusRequest>
					   </soapenv:Body>
					</soapenv:Envelope>';
        
        try {

            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $ENDPOINT );
            curl_setopt( $ch, CURLOPT_HEADER, 0 );


            curl_setopt( $ch, CURLOPT_VERBOSE, '0' );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $bod );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, '0' );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, '0' );

            $output = curl_exec( $ch );




// Check if any error occured
            if ( curl_errno( $ch) ) {
                //echo 'Error no : '.curl_errno( $ch).' Curl error: ' . curl_error( $ch );
                $data = ["success" => false, "Error_no" => "''.curl_errno( $ch).' Curl error: ' . curl_error( $ch)"];
                return json_encode( $data );
            } else {
                //$response=[];
                $data = [["success" => true, "message" => "no errors occured"]];
                return $output; //json_encode( $data );
            }

            curl_close( $ch );
        } catch (SoapFault $fault) {
            echo $fault;
        }
    }

    public function transaction_confirm( $MERCHANT_TRANSACTION_ID, $ENDPOINT, $PASSWORD, $TIMESTAMP, $s_merchant_transaction_id) {
        $bod = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/">'
                . '   <soapenv:Header>
      <tns:CheckOutHeader>
         <MERCHANT_ID>'.$this->MERCHANT_ID.'</MERCHANT_ID>
	<PASSWORD>' . $PASSWORD . '</PASSWORD>
	<TIMESTAMP>' . $TIMESTAMP . '</TIMESTAMP>
      </tns:CheckOutHeader>
   </soapenv:Header>
   <soapenv:Body>
      <tns:transactionConfirmRequest>
         <!--Optional:-->
         <TRX_ID>?</TRX_ID>
         <!--Optional:-->
         <MERCHANT_TRANSACTION_ID>' . $MERCHANT_TRANSACTION_ID . '</MERCHANT_TRANSACTION_ID>
      </tns:transactionConfirmRequest>
   </soapenv:Body>
</soapenv:Envelope>
';
        //var_dump( $bod );
/// Your SOAP XML needs to be in this variable
        try {

            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $ENDPOINT );
            curl_setopt( $ch, CURLOPT_HEADER, 0 );


            curl_setopt( $ch, CURLOPT_VERBOSE, '0' );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $bod );
            curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, '0' );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, '0' );

            $output = curl_exec( $ch );




// Check if any error occured
            if ( curl_errno( $ch) ) {
                //echo 'Error no : '.curl_errno( $ch).' Curl error: ' . curl_error( $ch );
                $data = ["success" => false, "Error_no" => "''.curl_errno( $ch).' Curl error: ' . curl_error( $ch)"];
                return json_encode( $data );
            } else {
                //$response=[];
                $data = [["success" => true, "message" => "no errors occured"]];
                return $output; //json_encode( $data );
            }

            curl_close( $ch );
        } catch (SoapFault $fault) {
            echo $fault;
        }
    }

    public function complete_transaction( $sreq) {
        //echo $sreq;
        $xml = simplexml_load_string( $sreq );
        $ns = $xml->getNamespaces(true );
        $soap = $xml->children( $ns['SOAP-ENV'] );
        $sbody = $soap->Body;
        $mpesa_response = $sbody->children( $ns['ns1'] );
        $rstatus = $mpesa_response->transactionStatusResponse;
        $status = $rstatus->children();
        $s_msisdn = $status->MSISDN;
        $s_date = $status->MPESA_TRX_DATE;
        $s_amount = $status->AMOUNT;
        $s_transactionid = $status->MPESA_TRX_ID;
        $s_status = $status->TRX_STATUS;
        $s_returncode = $status->RETURN_CODE;
        $s_description = $status->DESCRIPTION;
        $s_merchant_transaction_id = $status->MERCHANT_TRANSACTION_ID;
        $s_encparams = $status->ENC_PARAMS;
        $s_txID = $status->TRX_ID;
        //Save the returned data into the database or use it to finish certain operation.
        
        if ( $s_status == "Success" ) {
            //Perfomr X operation
            $data['response'] = [
                'success' => true,
                'msisdn' => strip_tags( $s_msisdn),
                'date' => strip_tags( $s_date),
                'amount' => strip_tags( $s_amount),
                'transactionid' => strip_tags( $s_transactionid),
                'status' => strip_tags( $s_status),
                'returncode' => strip_tags( $s_returncode),
                'description' => strip_tags( $s_description),
                'merchant_transaction_id' => strip_tags( $s_merchant_transaction_id),
                'encparams' => strip_tags( $s_encparams),
                'txID' => strip_tags( $s_txID)
            ];
            
        } else {
            //Perform X operation
            $response =array(
                'success' => false,
                'msisdn' => strip_tags( $s_msisdn),
                'date' => strip_tags( $s_date),
                'amount' => strip_tags( $s_amount),
                'transactionid' => strip_tags( $s_transactionid),
                'status' => strip_tags( $s_status),
                'returncode' => strip_tags( $s_returncode),
                'description' => strip_tags( $s_description),
                'merchant_transaction_id' => strip_tags( $s_merchant_transaction_id),
                'encparams' => strip_tags( $s_encparams),
                'txID' => strip_tags( $s_txID)
                
            );
            $data['response'] = $response;
            
        }
        return json_encode( $data );
    }

}

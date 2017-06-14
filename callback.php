<?php 

function deliver_response( $format, $api_response) {

    // Define HTTP responses
    $http_response_code = array(
        200 => 'OK',
        400 => 'Bad Request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not Found'
    );

    // Set HTTP Response
    header('HTTP/1.1 ' . $api_response['status'] . ' ' . $http_response_code[$api_response['status']] );

    // Process different content types
    if ( strcasecmp( $format, 'json' ) == 0) {

        // Set HTTP Response Content Type
        header('Content-Type: application/json; charset=utf-8' );

        // Format data into a JSON response
        $json_response = json_encode( $api_response );

        // Deliver formatted data
        echo $json_response;
    } elseif ( strcasecmp( $format, 'xml' ) == 0) {

        // Set HTTP Response Content Type
        header('Content-Type: application/xml; charset=utf-8' );

        // if the response data is not an array
        if ( !is_array( $api_response['data'] ) ) {
            // Format data into an XML response (This is only good at handling string data, not arrays)
            $xml_response = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
                    '<response>' . "\n" .
                    "\t" . '<code>' . $api_response['code'] . '</code>' . "\n" .
                    "\t" . '<data>' . $api_response['data'] . '</data>' . "\n" .
                    '</response>';

            // Deliver formatted data
            echo $xml_response;
        } else {
            $xml_response = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
                    '<response>' . "\n" .
                    "\t" . '<code>' . $api_response['code'] . '</code>' . "\n";



            // Deliver formatted data
            foreach ( $api_response['data'] as $key => $value) {
                foreach ( $value as $k => $v) {
                    $xml_response.= "\t" . '<' . $k . '>' . $v . '</' . $k . '>' . "\n";
                }
//            print_r( $value );
            }
            $xml_response.='</response>';
            echo ( $xml_response );
        }
    } else {

        // Set HTTP Response Content Type (This is only good at handling string data, not arrays)
        header('Content-Type: text/html; charset=utf-8' );

        // if the response data is not an array
        if ( !is_array( $api_response['data'] ) ) {
            // Deliver formatted data
            echo $api_response['data'];
        } else {

            foreach ( $api_response['data'] as $key => $value) {
                foreach ( $value as $k => $v) {
                    $html_response.= "\t" . $v . "\n";
                }
//            print_r( $value );
            }
            echo $html_response;
        }
    }

    // End script process
    exit;
}

// Define whether an HTTPS connection is required
$HTTPS_required = FALSE;

// Define whether user authentication is required
$authentication_required = FALSE;

// Define API response codes and their related HTTP response
$api_response_code = array(
    0 => array('HTTP Response' => 400, 'Message' => 'Unknown Error' ),
    1 => array('HTTP Response' => 200, 'Message' => 'Success' ),
    2 => array('HTTP Response' => 403, 'Message' => 'HTTPS Required' ),
    3 => array('HTTP Response' => 401, 'Message' => 'Authentication Required' ),
    4 => array('HTTP Response' => 401, 'Message' => 'Authentication Failed' ),
    5 => array('HTTP Response' => 404, 'Message' => 'Invalid Request' ),
    6 => array('HTTP Response' => 400, 'Message' => 'Invalid Response Format' )
 );

// Set default HTTP response of 'ok'
$response['code'] = 0;
$response['status'] = 404;
$response['data'] = NULL;

// --- Step 2: Authorization
// Optionally require connections to be made via HTTPS
if ( $HTTPS_required && $_SERVER['HTTPS'] != 'on' ) {
    $response['code'] = 2;
    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
    $response['data'] = $api_response_code[$response['code']]['Message'];

    // Return Response to browser. This will exit the script.
    deliver_response( $_GET['format'], $response );
}

// Optionally require user authentication
if ( $authentication_required) {

    if ( empty( $_POST['username'] ) || empty( $_POST['password'] ) ) {
        $response['code'] = 3;
        $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
        $response['data'] = $api_response_code[$response['code']]['Message'];

        // Return Response to browser
        deliver_response( $_GET['format'], $response );
    }

    // Return an error response if user fails authentication. This is a very simplistic example
    // that should be modified for security in a production environment
    elseif ( $_POST['username'] != 'foo' && $_POST['password'] != 'bar' ) {
        $response['code'] = 4;
        $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
        $response['data'] = $api_response_code[$response['code']]['Message'];

        // Return Response to browser
        deliver_response( $_GET['format'], $response );
    }
}

// --- Step 3: Process Request
// Method A: Say Hello to the API
if ( strcasecmp( $_GET['method'], 'hello' ) == 0) {
    $response['code'] = 1;
    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];
    $response['data'] = 'Hello World';
}



if ( strcasecmp( $_GET['method'], 'checkout' ) == 0) {
    header('Access-Control-Allow-Origin:*' );
    $response['code'] = 1;

    $response['status'] = $api_response_code[$response['code']]['HTTP Response'];

    if ( isset( $_POST['amount'], $_POST['number'] ) ) {
        $AMOUNT = $_POST['amount'];
        $NUMBER = $_POST['number'];
        $PRODUCT_ID = $_POST['item'];
        //init MPESA class
        $mpesa->setProductID( $PRODUCT_ID );
        $mpesa->setAmount( $AMOUNT );
        $mpesa->setNumber( $NUMBER ); // replaces 0 with 254
        $mpesa->init();
    }
}

// --- Step 4: Deliver Response
// Return Response to browser
deliver_response( $_GET['format'], $response );

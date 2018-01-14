<?php //00e57
// *************************************************************************
// *                                                                       *
// * WHMCS - The Complete Client Management, Billing & Support Solution    *
// * Copyright (c) WHMCS Ltd. All Rights Reserved,                         *
// * Version: 5.3.14 (5.3.14-release.1)                                    *
// * BuildId: 0866bd1.62                                                   *
// * Build Date: 28 May 2015                                               *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * Email: info@whmcs.com                                                 *
// * Website: http://www.whmcs.com                                         *
// *                                                                       *
// *************************************************************************
// *                                                                       *
// * This software is furnished under a license and may be used and copied *
// * only  in  accordance  with  the  terms  of such  license and with the *
// * inclusion of the above copyright notice.  This software  or any other *
// * copies thereof may not be provided or otherwise made available to any *
// * other person.  No title to and  ownership of the  software is  hereby *
// * transferred.                                                          *
// *                                                                       *
// * You may not reverse  engineer, decompile, defeat  license  encryption *
// * mechanisms, or  disassemble this software product or software product *
// * license.  WHMCompleteSolution may terminate this license if you don't *
// * comply with any of the terms and conditions set forth in our end user *
// * license agreement (EULA).  In such event,  licensee  agrees to return *
// * licensor  or destroy  all copies of software  upon termination of the *
// * license.                                                              *
// *                                                                       *
// * Please see the EULA file for the full End User License Agreement.     *
// *                                                                       *
// *************************************************************************
if( !defined('WHMCS') )
{
    exit( "This file cannot be accessed directly" );
}
define('EWAY_DEFAULT_GATEWAY_URL', "https://www.eway.com.au/gateway/xmlpayment.asp");
define('EWAY_DEFAULT_CUSTOMER_ID', '87654321');
define('EWAY_CURL_ERROR_OFFSET', 1000);
define('EWAY_XML_ERROR_OFFSET', 2000);
define('EWAY_TRANSACTION_OK', 0);
define('EWAY_TRANSACTION_FAILED', 1);
define('EWAY_TRANSACTION_UNKNOWN', 2);
class EwayPayment
{
    public $parser = NULL;
    public $xmlData = NULL;
    public $currentTag = NULL;
    public $myGatewayURL = NULL;
    public $myCustomerID = NULL;
    public $myTotalAmount = NULL;
    public $myCustomerFirstname = NULL;
    public $myCustomerLastname = NULL;
    public $myCustomerEmail = NULL;
    public $myCustomerAddress = NULL;
    public $myCustomerPostcode = NULL;
    public $myCustomerCountry = NULL;
    public $myCustomerInvoiceDescription = NULL;
    public $myCustomerInvoiceRef = NULL;
    public $myCardHoldersName = NULL;
    public $myCardNumber = NULL;
    public $myCardExpiryMonth = NULL;
    public $myCardExpiryYear = NULL;
    public $myCardCVN = NULL;
    public $myTrxnNumber = NULL;
    public $myOption1 = NULL;
    public $myOption2 = NULL;
    public $myOption3 = NULL;
    public $myResultTrxnStatus = NULL;
    public $myResultTrxnNumber = NULL;
    public $myResultTrxnOption1 = NULL;
    public $myResultTrxnOption2 = NULL;
    public $myResultTrxnOption3 = NULL;
    public $myResultTrxnReference = NULL;
    public $myResultTrxnError = NULL;
    public $myResultAuthCode = NULL;
    public $myResultReturnAmount = NULL;
    public $myError = NULL;
    public $myErrorMessage = NULL;
    public function epXmlElementStart($parser, $tag, $attributes)
    {
        $this->currentTag = $tag;
    }
    public function epXmlElementEnd($parser, $tag)
    {
        $this->currentTag = '';
    }
    public function epXmlData($parser, $cdata)
    {
        $this->xmlData[$this->currentTag] = $cdata;
    }
    public function setCustomerID($customerID)
    {
        $this->myCustomerID = $customerID;
    }
    public function setTotalAmount($totalAmount)
    {
        $this->myTotalAmount = $totalAmount;
    }
    public function setCustomerFirstname($customerFirstname)
    {
        $this->myCustomerFirstname = $customerFirstname;
    }
    public function setCustomerLastname($customerLastname)
    {
        $this->myCustomerLastname = $customerLastname;
    }
    public function setCustomerEmail($customerEmail)
    {
        $this->myCustomerEmail = $customerEmail;
    }
    public function setCustomerAddress($customerAddress)
    {
        $this->myCustomerAddress = $customerAddress;
    }
    public function setCustomerCountry($customerCountry)
    {
        $this->myCustomerCountry = $customerCountry;
    }
    public function setCustomerPostcode($customerPostcode)
    {
        $this->myCustomerPostcode = $customerPostcode;
    }
    public function setCustomerInvoiceDescription($customerInvoiceDescription)
    {
        $this->myCustomerInvoiceDescription = $customerInvoiceDescription;
    }
    public function setCustomerInvoiceRef($customerInvoiceRef)
    {
        $this->myCustomerInvoiceRef = $customerInvoiceRef;
    }
    public function setCardHoldersName($cardHoldersName)
    {
        $this->myCardHoldersName = $cardHoldersName;
    }
    public function setCardNumber($cardNumber)
    {
        $this->myCardNumber = $cardNumber;
    }
    public function setCardExpiryMonth($cardExpiryMonth)
    {
        $this->myCardExpiryMonth = $cardExpiryMonth;
    }
    public function setCardExpiryYear($cardExpiryYear)
    {
        $this->myCardExpiryYear = $cardExpiryYear;
    }
    public function setCardCVN($cardCVN)
    {
        $this->myCardCVN = $cardCVN;
    }
    public function setTrxnNumber($trxnNumber)
    {
        $this->myTrxnNumber = $trxnNumber;
    }
    public function setOption1($option1)
    {
        $this->myOption1 = $option1;
    }
    public function setOption2($option2)
    {
        $this->myOption2 = $option2;
    }
    public function setOption3($option3)
    {
        $this->myOption3 = $option3;
    }
    public function getTrxnStatus()
    {
        return $this->myResultTrxnStatus;
    }
    public function getTrxnNumber()
    {
        return $this->myResultTrxnNumber;
    }
    public function getTrxnOption1()
    {
        return $this->myResultTrxnOption1;
    }
    public function getTrxnOption2()
    {
        return $this->myResultTrxnOption2;
    }
    public function getTrxnOption3()
    {
        return $this->myResultTrxnOption3;
    }
    public function getTrxnReference()
    {
        return $this->myResultTrxnReference;
    }
    public function getTrxnError()
    {
        return $this->myResultTrxnError;
    }
    public function getAuthCode()
    {
        return $this->myResultAuthCode;
    }
    public function getReturnAmount()
    {
        return $this->myResultReturnAmount;
    }
    public function getError()
    {
        if( $this->myError != 0 )
        {
            return $this->myError;
        }
        if( $this->getTrxnStatus() == 'True' )
        {
            return EWAY_TRANSACTION_OK;
        }
        if( $this->getTrxnStatus() == 'False' )
        {
            return EWAY_TRANSACTION_FAILED;
        }
        return EWAY_TRANSACTION_UNKNOWN;
    }
    public function getErrorMessage()
    {
        if( $this->myError != 0 )
        {
            return $this->myErrorMessage;
        }
        return $this->getTrxnError();
    }
    public function EwayPayment($customerID = EWAY_DEFAULT_CUSTOMER_ID, $gatewayURL = EWAY_DEFAULT_GATEWAY_URL)
    {
        $this->myCustomerID = $customerID;
        $this->myGatewayURL = $gatewayURL;
    }
    public function doPayment()
    {
        $xmlRequest = "<ewaygateway>" . "<ewayCustomerID>" . htmlentities($this->myCustomerID) . "</ewayCustomerID>" . "<ewayTotalAmount>" . htmlentities($this->myTotalAmount) . "</ewayTotalAmount>" . "<ewayCustomerFirstName><![CDATA[" . htmlentities($this->myCustomerFirstname) . "]]></ewayCustomerFirstName>" . "<ewayCustomerLastName><![CDATA[" . htmlentities($this->myCustomerLastname) . "]]></ewayCustomerLastName>" . "<ewayCustomerEmail>" . htmlentities($this->myCustomerEmail) . "</ewayCustomerEmail>" . "<ewayCustomerAddress><![CDATA[" . htmlentities($this->myCustomerAddress) . "]]></ewayCustomerAddress>" . "<ewayCustomerPostcode>" . htmlentities($this->myCustomerPostcode) . "</ewayCustomerPostcode>" . "<ewayCustomerInvoiceDescription>" . htmlentities($this->myCustomerInvoiceDescription) . "</ewayCustomerInvoiceDescription>" . "<ewayCustomerInvoiceRef>" . htmlentities($this->myCustomerInvoiceRef) . "</ewayCustomerInvoiceRef>" . "<ewayCardHoldersName><![CDATA[" . htmlentities($this->myCardHoldersName) . "]]></ewayCardHoldersName>" . "<ewayCardNumber>" . htmlentities($this->myCardNumber) . "</ewayCardNumber>" . "<ewayCardExpiryMonth>" . htmlentities($this->myCardExpiryMonth) . "</ewayCardExpiryMonth>" . "<ewayCardExpiryYear>" . htmlentities($this->myCardExpiryYear) . "</ewayCardExpiryYear>" . "<ewayCVN>" . htmlentities($this->myCardCVN) . "</ewayCVN>" . "<ewayTrxnNumber>" . htmlentities($this->myTrxnNumber) . "</ewayTrxnNumber>" . "<ewayCustomerIPAddress>" . $_SERVER['REMOTE_ADDR'] . "</ewayCustomerIPAddress>" . "<ewayCustomerBillingCountry>" . htmlentities($this->myCustomerCountry) . "</ewayCustomerBillingCountry>" . "<ewayOption1>" . htmlentities($this->myOption1) . "</ewayOption1>" . "<ewayOption2>" . htmlentities($this->myOption2) . "</ewayOption2>" . "<ewayOption3>" . htmlentities($this->myOption3) . "</ewayOption3>" . "</ewaygateway>";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->myGatewayURL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xmlRequest);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        $xmlResponse = curl_exec($ch);
        if( curl_errno($ch) == CURLE_OK )
        {
            $this->parser = xml_parser_create();
            xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, FALSE);
            xml_set_object($this->parser, $this);
            xml_set_element_handler($this->parser, 'epXmlElementStart', 'epXmlElementEnd');
            xml_set_character_data_handler($this->parser, 'epXmlData');
            xml_parse($this->parser, $xmlResponse, TRUE);
            if( xml_get_error_code($this->parser) == XML_ERROR_NONE )
            {
                $this->myResultTrxnStatus = $this->xmlData['ewayTrxnStatus'];
                $this->myResultTrxnNumber = $this->xmlData['ewayTrxnNumber'];
                $this->myResultTrxnOption1 = $this->xmlData['ewayTrxnOption1'];
                $this->myResultTrxnOption2 = $this->xmlData['ewayTrxnOption2'];
                $this->myResultTrxnOption3 = $this->xmlData['ewayTrxnOption3'];
                $this->myResultTrxnReference = $this->xmlData['ewayTrxnReference'];
                $this->myResultAuthCode = $this->xmlData['ewayAuthCode'];
                $this->myResultReturnAmount = $this->xmlData['ewayReturnAmount'];
                $this->myResultTrxnError = $this->xmlData['ewayTrxnError'];
                $this->myError = 0;
                $this->myErrorMessage = '';
            }
            else
            {
                $this->myError = xml_get_error_code($this->parser) + EWAY_XML_ERROR_OFFSET;
                $this->myErrorMessage = xml_error_string($myError);
            }
            xml_parser_free($this->parser);
        }
        else
        {
            $this->myError = curl_errno($ch) + EWAY_CURL_ERROR_OFFSET;
            $this->myErrorMessage = curl_error($ch);
            $this->xmlData['CurlError'] = curl_errno($ch) . " - " . curl_error($ch);
        }
        curl_close($ch);
        return $this->getError();
    }
}
function eway_config()
{
    $configarray = array( 'FriendlyName' => array( 'Type' => 'System', 'Value' => 'eWay' ), 'customerid' => array( 'FriendlyName' => "Customer ID", 'Type' => 'text', 'Size' => '20' ), 'refundpw' => array( 'FriendlyName' => "Refund Password", 'Type' => 'text', 'Size' => '30' ), 'beagle' => array( 'FriendlyName' => "Enable Beagle", 'Type' => 'yesno' ), 'testmode' => array( 'FriendlyName' => "Test Mode", 'Type' => 'yesno' ) );
    return $configarray;
}
function eway_capture($params)
{
    if( $params['testmode'] )
    {
        $url = "https://www.eway.com.au/gateway/xmltest/testpage.asp";
    }
    else
    {
        if( $params['beagle'] && $params['cccvv'] )
        {
            $url = "https://www.eway.com.au/gateway_cvn/xmlbeagle.asp";
        }
        else
        {
            $url = "https://www.eway.com.au/gateway/xmlpayment.asp";
        }
    }
    $eway = new EwayPayment($params['customerid'], $url);
    $eway->setCustomerFirstname($params['clientdetails']['firstname']);
    $eway->setCustomerLastname($params['clientdetails']['lastname']);
    $eway->setCustomerEmail($params['clientdetails']['email']);
    $eway->setCustomerAddress($params['clientdetails']['address1'] . ", " . $params['clientdetails']['city'] . ", " . $params['clientdetails']['state']);
    $eway->setCustomerPostcode($params['clientdetails']['postcode']);
    $eway->setCustomerCountry($params['clientdetails']['country']);
    $eway->setCustomerInvoiceDescription($params['description']);
    $eway->setCustomerInvoiceRef($params['invoiceid']);
    $eway->setCardHoldersName($params['clientdetails']['firstname'] . " " . $params['clientdetails']['lastname']);
    $eway->setCardNumber($params['cardnum']);
    $eway->setCardExpiryMonth(substr($params['cardexp'], 0, 2));
    $eway->setCardExpiryYear(substr($params['cardexp'], 2, 2));
    $eway->setCardCVN($params['cccvv']);
    $eway->setTrxnNumber($params['invoiceid']);
    $eway->setTotalAmount(round($params['amount'] * 100, 2));
    $desc = "Action => Capture\nClient => " . $params['clientdetails']['firstname'] . " " . $params['clientdetails']['lastname'] . "\n";
    $result = $eway->doPayment();
    foreach( $eway->xmlData as $key => $value )
    {
        $desc .= $key . " => " . $value . "\n";
    }
    if( $result == EWAY_TRANSACTION_OK )
    {
        return array( 'status' => 'success', 'transid' => $eway->getTrxnNumber(), 'rawdata' => $desc );
    }
    return array( 'status' => 'declined', 'rawdata' => $desc );
}
function eway_refund($params)
{
    global $CONFIG;
    $url = "https://www.eway.com.au/gateway/xmlpaymentrefund.asp";
    $xml = "<ewaygateway>\n<ewayCustomerID>" . $params['customerid'] . "</ewayCustomerID>\n<ewayTotalAmount>" . $params['amount'] * 100 . "</ewayTotalAmount>\n<ewayCardExpiryMonth>" . substr($params['expdate'], 0, 2) . "</ewayCardExpiryMonth>\n<ewayCardExpiryYear>" . substr($params['expdate'], 2, 2) . "</ewayCardExpiryYear>\n<ewayOriginalTrxnNumber>" . $params['transid'] . "</ewayOriginalTrxnNumber>\n<ewayOption1></ewayOption1>\n<ewayOption2></ewayOption2>\n<ewayOption3></ewayOption3>\n<ewayRefundPassword>" . $params['refundpw'] . "</ewayRefundPassword>\n</ewaygateway>";
    $data = curlCall($url, $xml);
    $results = XMLtoArray($data);
    if( $results['EWAYRESPONSE']['EWAYTRXNSTATUS'] == 'True' )
    {
        return array( 'status' => 'success', 'transid' => $results['EWAYRESPONSE']['EWAYTRXNREFERENCE'], 'rawdata' => $results['EWAYRESPONSE'] );
    }
    return array( 'status' => 'error', 'rawdata' => $results['EWAYRESPONSE'] );
}
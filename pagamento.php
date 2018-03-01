<?php
//por padrao pagseguro usa 30s de requisicao. O local demora mais de 30s.; set time limit ignora este tempo
	set_time_limit(0);	
    require_once('config.php');
    require_once('functions.php');
	
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<?php 
    
    $creditCardToken = $_POST['token'];
    $senderHash 	 = htmlspecialchars($_POST["senderHash"]);
	
    $params = array(
        'email'                     	=> $PAGSEGURO_EMAIL,  
        'token'                     	=> $PAGSEGURO_TOKEN,
        'creditCardToken'           	=> $creditCardToken,
        'senderHash'                	=> $senderHash,
        'receiverEmail'             	=> $PAGSEGURO_EMAIL,
        'paymentMode'               	=> 'default', 
        'paymentMethod'             	=> 'creditCard', //informa tipo do pagamento ao pagseguro
        'currency'                  	=> 'BRL',
        // 'extraAmount'                => '1.00',
		//produto
        'itemId1'                   	=> '0001',
        'itemDescription1'          	=> 'Espada Samurai',  
        'itemAmount1'               	=> '100.00',  
        'itemQuantity1'             	=> 1,
        'reference'                 	=> rand().'katana666',
		//comrpador
        'senderName'                	=> 'Chuck Norris',
        'senderCPF'                		=> '75500930168',
        'senderAreaCode'            	=> '62',
        'senderPhone'               	=> '32124223',
        'senderEmail'               	=> 'teste@sandbox.pagseguro.com.br',
        'shippingAddressStreet'     	=> 'rua do Chuck Norris',
        'shippingAddressNumber'     	=> '1234',
        'shippingAddressDistrict'   	=> 'Bairro',
        'shippingAddressPostalCode' 	=> '74013040',
        'shippingAddressCity'       	=> 'Goiânia',
        'shippingAddressState'      	=> 'GO',
        'shippingAddressCountry'    	=> 'BRA',
		//COBRANCA
        'shippingType'              	=> 1, //1 = pac , 2- sedex, 3 - outros
        'shippingCost'              	=> '1.00',
        'installmentQuantity'       	=> 1,
        'installmentValue'          	=> '101.00', //valor do produto + frete
        'creditCardHolderName'      	=> 'Chuck Norris',
        'creditCardHolderCPF'       	=> '75500930168',
        'creditCardHolderBirthDate' 	=> '01/01/1990',
        'creditCardHolderAreaCode'  	=> '62',
        'creditCardHolderPhone'     	=> '32124223',
        'billingAddressStreet'     	 	=> 'rua do Chuck Norris',
        'billingAddressNumber'    	 	=> '1234',
        'billingAddressDistrict'   	 	=> 'Bairro',
        'billingAddressPostalCode' 		=> '74013040',
        'billingAddressCity'       		=> 'Goiânia',
        'billingAddressState'       	=> 'GO',
        'billingAddressCountry'    		=> 'BRA'
    );
	
    $header = array('Content-Type' => 'application/json; charset=UTF-8;');//aplicando json
    $response = curlExec($PAGSEGURO_API_URL."/transactions", $params, $header);
    $json = json_decode(json_encode(simplexml_load_string($response)));
?>
<body>
    <p>Response: <?php print_r($json);  ?></p>
</body>
</html>
<?php 
	//para $SANDBOX_ENVIRONMENT = true. para $SANDBOX_ENVIRONMENT = false
    $SANDBOX_ENVIRONMENT = true;
    
    $PAGSEGURO_API_URL = 'https://ws.pagseguro.uol.com.br/v2';
    if($SANDBOX_ENVIRONMENT){
        $PAGSEGURO_API_URL = 'https://ws.sandbox.pagseguro.uol.com.br/v2';
		$PAGSEGURO_EMAIL = '';
		
		//TOKEN SANDBOX = "17959EA1F51940B88260BC3ED9161976"
		//TOKEN PRODUCAO = "0D2C50A6755A402C8EA655605DBD1ED2"
		
		$PAGSEGURO_TOKEN = '';
		
	}

    
?>
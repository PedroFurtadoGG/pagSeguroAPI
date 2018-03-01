<?php
//por padrao pagseguro usa 30s de requisicao. O local demora mais de 30s.; set time limit ignora este tempo
	set_time_limit(0);
    require_once('config.php');
    require_once('functions.php');
?>
<html>
<head>
    <meta charset="UTF-8">
    <?php 
        $params = array(
			'email' => $PAGSEGURO_EMAIL,
			'token' => $PAGSEGURO_TOKEN
        );
        $header = array();

        $response = curlExec($PAGSEGURO_API_URL."/sessions", $params, $header);
        $json = json_decode(json_encode(simplexml_load_string($response)));
        $codeSessao = $json->id;
    ?>
</head>
<body>

<div class="container">
	<body>
		<form action="pagamento.php" method="POST" id="form">
				<input type="text" name="brand" id="bandeira" />
				<input type="text" name="token" id="token" />
				<input type="text" name="senderHash" id="senderHash" />
			<div>
				<label for="nome">N cartao</label>
				<input type="text" id="cardNumber" />
			</div>
			<div>
				<label for="email">mes validade</label>
				<input type="text" id="expirationMonth" />
			</div>
			<div>
				<label for="email">ano validade</label>
				<input type="text" id="expirationYear" />
			</div>
		    <div>
				<label for="email">cvv</label>
				<input type="tel" id="cardCVC" />
			</div>
			<button type="button" id="btnpagamento" value="Submit">PAGAR</button>
		</form>
			
	</body>
</div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

  <script>
		
		
		//meio de pagamento
        jQuery(function($) {
          PagSeguroDirectPayment.setSessionId('<?php echo $codeSessao;?>');
		
		//metodo de pagamento
          PagSeguroDirectPayment.getPaymentMethods({
            success: function(json){
                console.log(json);
            },
            error: function(json){
                console.log(json);
              var erro = "";
              for(i in json.errors){
                erro = erro + json.errors[i];
              }
              alert(erro);
            },
            complete: function(json){
            }
          });

		  //bandeira do cartao
        

        });
		
		//id do comprador
        $("#btnpagamento").click(function(){
			
			
			PagSeguroDirectPayment.getBrand({
				cardBin: $("input#cardNumber").val(),
				success: function(response) {
					$('input#bandeira').val(response.brand.name);
					
				},
				error: function(response) {
					console.log(response);
				}
			});
			
			var param = {
				cardNumber: $("input#cardNumber").val(),
				cvv: $("input#cardCVC").val(),
				expirationMonth: $("input#expirationMonth").val(),
				expirationYear: $("input#expirationYear").val(),
				success: function(response) {
					
					$('input#token').val(response.card.token);
					
				},
				error: function(response) {
					//tratamento do erro
					console.log(response);
				}
			}

			PagSeguroDirectPayment.createCardToken(param);
			
			var senderHash = PagSeguroDirectPayment.getSenderHash();
            $("input[name='senderHash']").val(senderHash);
			
			setTimeout(function(){
				$('#form').submit();
			}, 4000);
        });

    </script>
</body>
</html>
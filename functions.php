<?php 
    date_default_timezone_set('America/Sao_Paulo');
    function curlExec($url, $post = NULL, array $header = array()){
        $curl= curl_init($url);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        if(count($header) > 0) {
          curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        }
        if($post !== null) {
          curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post, '', '&'));
        }
    
        //Ignora ssl do site
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $data = curl_exec($curl);
        curl_close($curl);

        return $data;
    }
?>
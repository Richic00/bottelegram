		<?php
		//file necessari ad inviare foto, doc e audio
		require 'class-http-request.php';
		require 'functions.php';
		//modificare col vostro token del bot
		$api="724039027:AAEl6pJAAK7h2Mj-OUQnMgia1tvH6uCPvIQ";
		
		
		//prendo quello che mi è arrivato e lo salvo nella variabile content
		$content = file_get_contents("php://input");
		//decodifico quello che mi è arrivato
		$update = json_decode($content, true);
		//se non sono riuscito a decodificarlo mi fermo
		if(!$update)
		{
		  exit;
		}

        //altrimenti proseguo e vado a leggere il messaggio salvandolo nella variabile 
		//message
		$message = isset($update['message']) ? $update['message'] : "";
		//facciamo la stessa cosa anche per l'id del mess.
		$messageId = isset($message['message_id']) ? $message['message_id'] : "";
		//l'id della chat che servirà al nostro bot per sapere a chi risponder
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		//il nome dell'utente che ha scritto
		$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
		//il cognome
		$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
		//lo username
		$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
		//la data
		$date = isset($message['date']) ? $message['date'] : "";
		//ed il testo del messaggio
		$text = isset($message['text']) ? $message['text'] : "";
        //eliminiamo gli spazi con trim e convertiamo in minuscolo con la funz strtolower
		
		$text = trim($text);
		$text = strtolower($text);
        
		//$text = json_encode($message);
		 //costruiamo la risposta del nostro bot
		 //l'header è sempre uguale ed indica che sarà un messaggio con codifica
		 //JSON
		header("Content-Type: application/json");
		//i parametri sono cosa voglio mandare indietro al mio utente, rimando il testo che
		//ho ricevuto e che si trova nella variabile $text
		$parameters = array('chat_id' => $chatId, "text" => $text);
		
		if($text =="data" || $text=="/data"){
			$text ="La data odierna è: ".date("d/m/y");
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}
		

		if($text =="bolletta del sabato"){
			$text ="tanto è già persa";
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}
		
		if($text =="sisal"){
			$text ="https://www.sisal.it/";
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}

		if($text =="goldbet"){
			$text ="https://www.goldbet.it/";
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}
		
		if($text =="eurobet"){
			$text ="https://www.eurobet.it/it/scommesse/?splash=false#!";
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}

		if($text =="tony"||$text =="/tony"){
			sendFoto($chatId,"rap.jpg",false, "tonyeffe", $api);
		}
		
		if($text =="barzellette"||$text =="barz"){
			$barz[0]="eskeree";
			$barz[1]="flexx";
			$barz[2]="L’ammiraglio vede una flotta nemica e dice al suo tirapiedi:portami la mia maglietta rossa così i soldati non vedranno il mio sangue Subito dopo il tirapiedi gli dice: ci sono altre 20 navi ammiraglio...vado a prendere i pantaloni marroni. ";
			$barz[3]=" Due tirchi scommettono 20 euro per chi resta più a lungo sott acqua: ritrovati i due cadaveri!";			
			$barz[4]="Se sentite delle sirene avvicinarsi non vi preoccupate.... ho appena arrestato il PC!";
			
			$i = rand(0,4); 				
			$parameters = array('chat_id' => $chatId, "text" => $barz[$i]);
		}


		if($text =="bucarest"||$text =="/bucarest"){
	
			sendAudio($chatId, "bucarest.mp3",false, "OG EASTBULL ft. TONY - BUCAREST (Prod. Sick Luke)", $api);
		}

		if($text =="testopdf"){
		
			sendDocument($chatId, "testopdf.pdf",false, "documento", $api);
		
		}




		
		//aggiungo il comando di invio
		//e lo invio
		
		$parameters["method"] = "sendMessage";
        echo json_encode($parameters);
		
		
		
		
		
		
		?>
		
		
		
		
		
		

		
		
		

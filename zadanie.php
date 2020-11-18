<?php
	require_once 'database.php';

	class User{

     function getData(){//polaczenie z api + pobranie danych do zmienne $this->decoded
        $url = "https://jsonplaceholder.typicode.com/users/1";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $resp = curl_exec($ch);

        if($e = curl_error($ch)){
            echo $e;
        }else{
            $this->decoded = json_decode($resp);
        }
        curl_close($ch);
    }

   function getDomain(){//ucinanie po malpie
		return explode('@', $this->decoded->email)[1];
    }

    function getPersonData(){//wyswietlenie w formacie JSON
        return json_encode($this->decoded, JSON_PRETTY_PRINT);
    }
  }
    $db = new Database;
    $db->create();
    $db->add();
   
    $user = new User();
	$user->getData();



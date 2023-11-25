<?php

// Cette URL nous donnera une error 404 car elle n'est pas complete
// $curlError404 = curl_init('https://samples.openweathermap.org/data');


// Initialisation de cURL
$curl = curl_init('https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22');


// Desactiver la verification SSL (Deconseiller de faire cela, la meilleur methode est de telecharger un certificat)
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// Chargement de certificat
// curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/certificates/GTS CA 1C3.crt');

// Option permettant de stocker l' affichage dans la variable $data suivante :
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Chargement de certificat
curl_setopt_array($curl, [
    CURLOPT_CAINFO          => __DIR__ . '/certificates/GTS CA 1C3.crt',
    CURLOPT_RETURNTRANSFER  => true,
    CURLOPT_TIMEOUT         => 1 // permet de dire au server si en 1 second pas de resultat alors abandone
]);


// Execution de cURL et obtenir les donnees
$data = curl_exec($curl);


// Traitement des donnees obtenues
if ($data === false) {

    var_dump(curl_error($curl));

} else {

    // var_dump(curl_getinfo($curl, CURLINFO_HTTP_CODE));

    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($statusCode === 200) {

        // Decode les donnees
        $data = json_decode($data, true);

        echo "<strong>{$data['main']['temp']}</strong>";

        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

// Fermer cURL
curl_close($curl);



// api.openweathermap.org/data/2.5/weather?q=Moscow
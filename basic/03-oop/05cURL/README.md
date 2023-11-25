$ php -S localhost:8000 -t guestbook -d error_reporting=E_ALL


https://openweathermap.org/api
https://openweathermap.org/current


```php
<?php


// Initialisation de cURL
$curl = curl_init('https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22');


// Desactiver la verification SSL (Deconseiller de faire cela, la meilleur methode est de telecharger un certificat)
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


// Chargement de certificat
curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . '/certificates/GTS CA 1C3.crt');



// Option permettant de stocker l' affichage dans la variable $data suivante :
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);



// Execution de cURL et obtenir les donnees
$data = curl_exec($curl);


// Traitement des donnees obtenues
if ($data === false) {
    var_dump(curl_error($curl));
} else {
    $data = json_decode($data, true);

    echo "<strong>{$data['main']['temp']}</strong>";

    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

// Fermer cURL
curl_close($curl);

```
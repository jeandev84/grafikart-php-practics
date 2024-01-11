<?php

use Grafikart\Exceptions\CurlException;
use Grafikart\Exceptions\UnauthorizedHTTPException;

require_once 'Exception/CurlException.php';
require_once 'Exception/HTTPException.php';
require_once 'Exception/UnauthorizedHTTPException.php';


// https://docs.phpdoc.org/references/phpdoc/basic-syntax.html

/**
 * Gere l'API d'OpenWeather
 *
 * @author Jean-Claude <john@klod.fr>
 * @OpenWeather
*/
class OpenWeather
{


       /**
        * @var string
       */
       private $apiKey;



       /**
        * OpenWeather constructor
        *
        * @param string $apiKey
       */
       public function __construct(string $apiKey)
       {
            $this->apiKey = $apiKey;
       }




       /**
         * Recupere les informations meteorologiques du jour
         *
         * @param string $city  Ville (ex: Monpellier,fr)
         *
         * @return array
         *
         * @throws Exception
       */
       public function getToday(string $city): ?array
       {
            $data = $this->callAPI("weather?q={$city}");

            return [
                'temp'        => $data['main']['temp'],
                'description' => $data['weather'][0]['description'],
                'date'        => new DateTime()
            ];
       }



       /**
        * Recupere les previsions sur plusieurs jours
        *
        * @param string $city
        *
        * @return null|array[]
        *
        * @throws Exception
       */
       public function getForecast(string $city): ?array
       {
            $data = $this->callAPI("forecast?q={$city}");

            $results = [];

            foreach ($data['list'] as $day) {
                $results[] = [
                    'temp'        => $day['main']['temp'],
                    'description' => $day['weather'][0]['description'],
                    'date'        => new DateTime('@'. $day['dt'])
                ];
            }

            return $results;
       }



      /**
        * Appelle l' API Open weather
        *
        * @param string $endpoint Action a appeler  (weather, weather/forecast)
        *
        * @return array|null
        *
        * @throws CurlException Curl a rencontre une erreure
        * @throws UnauthorizedHTTPException
        * @throws HTTPException
       */
       private function callAPI(string $endpoint): ?array
       {
           $curl = curl_init("https://api.openweathermap.org/data/2.5/{$endpoint}&appid={$this->apiKey}&units=metric&lang=fr");

           curl_setopt_array($curl, [
               CURLOPT_RETURNTRANSFER  => true,
               CURLOPT_CAINFO          => realpath(dirname(__DIR__) .'/certificates/firefox.crt') ,
               CURLOPT_TIMEOUT         => 1 // permet de dire au server si en 1 second pas de resultat alors abandone
           ]);

           $data = curl_exec($curl);

           if ($data === false) {
               /*
                $error = curl_error($curl);
                curl_close($curl);
                throw new APIException($error);
               */
               throw new CurlException($curl);
           }


           $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

           if ($statusCode !== 200) {
               curl_close($curl);

               if ($statusCode === 401) {
                  throw new UnauthorizedHTTPException($data['message'], 401);
               }

               throw new HTTPException($data);
           }

           curl_close($curl);
           return json_decode($data, true);
       }
}
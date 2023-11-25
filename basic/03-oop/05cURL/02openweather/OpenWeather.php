<?php


/**
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
        * Get forecast
        *
        * @param string $city
        * @return null|array
        * @throws Exception
       */
       public function forecast(string $city): ?array
       {
            $curl = curl_init("https://api.openweathermap.org/data/2.5/forecast?q={$city}&appid={$this->apiKey}&units=metric&lang=fr");

            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_CAINFO          => realpath(dirname(__DIR__) .'/certificates/firefox.crt') ,
                CURLOPT_TIMEOUT         => 1 // permet de dire au server si en 1 second pas de resultat alors abandone
            ]);

            $data = curl_exec($curl);

            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            if ($data === false || $statusCode !== 200) {
                return null;
            }


            $results = [];
            $data = json_decode($data, true);

            foreach ($data['list'] as $day) {
                $results[] = [
                    'temp'        => $day['temp']['day'],
                    'description' => $day['weather'][0]['description'],
                    'date'        => new DateTime('@'. $day['dt'])
                ];
            }

            return $results;
       }
}
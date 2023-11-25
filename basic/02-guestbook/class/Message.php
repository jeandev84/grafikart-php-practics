<?php


/**
 * @Message
*/
class Message
{


      const LIMIT_USERNAME = 3;
      const LIMIT_MESSAGE  = 10;


      /**
        * @var string
      */
      private $username;



      /**
       * @var string
      */
      private $message;




      /**
       * @var DateTime
      */
      private $date;



      /**
       * @param string $username
       * @param string $message
       * @param DateTime|null $date
      */
      public function __construct(string $username, string $message, ?DateTime $date = null)
      {
            $this->username = $username;
            $this->message  = $message;
            $this->date     = $date ?: new DateTime();
      }



      /**
       * Determine if message is valid
       *
       * @return bool
      */
      public function isValid(): bool
      {
           /* return strlen($this->username) >= 3 && strlen($this->message) >= 10; */

           return empty($this->getErrors());
      }




      /**
        * Get errors messages
        *
        * @return array
      */
      public function getErrors(): array
      {
            $errors = [];

            if (strlen($this->username) < self::LIMIT_USERNAME) {
                $errors['username'] = 'Votre pseudo est trop court';
            }

            if (strlen($this->message) < self::LIMIT_MESSAGE) {
                $errors['message']  = 'Votre message est trop court';
            }

            return $errors;
      }




      /**
        * Method encoding message
        *
        * @return string
      */
      public function toJSON(): string
      {
           return json_encode([
               'username' => $this->username,
               'message'  => $this->message,
               'date'     => $this->date->getTimestamp(), // timestamp()
           ]);
      }



      public function toHTML(): string
      {
          $this->date->setTimezone(new DateTimeZone('Europe/Moscow'));

          $username  = htmlentities($this->username);
          $date      = $this->date->format('d/m/Y a H:i');
          $message   = nl2br(htmlentities($this->message));

          return <<<HTML
             <p>
               <strong>{$username}</strong> <em>le $date</em>
             </p>
             <p>$message</p>
HTML;

      }




      /**
       * @param string $json
       * @return Message
       * @throws Exception
      */
      public static function fromJSON(string $json): Message
      {
           $data = json_decode($json, true);

           return new self($data['username'], $data['message'], new DateTime("@". $data['date']));
      }
}
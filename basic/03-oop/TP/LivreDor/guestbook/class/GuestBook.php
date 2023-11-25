<?php
require_once 'Message.php';

/**
 * @GuestBook
*/
class GuestBook
{


     /**
      * @var string
     */
     protected $messageFile;




     /**
      * @param string $messageFile
     */
     public function __construct(string $messageFile)
     {
          $directory = dirname($messageFile);

          if (! is_dir($directory)) {
              @mkdir($directory, 0777, true);
          }

          if (! file_exists($messageFile)) {
              touch($messageFile);
          }

          $this->messageFile = $messageFile;
     }




     /**
      * @param Message $message
      * @return void
     */
     public function addMessage(Message $message)
     {
          file_put_contents($this->messageFile, $message->toJSON() . PHP_EOL, FILE_APPEND);
     }




     public function getMessages(): array
     {
         $content = trim(file_get_contents($this->messageFile));
         $lines   = explode(PHP_EOL, $content);

         $messages = [];

         foreach ($lines as $line) {
             $messages[] = Message::fromJSON($line);
         }

         return array_reverse($messages);
     }



     /**
      * Make Datetime with timezone
      *
      * @param string $date
      * @return DateTime
      * @throws Exception
     */
     protected function makeDT(string $date): DateTime
     {
         $datetime = new DateTime("@". $date);
         // $datetime->getTimestamp(); par default == UTC
         $datetime->setTimezone(new DateTimeZone('Europe/Moscow'));
         // $formattedDate = $datetime->format('H:i:s');

         return $datetime;
     }
}
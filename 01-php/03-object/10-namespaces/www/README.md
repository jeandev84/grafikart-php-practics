## Livre d'or

- On aura une page avec un formulaire
   - Un champs pour le nom d'utilisateur
   - Un champs message
   - Un bouton
   (le formulaire devra être validé et on n'acceptera pas les pseudo de moins de 3 caractères ni les messages de moins de 10 caractères)
- On créera un fichier "messages" qui contiendra un message par ligne 
(on utilisera serialize et un tableau ['username' => '....', 'message' => '....', 'date' => ])
    - Pour "serialiser" les messages on utilisera les fonctions json_encode(tableau) et json_decode(tableau, true)
- La page devra afficher tous les messages sous le formulaire formaté de la manière suivante
<p>
    <strong>Pseudo</strong> <em>le 03/12/2009 à 12h00</em><br>
    Le message
</p>
(les sauts de lignes devront être conservés nl2br)

## Restriction

- Utiliser une classe pour représenter un Message, 
    - new Message(string $username, string $message, DateTime $date = null)
    - isValid(): bool
    - getErrors(): array
    - toHTML(): string
    - toJSON(): string
    - Message::fromJSON(string): Message
- Utiliser une classe pour représenter le livre d'or
    - new GuestBook($fichier)
    - addMessage(Message $message)
    - getMessages(): array
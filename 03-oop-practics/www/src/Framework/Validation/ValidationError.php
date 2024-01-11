<?php
declare(strict_types=1);

namespace Framework\Validation;


/**
 * Created by PhpStorm at 05.12.2023
 *
 * @ValidationError
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @package Framework\Validation
 */
class ValidationError
{

      /**
       * @var string
      */
      protected string $key;


      /**
       * @var string
      */
      protected string $rule;


      /**
       * @var array
      */
      protected array $attributes = [];



      /**
       *  @var array
      */
      protected array $messages = [
          'required'      => 'Le champs %s est requis',
          'empty'         => 'Le champs %s ne peut etre vide',
          'slug'          => "Le champs %s n'est pas un slug valide",
          'minLength'     => "Le champs %s doit contenir plus de %d caracteres",
          'maxLength'     => "Le champs %s doit contenir moins de %d caracteres",
          'betweenLength' => "Le champs %s doit contenir entre %d et %d caracteres",
          'datetime'      => "Le champs %s doit etre une date valide (%s)",
          'exists'        => "Le champs %s n' existe pas sur dans la table %s",
          'unique'        => "Le champs %s doit etre unique",
          'filetype'      => "Le champs %s n'est pas au format valide (%s)",
          'uploaded'      => "Vous devez telecharger un fichier",
          'email'         => "Cet email ne semble pas valide",
          'confirm'       => "Vous n' avez pas confirme le champs %s",
          'numeric'       => ""
      ];





      /**
       * @param string $key
       *
       * @param string $rule
       *
       * @param array $attributes
      */
      public function __construct(string $key, string $rule, array $attributes = [])
      {
          $this->key = $key;
          $this->rule = $rule;
          $this->attributes = $attributes;
      }




      /**
       * @return string
      */
      public function __toString(): string
      {
           if (! array_key_exists($this->rule, $this->messages)) {
               return "Le champs {$this->key} ne correspond pas a la regle {$this->rule}";
           } else {
               $params = array_merge([$this->messages[$this->rule], $this->key], $this->attributes);
               return (string)call_user_func_array('sprintf', $params);
           }
      }
}
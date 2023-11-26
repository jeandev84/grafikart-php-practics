<?php
declare(strict_types=1);


/**
 * Created by PhpStorm at 26.11.2023
 *
 * @AuthTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
*/
class AuthTest extends \PHPUnit\Framework\TestCase
{

      protected \App\Auth $auth;


      protected array $session = [];


      /**
       * @before
      */
      public function setAuth()
      {
          $pdo = new PDO("sqlite::memory", null, null, [
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
              PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
          ]);

          #$pdo->exec("DROP TABLE users");
          $pdo->query('CREATE TABLE IF NOT EXISTS users (id INTEGER, username TEXT, password TEXT, role TEXT)');

          for ($i = 1; $i <= 10; $i++) {
              $password = password_hash("user$i", PASSWORD_BCRYPT);
              $pdo->query("INSERT INTO users (id, username, password, role) VALUES ('$i', 'user$i', '$password', 'user$i')");
          }

          $this->auth = new \App\Auth($pdo, "/login", $this->session);
      }



       public function testLoginWithBadUsername()
       {
           $this->assertNull($this->auth->login('aze', 'aze'));
       }



      public function testLoginWithBadPassword()
      {
          $this->assertNull($this->auth->login('user1', 'aze'));
       }




       public function testLoginSuccess()
       {
            $this->assertObjectHasAttribute("username", $this->auth->login('user1', 'user1'));
            $this->assertEquals(1, $this->session['auth']);
       }



       public function testUserWhenNotConnected()
       {
            $this->assertNull($this->auth->user());
       }



      public function testUserWhenConnectedWithUnexitingUser()
      {
          $this->session['auth'] = 11;
           $this->assertNull($this->auth->user());
      }



    public function testUserWhenConnected()
    {
        $this->session['auth'] = 4;
        $user = $this->auth->user();
        $this->assertIsObject($user);
        $this->assertEquals("user4", $user->username);
    }




    public function testIsGranted()
    {
        $this->session['auth'] = 2;
        $this->auth->isGranted('user2');

        $this->expectNotToPerformAssertions();
    }



    public function testIsGrantedWithoutLoginThrowException()
    {
        $this->expectException(App\Exception\ForbiddenException::class);
        $this->auth->isGranted('user3');
    }



    public function testIsGrantedThrowException()
    {
        $this->expectException(App\Exception\ForbiddenException::class);
        $this->session['auth'] = 2;
        $this->auth->isGranted('user3');
    }
}
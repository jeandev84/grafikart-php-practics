<?php
namespace App;

use App\Exception\ForbiddenException;
use PDO;

class Auth {

    private $pdo;

    private $loginPath;


    private array $session;


    public function __construct(PDO $pdo, string $loginPath, array &$session)
    {
        $this->pdo = $pdo;
        $this->loginPath = $loginPath;
        $this->session   = &$session;
    }

    public function user(): ?User
    {
        $id = $this->session['auth'] ?? null;
        if ($id === null) {
            return null;
        }
        $query = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $query->execute([$id]);
        $user = $query->fetchObject(User::class);
        return $user ?: null;
    }

    public function isGranted(string ...$roles): void
    {
        $user = $this->user();
        if ($user === null) {
             throw new ForbiddenException("You must be to connect for viewing this page.");
        }

        if (!in_array($user->role, $roles)) {
            $roles = join(',', $roles);
            $role  = $user->role;
            throw new ForbiddenException("You have not the permission \"$role\" in ($roles).");
        }
    }

    public function login(string $username, string $password): ?User
    {
        // Trouve l'utilisateur correspondant au username
        $query = $this->pdo->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute(['username' => $username]);
        $user = $query->fetchObject(User::class);
        if ($user === false) {
            return null;
        }

        // On vérifie password_verify que l'utilisateur corresponde
        if (password_verify($password, $user->password)) {
            $this->session['auth'] = $user->id;
            return $user;
        }
        return null;
    }

}
<?php 
declare(strict_types=1);
namespace App;


class Validator {
    public function email(string $email):string {
        if(empty($email)) return "Pole jest wymagane";
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) return "Nie poprawny format e-mail";
        return "";
    }

    public function userExist(int $numberOfUsers): string {
        if($numberOfUsers !== 0 ) return "Uzytkownik z takim e-mail juz istnieje";
        return "";
    }

    public function username(string $username):string {
        if(empty($username)) return "Pole jest wymagane";
        elseif(!preg_match("/^[a-zA-Z ]*$/", $username))return "Pole moze zawierać tylko Litery i spacje";
        return "";
    } 

    public function checkPassword(string $password):string {
        if(empty($password)) return "Pole jest wymagane";
        elseif(!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) return "Hasło musi zawierać min 1 duzą litere i min 1 cyfre";
        return "";
    }

    public function confirmPassword(string $password, string $confirm_password):string {
        if($confirm_password !== $password) return "Hasła nie są takie same";
        return "";
    }
}
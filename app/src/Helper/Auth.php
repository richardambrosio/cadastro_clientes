<?php

namespace App\Helper;

use App\DB\Sql;
use App\Model\Cliente;

class Auth {
    public static function login ($login, $password) {
        $sql = new Sql();
        $results = $sql->select("SELECT * FROM cliente WHERE login = :login", array(":login" => $login));

        if (count($results) === 0) throw new \Exception("Usuário inexistente ou senha inválida.");

        $data = $results[0];

        if (password_verify($password, $data['senha'])) {
            $cliente = new Cliente();
            $cliente->setData($data);
            
            $_SESSION[Cliente::SESSION] = $cliente->getValues();
        } else {
            throw new \Exception("Usuário inexistente ou senha inválida.");
        }
    }

    public static function logout() {
        $_SESSION[Cliente::SESSION] = null;
    }

    public static function checkLogin()
	{
		if (!isset($_SESSION[Cliente::SESSION]) ||
			!$_SESSION[Cliente::SESSION] ||
			!(int)$_SESSION[Cliente::SESSION]["id_cliente"] > 0
		) {
			return false;
		} else {
			return true;
		}
	}

    public static function verifyLogin()
	{
		if (!Auth::checkLogin()) {
            header("Location: /login");
            exit;
        }
	}

	public static function getPasswordHash($password):string {
		return password_hash($password, PASSWORD_DEFAULT, [
            'cost' => 12
        ]);
	}
}
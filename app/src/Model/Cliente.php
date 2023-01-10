<?php

namespace App\Model;

use App\Pagination;
use App\DB\Sql;
use App\Helper\Feedback;

class Cliente extends Model{
    public const SESSION = 'Cliente';

    public static function save(array $data): bool {
        if (isset($data['id_cliente'])) return Cliente::update($data);
        else return Cliente::insert($data);
    }

    public static function insert(array $data): bool {
        $data['telefone'] = Cliente::stripData($data['telefone']);
        $data['cep'] = Cliente::stripData($data['cep']);

        $insert = (new Sql)->insert('cliente', $data);

        if ($insert) {
            Feedback::setMsg('Cadastro efetuado com sucesso.', 'success');
            return true;
        } else {
            Feedback::setMsg('Houve um erro ao efetuar o cadastro.', 'danger');
            return false;
        }
    }
    public static function update(array $data): bool {
        $data['telefone'] = Cliente::stripData($data['telefone']);
        $data['cep'] = Cliente::stripData($data['cep']);
        $data['dt_atualizacao'] = date('Y-m-d H:i:s');

        $update = (new Sql)->update('cliente', $data);

        if ($update) {
            Feedback::setMsg('Cadastro alterado com sucesso.', 'success');
            return true;
        } else {
            Feedback::setMsg('Houve um erro ao alterar o cadastro.', 'danger');
            return false;
        }
    }

    public static function delete(int $id): bool {
        $delete = (new Sql)->delete('cliente', $id);

        if ($delete) {
            Feedback::setMsg('Cadastro removido com sucesso.', 'success');
            return true;
        } else {
            Feedback::setMsg('Houve um erro ao remover o cadastro.', 'danger');
            return false;
        }
    }

    public function get(int $id) {
        $sql = new Sql();

        $results = $sql->select("SELECT *
            FROM cliente
            WHERE id_cliente = :idcliente;
        ", array(
            ":idcliente" => $id
        ));

        $this->setData($results[0]);
    }

    public static function listAll() {
        $sql = new Sql();

        $rawQuery = "SELECT * FROM cliente ORDER BY nome";

        if (Pagination::verifySessionPagination()) {
            return ['query' => $rawQuery, 'args' => []];
        }

        return $sql->select($rawQuery);
    }

    public static function stripData($data) {
        $newData = preg_replace('/[^0-9]/', "", $data);
        return $newData;
    }
}
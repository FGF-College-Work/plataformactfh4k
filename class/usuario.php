<?php

class usuario extends Conexao {

    private $user_id;

    public function setUser($user_id) {
        $this->user_id = htmlentities($user_id);
    }

    public function getUser() {
        return $this->user_id;
    }

    public function atualizaNome($username) {
        $username = htmlentities($username);
        $pdo = parent::getDB();
        $dados = "UPDATE sr_usuarios_secret SET username='$username' WHERE id='$this->user_id'";
        if ($pdo->query($dados)):
            $_SESSION['username'] = $username;
            return true;
        else:
            return false;
        endif;
    }

    public function carregaNomeTeam() {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT team.nome FROM sr_usuarios_secret, team WHERE sr_usuarios_secret.idteam = team.idteam and sr_usuarios_secret.Id = ? LIMIT 1');
        $valida->bindValue(1, $this->getUser());
        $valida->execute();
        $dados = $valida->fetch(PDO::FETCH_OBJ);
        if ($valida->rowCount() > 0):
            echo $dados->nome;
        endif;
    }

    public function totalFlagResolvidas() {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT count(flagid) as total FROM resolvidas WHERE userid = ?');
        $valida->bindValue(1, $this->getUser());
        $valida->execute();
        $dados = $valida->fetch(PDO::FETCH_OBJ);
        if ($valida->rowCount() > 0):
            echo $dados->total;
        endif;
    }

    public function totalEventos() {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT count(iduser) as total FROM score WHERE iduser = ?');
        $valida->bindValue(1, $this->getUser());
        $valida->execute();
        $dados = $valida->fetch(PDO::FETCH_OBJ);
        if ($valida->rowCount() > 0):
            echo $dados->total;
        endif;
    }

    public function totalPontos() {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT sum(score) as total FROM score WHERE iduser = ?');
        $valida->bindValue(1, $this->getUser());
        $valida->execute();
        $dados = $valida->fetch(PDO::FETCH_OBJ);
        if ($valida->rowCount() > 0):
            echo $dados->total;
        endif;
    }
    
    public function alterarSenha($p) {
        $password = htmlentities($p);
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        $password = hash('sha512', $password . $random_salt);
        $pdo = parent::getDB();
        $enter = $pdo->prepare('UPDATE sr_usuarios_secret set password = ?, salt = ? where id=?');
        $enter->bindValue(1, $password);
        $enter->bindValue(2, $random_salt);
        $enter->bindValue(3, $this->user_id);
        $enter->execute();
        if ($enter->rowCount() > 0):
            return true;
        else:
            return false;
        endif;
    }

}

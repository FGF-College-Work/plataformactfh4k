<?php

class team extends usuario {

    private $user_id;

    public function setUser($user_id) {
        $this->user_id = htmlentities($user_id);
    }

    public function getUser() {
        return $this->user_id;
    }

    public function inserenewTeam($teamName) {
        $pdo = parent::getDB();
        $hash = md5($teamName . '' . date('Y-m-d H:i:s'));
        $dados = "INSERT INTO team (nome,hash,adm) VALUES ('$teamName','$hash','$this->user_id')";
        $result = $pdo->query($dados);
        if (!$result) {
            return false;
        } else {
            $ultimoid = $pdo->lastInsertId();
            $dados = "UPDATE sr_usuarios_secret SET idteam='$ultimoid' WHERE id='$this->user_id'";
            $pdo->query($dados);
            return true;
        }
    }

    public function carregaHashTeam() {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT team.hash FROM sr_usuarios_secret, team WHERE sr_usuarios_secret.idteam = team.idteam and sr_usuarios_secret.Id = ?');
        $valida->bindValue(1, $this->getUser());
        $valida->execute();
        $dados = $valida->fetch(PDO::FETCH_OBJ);
        if ($valida->rowCount() > 0):
            echo $dados->hash;
        endif;
    }

    public function enterTeam($teamhash) {
        $pdo = parent::getDB();
        $enter = $pdo->prepare('SELECT idteam,nome FROM team WHERE hash = ?');
        $enter->bindValue(1, $teamhash);
        $enter->execute();
        $dados = $enter->fetch(PDO::FETCH_OBJ);
        if ($enter->rowCount() > 0):
            $sqlteam = "UPDATE sr_usuarios_secret SET idteam='$dados->idteam' WHERE id='$this->user_id'";
            $pdo->query($sqlteam);
            return true;
        else:
            return false;
        endif;
    }

    

}

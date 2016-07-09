<?php

class Login extends Conexao {

    private $login;
    private $senha;

    #seta login

    public function setLogin($login) {
        $this->login = $login;
    }

    #seta Senha

    public function setSenha($senha) {
        $this->senha = hash('sha512', $senha);
    }

    #pega login

    public function getLogin() {
        return $this->login;
    }

    #pega senha

    public function getSenha() {
        return $this->senha;
    }

    # logar

    public function logar() {
        $pdo = parent::getDB();
        $logar = $pdo->prepare('SELECT id, username, password, salt, idteam 
        FROM sr_usuarios_secret
		WHERE email = ?
        LIMIT 1');
        $logar->bindValue(1, $this->getLogin());
        $logar->execute();
        $dados = $logar->fetch(PDO::FETCH_OBJ);
        $password = hash('sha512', $this->getSenha() . $dados->salt);
        if ($logar->rowCount() == 1):
            if ($dados->password == $password):
                // Obtém o string usuário-agente do usuário. 
                $user_browser = $_SERVER['HTTP_USER_AGENT'];
                // proteção XSS conforme imprimimos este valor
                $user_id = preg_replace("/[^0-9]+/", "", $dados->id);
                $id_team = preg_replace("/[^0-9]+/", "", $dados->idteam);
                $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $dados->username);
                //cria a Sessão
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['idteam'] = $id_team;
                $_SESSION['login_string'] = hash('sha512', $password . $user_browser);
                // Login concluído com sucesso.
                $this->insereLog($user_id);
                return true;
            endif;
        else:
            return false;
        endif;
    }
    
     private function insereLog($user_id) {
        $pdo = parent::getDB();
        $ip = $_SERVER["REMOTE_ADDR"];
        $sql = "INSERT INTO log (iduser,ip,acesso) VALUES ('$user_id','$ip', NOW())";
        $pdo->query($sql);
    }

}

<?php

class ranking_team extends Conexao {
  
    private $evento;

    public function setEvento($evento) {
        $this->evento = htmlentities($evento);
    }

    #pega login

    public function getEvento() {
        return $this->evento;
    }
    
    
    public function getNomeEvento() {
        $pdo = parent::getDB();
        $logar = $pdo->prepare('select nome from evento where id = ? LIMIT 1');
        $logar->bindValue(1, $this->getEvento());
        $logar->execute();
        $dados = $logar->fetch(PDO::FETCH_OBJ);
        if ($logar->rowCount() > 0):
            return $dados->nome;
        else:
            return "Esse evento não existe!";
        endif;
    }
    
    public function listar() {
        $pdo = parent::getDB();
        $lista_score = $pdo->prepare("SELECT scoreteam.score,team.nome 
        FROM `scoreteam`, `team`
        WHERE scoreteam.idteam = team.idteam and scoreteam.evento= ? ORDER BY scoreteam.score DESC, time ASC
        ");
        $lista_score->bindvalue(1, $this->getEvento());
        $lista_score->execute();
        $i = 1;
        while ($linha = $lista_score->fetch(PDO::FETCH_NUM)) {
            // aqui eu mostro os valores de minha consulta
            echo'<tr>';
            echo'<td><strong><center><h4>' . $i++ . 'º</h4></strong></center></td>';
            echo'<td><strong><center><h4>' . $linha[1] . '</h4></strong></center></td>';
            echo'<td><center><button type="button" class="btn btn-blue">' . $linha[0] . '</button></center></td>';
            echo'</tr>';
        }
    }
    
    

}

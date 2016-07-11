<?php

class flags_class extends Conexao {

    private $flagid;
    private $resposta;
    private $evento;
    private $dados;
  

    public function setEvento($evento) {
        $this->evento = htmlentities($evento);
    }

    public function getEvento() {
        return $this->evento;
    }
    
    public function setResposta($resposta) {
        $this->resposta = $resposta;
    }

    public function getResposta() {
        return $this->resposta;
    }
    
    public function setFlagid($flagid) {
        $this->flagid = htmlentities($flagid);
    }

    public function getFlagid() {
        return $this->flagid;
    }
    
    public function insereScore($user_id,$idteam) {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT id FROM evento WHERE id = ?');
        $valida->bindValue(1, $this->getEvento());
        $valida->execute();
        if ($valida->rowCount() > 0):
            $valida_score = $pdo->prepare('SELECT score FROM score WHERE iduser = ? and evento = ?');
            $valida_score->bindValue(1, $user_id);
            $valida_score->bindValue(2, $this->getEvento());
            $valida_score->execute();
            if ($valida_score->rowCount() > 0):
                
            else:
                $insere_score = $pdo->prepare("INSERT INTO score (score,iduser,time,evento) VALUES ('0', ? ,NOW(), ?)");
                $insere_score->bindValue(1, $user_id);
                $insere_score->bindValue(2, $this->getEvento());
                $insere_score->execute();
                $this->scoreTeam($idteam);
            endif;
            
        endif;
    }
    
    public function scoreTeam($idteam){
        $pdo = parent::getDB();
        $valida_score_t = $pdo->prepare('SELECT idteam FROM scoreteam WHERE idteam = ? and evento = ?');
        $valida_score_t->bindValue(1, $idteam);
        $valida_score_t->bindValue(2, $this->getEvento());
        $valida_score_t->execute();
        if ($valida_score_t->rowCount() > 0):
            
        else:
            $insere_score = $pdo->prepare("INSERT INTO scoreteam (score,idteam,time,evento) VALUES ('0',?,NOW(), ?)");
            $insere_score->bindValue(1, $idteam);
            $insere_score->bindValue(2, $this->getEvento());
            $insere_score->execute();
        endif;
    }

    public function validaFlag($user_id, $idteam) {
        $pdo = parent::getDB();
        $valida = $pdo->prepare('SELECT resposta, valor, (SELECT idteam FROM sr_usuarios_secret WHERE id = ?) AS idteam FROM flag WHERE idflag = ? LIMIT 1');
        $valida->bindValue(1, $user_id);
        $valida->bindValue(2, $this->getFlagid());
        $valida->execute();
        $dados = $valida->fetch(PDO::FETCH_OBJ);
        if ($valida->rowCount() > 0):
            if ($dados->resposta == $this->resposta):
                //insere na tabela resolvidas
                $insere_resolvidas = $pdo->prepare("INSERT INTO resolvidas (flagid,userid,idteam,valor,evento, dhresposta) VALUES (?, ?, ?, ?, ?, NOW())");
                $insere_resolvidas->bindValue(1, $this->getFlagid());
                $insere_resolvidas->bindValue(2, $user_id);
                $insere_resolvidas->bindValue(3, $idteam);
                $insere_resolvidas->bindValue(4, $dados->valor);
                $insere_resolvidas->bindValue(5, $this->getEvento());
                $insere_resolvidas->execute();
                //atualiza o score individual 
                $atualiza_resolvidas = $pdo->prepare("UPDATE score SET score=(SELECT sum(valor) as valor FROM resolvidas WHERE userid= ? and evento= ?), time=NOW() WHERE iduser= ? and evento= ?");
                $atualiza_resolvidas->bindValue(1, $user_id);
                $atualiza_resolvidas->bindValue(2, $this->getEvento());
                $atualiza_resolvidas->bindValue(3, $user_id);
                $atualiza_resolvidas->bindValue(4, $this->getEvento());
                $atualiza_resolvidas->execute();
                //verifica se o team já respondeu o chall
                $verifica_team = $pdo->prepare('SELECT id FROM resolvidas WHERE flagid = ? and idteam = ? and evento = ?');
                $verifica_team->bindValue(1, $this->getFlagid());
                $verifica_team->bindValue(2, $idteam);
                $verifica_team->bindValue(3, $this->getEvento());
                $verifica_team->execute();
                if ($verifica_team->rowCount() == 1):
                    //consulta score atual do team
                    $score_team = $pdo->prepare('SELECT score FROM scoreteam WHERE idteam = ? and evento = ?');
                    $score_team->bindValue(1, $idteam);
                    $score_team->bindValue(2, $this->getEvento());
                    $score_team->execute();
                    $dados_score = $score_team->fetch(PDO::FETCH_OBJ);
                    //atualiza score team
                    $atualiza_scoreteam = $pdo->prepare("UPDATE scoreteam SET score='$dados_score->score'+'$dados->valor', time=NOW() WHERE idteam= ? and evento= ? ");
                    $atualiza_scoreteam->bindValue(1, $idteam);
                    $atualiza_scoreteam->bindValue(2, $this->getEvento());
                    $atualiza_scoreteam->execute();
                   endif;
                //fazendo tudo isso ai acima retorna true
                return true;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    public function getScore($user_id) {
        $pdo = parent::getDB();
        $score = $pdo->prepare('SELECT score FROM score WHERE iduser = ? and evento = ? LIMIT 1');
        $score->bindValue(1, $user_id);
        $score->bindValue(2, $this->getEvento());
        $score->execute();
        $dados = $score->fetch(PDO::FETCH_OBJ);
        if ($score->rowCount() > 0):
            return $dados->score;
        endif;
    }

    public function listaTipoFlags() {
        $pdo = parent::getDB();
        $lista_tipo_flags = $pdo->prepare('SELECT DISTINCT tipo FROM flag WHERE evento = ?');
        $lista_tipo_flags->bindvalue(1, $this->getEvento());
        $lista_tipo_flags->execute();
        $i = 0;
        while ($linha = $lista_tipo_flags->fetch(PDO::FETCH_NUM)) {
            echo "<th><center>{$linha[0]}</center></th>";
            $this->dados[$i++] = $linha[0];
        }
    }

    public function carregaBotoes($user_id) {
        for ($i = 0; $i < count($this->dados); $i++) {
            $pdo = parent::getDB();
            $lista_botoes = $pdo->prepare('SELECT flag.idflag, flag.valor, (select resolvidas.id from resolvidas where resolvidas.flagid = flag.idflag and resolvidas.userid = ? ) as respondida FROM flag WHERE flag.tipo = ? and flag.evento = ?');
            $lista_botoes->bindvalue(1, $user_id);
            $lista_botoes->bindvalue(2, $this->dados[$i]);
            $lista_botoes->bindvalue(3, $this->getEvento());
            $lista_botoes->execute();
            echo "<td><center>";
            while ($linha = $lista_botoes->fetch(PDO::FETCH_NUM)) {
                if ($linha[2] > "") {
                    echo '<button type="button" class="btn btn-success" data-toggle="modal" data-target="">' . $linha[1] . '</button> ';
                } else {
                    echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#' . $this->dados[$i] . $linha[0] . '">' . $linha[1] . '</button> ';
                }
            }
            echo "</td></center>";
        }
    }

    public function carregaChall() {
        for ($i = 0; $i < count($this->dados); $i++) {
            $pdo = parent::getDB();
            $lista_chall = $pdo->prepare('SELECT idflag, titulo, descricao, titulo, valor FROM flag WHERE tipo = ? and evento = ?');
            $lista_chall->bindvalue(1, $this->dados[$i]);
            $lista_chall->bindvalue(2, $this->getEvento());
            $lista_chall->execute();
            while ($linha = $lista_chall->fetch(PDO::FETCH_NUM)) {
                echo '<div id="' . $this->dados[$i] . $linha[0] . '" class="modal fade" tabindex="-1">';
                echo '<div class="modal-dialog">';
                echo '<div class="vertical-alignment-helper">';
                echo '<div class="modal-content">';
                echo '<div class="modal-header">';
                echo '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
                echo '<h4 class="modal-title">' . $linha[1] . '</h4>';
                echo '</div>';
                echo '<div class="modal-body">';
                echo '<div class="row">';
                echo '<form action="" method="POST">';
                echo '<div class="col-md-12">';
                echo '<div class="form-group">';
                echo '<label>' . $linha[2] . '</label>';
                echo '</div>';
                echo '</div>';
                echo '<div class="col-md-5">';
                echo '<div class="form-group">';
                echo '<input type="input" class="form-control"  id="flag" name="flag">';
                echo '<input type="hidden" class="form-control"  id="order" name="order" value="' . $linha[0] . '">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="modal-footer">';
                echo '<button type="submit" class="btn btn-info">Enviar</button>';
                echo '</div>';
                echo '</form>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        }
    }

}

<?php

class Evento extends Conexao {
    
    public function listar(){
        $pdo = parent::getDB();
        $lista_eventos = $pdo->prepare('SELECT * FROM evento order by id DESC');
        $lista_eventos->execute();
        while ($linha = $lista_eventos->fetch(PDO::FETCH_NUM)) {
        // aqui eu mostro os valores de minha consulta
        echo "<tr class='odd gradeX'>";
	echo "<td>{$linha[1]}</td>";
	echo "<td>{$linha[2]}</td>";
	echo "<td>{$linha[3]}</td>";
	echo '<td><center><button type="button" onclick="window.location='."'flag.php?evento=$linha[0]'".'" class="btn btn-success">iniciar</button></center></td>';
	echo '<td><center><button type="button" onclick="window.location='."'score.php?evento=$linha[0]'".'" class="btn btn-danger">Ranking</button></center></td>';
        echo '<td><center><button type="button" onclick="window.location='."'score_team.php?evento=$linha[0]'".'" class="btn btn-warning">Ranking - Team</button></center></td>';
        echo "</tr>";
        }
    }
    
}

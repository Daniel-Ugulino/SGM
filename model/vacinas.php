<?php
class vacinas
{
    private $conexao;
    private $conn;

    public $id;
    public $fk;
    public $tipo;
    public $dose;

    private function __construct()
    {
        $this->conexao = new conexao_banco();
        $this->conn = $this->conexao->conectar();
    }

    public function getAll()
    {
        $stm = $this->conn->prepare("select * from vacinas");
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);;
    }
    public function getById()
    {
        $stm = $this->conn->prepare("select id_vacinas,tipo,dose,data from relatorio_funcionario r LEFT JOIN vacinas vac on r.fk_vacina = vac.id_vacinas where r.fk_funcionario = :id");
        $stm->bindParam("id", $this->id);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);;
    }
    public function insert()
    {
        $stm = $this->conn->prepare("Insert into vacinas values(DEFAULT,:fk,:tipo,:dose,now();");
        $stm->bindParam("fk", $this->fk);
        $stm->bindParam("tipo", $this->tipo);
        $stm->bindParam("dose", $this->dose);
        return $stm->execute();
    }
    public function update($column, $data)
    {
        $stm = $this->conn->prepare("Update vacinas set :column = (:data) where id_vacinas = (:id)");
        $stm->bindParam("column", $column);
        $stm->bindParam("data", $data);
        $stm->bindParam("id", $this->id);
        return $stm->execute();
    }
    function delete()
    {
    }
}
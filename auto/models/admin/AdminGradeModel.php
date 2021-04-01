<?php 
class AdminGradeModel extends Driver{

    public function getGrades(){

        $sql = "SELECT * FROM grade ORDER BY id_g DESC";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        //orm
        $tabGrade = [];

        foreach ($rows as $row) {
            $grade = new Grade();
            $grade->setId_g($row->id_g);
            $grade->setNom_g($row->nom_g);
            array_push($tabGrade, $grade);
        }
        return $tabGrade;
    }

    public function deleteGrade($id){
        $sql  = "DELETE FROM grade WHERE id_g = :id";
        $result = $this->getRequest($sql, ['id'=>$id]);
        $nb = $result->rowCount();
        return $nb;
    }
}
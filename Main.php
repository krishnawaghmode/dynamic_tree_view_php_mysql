<?php
include "db_config.php";
class Main
{
    //add Member
    public function addMember($parentid, $name)
    {
        try {
            global $pdo, $current_date;
            $sql =
                "INSERT INTO `members`(`createdate`, `name`, `parentid`) VALUES (?,?,?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$current_date, $name, $parentid]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getParentList()
    {
        try {
            global $pdo;
            $sql = "SELECT * FROM members";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $output = '<option value="">Parent</option>';

            foreach ($result as $row) {
                $output .=
                    '<option value="' .
                    $row["id"] .
                    '">' .
                    $row["name"] .
                    "</option>";
            }
            echo $output;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getList()
    {
        try {
            global $pdo;
            $sql = "SELECT * FROM members";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $arr = [];
            foreach ($result as $row) {
                $arr[$row["id"]]["name"] = $row["name"];
                $arr[$row["id"]]["parentid"] = $row["parentid"];
            }
            return $this->TreeView($arr, 0);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function TreeView($arr, $parent, $level = 0, $prelevel = -1)
    {
        foreach ($arr as $id => $data) {
            if ($parent == $data["parentid"]) {
                if ($level > $prelevel) {
                    echo "<ul>";
                }
                if ($level == $prelevel) {
                    echo "</li>";
                }
                echo "<li>" . $data["name"];
                if ($level > $prelevel) {
                    $prelevel = $level;
                }
                $level++;
                $this->TreeView($arr, $id, $level, $prelevel);
                $level--;
            }
        }
        if ($level == $prelevel) {
            echo "</li></ul>";
        }
    }
}

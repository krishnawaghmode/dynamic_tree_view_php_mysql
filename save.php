 <?php
 include "Main.php";
 $obj = new Main();
 //save
 if (isset($_POST["action"]) && $_POST["action"] == "save") {
     $parentid = empty($_POST["parentid"]) ? 0 : $_POST["parentid"];
     return $obj->addMember($parentid, $_POST["name"]);
 }
 //get parent list
 if (isset($_POST["action"]) && $_POST["action"] == "parent_list") {
     return $obj->getParentList();
 }
 //get list
 if (isset($_POST["action"]) && $_POST["action"] == "list") {
     return $obj->getList();
 }

?>

<?php
require_once "./Services/Database/classes/class.ilAuthContainerMDB2.php";
class ilTemplateModel
{
    /**
     * Returns all items available in the system.
     * @return bool
     */
    function getItems()
    {
        global $ilDB;
        $query = "SELECT * FROM dev_items";
        $set = $ilDB->query($query);

        while($row = $ilDB->fetchAssoc($set))
        {
            $res[] = $row;
        }
        return $res;
    }

    function getItem($item_id)
    {
        global $ilDB;
        $query = "SELECT * FROM dev_items WHERE id = $item_id";
        $set = $ilDB->query($query);

        while($row = $ilDB->fetchAssoc($set))
        {
            $res[] = $row;
        }
        return $res;
    }

    /**
     * Creates an item
     */
    function createItem($item_name, $description)
    {
        global $ilDB;
        //var_dump($item_name);
      
        $a_columns = array(
            "name" => array("text", $item_name),
            "description" => array("text", $description));
        $ilDB->insert("dev_items", $a_columns);
        return $ilDB->getLastInsertId();

    }


    /**
     * Updates an item
     * @param $id
     * @param $fieldname
     * @param $newval
     * @return mixed
     */
    public function updateItem($id, $fieldname, $newval)
    {
        global $ilDB;
        $sql = "UPDATE dev_items SET $fieldname = \"$newval\" WHERE id = $id";
        $numAffRows = $ilDB->manipulate($sql);
        return $numAffRows;
    }

    /**
     * Deletes an item entry.
     * @param $id
     * @return mixed
     */
    public function deleteItem($id)
    {
        global $ilDB;

        $sql = "DELETE FROM dev_items WHERE id =".$ilDB->quote($id, "integer");

        $numAffRows = $ilDB->manipulate($sql);

        return $numAffRows;
    }

}
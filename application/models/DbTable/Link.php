<?php

class Application_Model_DbTable_Link extends Zend_Db_Table_Abstract {

    protected $_name = 'links';

    function addLink($commentInfo) {
        $row = $this->createRow();
        $row->link = $commentInfo;

        return $row->save();
    }

    function listLinks() {
        return $this->fetchAll()->toArray();
    }

    function getLinksById($id) {
        return $this->fetchAll($this->select()->where('id=?', $id))->toArray();
    }

}

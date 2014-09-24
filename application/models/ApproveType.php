<?php

class Model_ApproveType extends Zend_Db_Table_Abstract
{

	protected $_name = 'approve_type';

	public function init(){
        parent::init();
	}

    public function getById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select);
    }

    public function getNameById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select)->name;
    }

	public function getAll(){
		$select = $this->select();
		$rows = $this->fetchAll($select);
		
		return $rows;
	}

    public function countAll(){
        $select = $this->select();
        $rows = $this->fetchRow($select);
        return count($rows);
    }


}


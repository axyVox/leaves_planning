<?php

class Model_UserType extends Zend_Db_Table_Abstract
{

	protected $_name = 'user_type';

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

    public function getIdByName($name) {
        $select = $this->select()->where('name = ?', $name);
        return $this->fetchRow($select)->id;
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


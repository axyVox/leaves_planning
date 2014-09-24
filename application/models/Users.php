<?php

class Model_Users extends Zend_Db_Table_Abstract
{

	protected $_name = 'users';

	public function init(){
        parent::init();
	}

    public function getById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select);
    }

    public function getUsernameById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select)->username;
    }

	/* All callers on the system */
	public function getAll(){

		$select = $this->select();
		
		$rows = $this->fetchAll($select);
		
		return $rows;
	}

    /* All callers on the system */
    public function countAll(){

        $select = $this->select();

        $rows = $this->fetchRow($select);

        return count($rows);
    }

    public function logInUser($username, $password){
        $select = $this->select()->where('username = ?', $username)->where('password = ?', $password);
        $row = $this->fetchRow($select);

        return $row;
    }

}


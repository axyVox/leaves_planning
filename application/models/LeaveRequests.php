<?php

class Model_LeaveRequests extends Zend_Db_Table_Abstract
{

	protected $_name = 'leave_requests';

	public function init(){
        parent::init();
	}

    public function getById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select);
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

    public function doSave($data, $id=null){
        if($id){
            return $this->update($data, array('id = ?' => (int)$id));
        }
        else{
            return $this->insert($data);
        }
    }


}


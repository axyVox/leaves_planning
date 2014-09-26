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

    public function getUserById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select)->user;
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

    public function doInsert($data){
        return $this->insert($data);

    }

    public function doUpdate($data){
        $id = $data['id'];
        unset($data['id']);

        return $this->update($data, array('id = ?' => (int)$id));
    }

    public function getRequestedWorkingDaysById($id) {
        $select = $this->select()->where('id = ?', (int) $id);

        $row= $this->fetchRow($select);
        $lib = new Lp_Dates();
        $working_days = $lib->countWorkingDays($row->from_date, $row->to_date);

        return $working_days;
    }

    public function getLeaveTypeById($id) {
        $select = $this->select()->where('id = ?', (int) $id);
        return $this->fetchRow($select)->leave_type;
    }

}


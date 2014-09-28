<?php

class AjaxController extends Lp_Controller_Base
{
    private $_leaves_requests_model;
    private $_user_model;
    private $_user;
    private $_max_allowed_days;

    public function init()
    {
        parent::init();

        if(!$this->isAdmin())
            $this->redirect('index');

        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $this->_leaves_requests_model = new Model_LeaveRequests();
        $this->_user_model = new Model_Users();
        $this->_user = array();
    }

    public function updateRequestAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam("id");
        $user_id = $this->_leaves_requests_model->getUserById($id);
        $approve_type = $request->getParam("approve_type");

        if ($this->automaticReject($approve_type, $user_id, $id))
            return false;

        $this->_user_model->doUpdate($this->_user);
        $return = $this->updateApproval($id, $approve_type);
        $confirm = $return > 0;
        $arr = array('success' => $confirm);

        $arrEncoded = json_encode($arr);
        $this->getResponse()->setBody($arrEncoded);

    }

    /**
     * @param $user_id
     * @param $id
     */
    private function automaticReject($approve_type, $user_id, $id)
    {
        $toApprove = Lp_ApproveType::isApproved($approve_type);
        $rejected = $this->isRejected($user_id, $id);

        return $toApprove && $rejected;
    }


    private function isRejected($user_id, $id)
    {
        $not_approval_message = null;

        $requested_days = $this->_leaves_requests_model->getRequestedWorkingDaysById($id);
        $leave_type = $this->_leaves_requests_model->getLeaveTypeById($id);

        list($already_used_days, $not, $all_used_days) = $this->calculateAbsentDays($user_id, $leave_type, $requested_days);

        $days_left = $this->_max_allowed_days - $all_used_days;
        if ($days_left < 0) {
            $not_approval_message = "Already approved $already_used_days $not paid days.";
            $not_approval_message .= " Requested $requested_days.";
            $not_approval_message .= " Maximim allowed absence is $this->_max_allowed_days $not paid days.";
        }

        $array = array('success' => false, 'message' => $not_approval_message);
        $this->getResponse()->setBody(json_encode($array));
        return true;
    }


    /**
     * @param $id
     * @param $approve_type
     * @return int|mixed
     */
    private function updateApproval($id, $approve_type)
    {
        $row = $this->_leaves_requests_model->getById($id)->toArray();
        $row['approve_type'] = $approve_type;

        $return = $this->_leaves_requests_model->doUpdate($row);
        return $return;
    }

    private function calculateAbsentDays($user_id, $leave_type, $requested_days)
    {
        $this->_user = $this->_user_model->getById($user_id)->toArray();
        $already_used_days = 0;
        $not = '';

        if (Lp_LeaveType::isPaid($leave_type)) {
            $already_used_days = $this->_user_model->getAbsentPaidUsedDaysById($user_id);
            $not = '';
            $all_used_days = $already_used_days + $requested_days;
            $this->_user['paid_days_absent'] = $all_used_days;
            $this->_max_allowed_days = Zend_Registry::get('max_absent_paid_days_allowed');
        }

        if (Lp_LeaveType::isNotPaid($leave_type)) {
            $already_used_days = $this->_user_model->getAbsentNotPaidUsedDaysById($user_id);
            $not = 'not';
            $all_used_days = $already_used_days + $requested_days;
            $this->_user['not_paid_days_absent'] = $all_used_days;
            $this->_max_allowed_days = Zend_Registry::get('max_absent_not_paid_days_allowed');
        }

        return array($already_used_days, $not, $all_used_days);
    }
}


<?php

class UserController extends Lp_Controller_Base
{
    private $_day_library;

    public function init()
    {
        parent::init();
        $this->_day_library = new Lp_Dates();
    }

    public function indexAction()
    {
        if (!$this->hasIdentity())
            $this->redirect('index');

        $user = $this->getUserStorage();
        $username = $user->username;
        $user_type = $user->user_type;
        $user_id = $user->id;

        $this->view->username = $username;
        $this->view->user_type = $user_type;

        $leave_type_model = new Model_LeaveType();
        $types = $leave_type_model->getAll();
        $this->view->types = $types;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $leave_type = $request->getParam('leave_type');
            $from_date = $request->getParam('from_date');
            $to_date = $request->getParam('to_date');
            $approve_type = Zend_Registry::get('pending_request');

            $working_days_requested = $this->_day_library->countWorkingDays($from_date, $to_date);
            if ($this->requestRejected($request, $working_days_requested))
                return false;

            $data = array();
            $data['leave_type'] = $leave_type;
            $data['user'] = $user_id;
            $data['approve_type'] = $approve_type;
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;

            $leave_requests = new Model_LeaveRequests();
            $leave_requests->doInsert($data);

            $this->view->message = 'Request is sent. <br/>';
            $this->view->message .= 'Number of working days requested: ' . $working_days_requested;
            $this->view->hide = 'display: none;';
        }
    }

    private function requestRejected($request, $working_days_requested)
    {

        $user_id = $this->getUserStorage()->id;

        $leave_type = $request->getParam('leave_type');
        $from_date = $request->getParam('from_date');
        $to_date = $request->getParam('to_date');

        $this->view->from_date = $from_date;
        $this->view->to_date = $to_date;
        $this->view->leave_type = $leave_type;

        if ($this->isInvalidDateRange($from_date, $to_date, $working_days_requested)
            || $this->isNotRequestedInAdvance($from_date)
            || $this->daysNotAvailable($leave_type, $user_id, $working_days_requested)
        )
            return true;

        return false;
    }

    public function isInvalidDateRange($from_date, $to_date, $working_days_requested)
    {
        if (new DateTime($to_date) < new DateTime($from_date)) {
            $this->view->invalid_date = 'Invalid date range, start date must be less than end date.';
            return true;
        }

        if ($working_days_requested == 0) {
            $this->view->invalid_date = 'You requested 0 working days. ';
            return true;
        }
    }

    public function isNotRequestedInAdvance($from_date)
    {
        $starts_in = $this->_day_library->countWorkingDays('now', $from_date);
        $days_in_advance = Zend_Registry::get('working_days_in_advance');
        if ($starts_in < $days_in_advance) {
            $this->view->invalid_date = 'You must request at least ' . $days_in_advance;
            $this->view->invalid_date .= ' days in advance.';
            return true;
        }
    }

    public function daysNotAvailable($leave_type, $user_id, $working_days_requested)
    {
        $user_model = new Model_Users();

        if (Lp_LeaveType::isPaid($leave_type)) {
            $max_allowed_days = Zend_Registry::get('max_absent_paid_days_allowed');
            $absent_days_used = $user_model->getAbsentPaidUsedDaysById($user_id);

            if (($working_days_requested + $absent_days_used) > $max_allowed_days) {
                $left = $max_allowed_days - $absent_days_used;
                $this->view->invalid_date = 'You requested ' . $working_days_requested;
                $this->view->invalid_date .= ' days, but you left only ' . $left . ' paid days.';
                return true;
            }
        }

        if (Lp_LeaveType::isNotPaid($leave_type)) {
            $max_allowed_days = Zend_Registry::get('max_absent_not_paid_days_allowed');
            $absent_days_used = $user_model->getAbsentNotPaidUsedDaysById($user_id);

            if (($working_days_requested + $absent_days_used) > $max_allowed_days) {
                $left = $max_allowed_days - $absent_days_used;
                $this->view->invalid_date = 'You requested ' . $working_days_requested;
                $this->view->invalid_date .= ' days, but you left only ' . $left . ' not paid days.';
                return true;
            }
        }
    }

}


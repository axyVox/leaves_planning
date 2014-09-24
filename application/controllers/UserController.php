<?php

class UserController extends Lp_Controller_Base
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        if(!$this->hasIdentity())
            $this->redirect('index');

        $user = $this->getUserStorage();
        $username = $user->username;
        $user_type = $user->user_type;
        $user_id = $user->id;

        $this->view->username = $username;
        $this->view->user_type = $user_type;

        $leave_type_model = new Model_LeaveType();
        $types= $leave_type_model->getAll();
        $this->view->types = $types;

        $request = $this->getRequest();
        if($request->isPost()){
            $leave_type = $request->getParam('leave_type');
            $from_date = $request->getParam('from_date');
            $to_date = $request->getParam('to_date');
            $approve_type = 2; //make constanst!!! PANDING, APPROVED, REJECTED

            if(new DateTime($to_date) < new DateTime($from_date)){
                $this->view->invalid_date = 'Invalid date range';
                return false;
            }

            $data = array();
            $data['leave_type'] = $leave_type;
            $data['user'] = $user_id;
            $data['approve_type'] = $approve_type;
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;

            $leave_requests = new Model_LeaveRequests();
            $leave_requests->doSave($data);
            $this->view->message = 'Request is sent.';
            $this->view->hide = 'display: none;';

        }

    }




}


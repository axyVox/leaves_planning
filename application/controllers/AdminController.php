<?php

class AdminController extends Lp_Controller_Base
{

    public function init()
    {
        parent::init();
    }

    public function indexAction()
    {
        if(!$this->isAdmin())
            $this->redirect('index');

        $user = $this->getUserStorage();
        $this->view->username = $user->username;
        $this->view->user_type = $user->user_type;
        $this->view->user_id = $user->id;

        $leave_requests_model = new Model_LeaveRequests();
        $all_requests = $leave_requests_model->getAll();

        $all_requests_packed = array();

        $this->view->all_requests = $all_requests;

        $leave_type_model = new Model_LeaveType();
        $approve_type_model = new Model_ApproveType();
        $user_model = new Model_Users();

        foreach($all_requests as $request){

            $leave_type = $leave_type_model->getNameById($request->leave_type);
            $request['leave_type'] = $leave_type;

            $approve_type = $approve_type_model->getNameById($request->approve_type);
            $request['approve_type'] = $approve_type;

            $user = $user_model->getUsernameById($request->user);
            $request['user'] = $user;

            $all_requests_packed[] = $request;
        }

        $this->view->all_requests = $all_requests_packed;
    }
}


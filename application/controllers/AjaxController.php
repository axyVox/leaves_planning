<?php

class AjaxController extends Lp_Controller_Base
{

    public function init()
    {
        parent::init();
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

    }

    public function updateRequestAction()
    {
        $request = $this->getRequest();
        $id = $request->getParam("id");
        $approve_type = $request->getParam("approve_type");

        $leaves_requests_model = new Model_LeaveRequests();
        $row = $leaves_requests_model->getById($id)->toArray();
        $row['approve_type'] = $approve_type;
        unset($row['id']);

        $return = $leaves_requests_model->doSave($row, $id);

        $confirm = $return > 0;
        $arr = array('success' => $confirm);

        $arrEncoded = json_encode($arr);
        $this->getResponse()->setBody($arrEncoded);

    }


}


<?php

use \Phalcon\Tag as Tag;

class RepliesController extends ControllerBase
    {

    function indexAction()
    {
        $this->session->conditions = null;
    }

    public function searchAction()
{

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = \Phalcon\Mvc\Model\Criteria::fromInput($this->di, "Replies", $_POST);
            $this->session->conditions = $query->getConditions();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
            if ($numberPage <= 0) {
                $numberPage = 1;
            }
        }

        $parameters = array();
        if ($this->session->conditions) {
            $parameters["conditions"] = $this->session->conditions;
        }
        $parameters["order"] = "reply_id, users_user_id, topics_topic_id, topics_users_user_id";

        $replies = Replies::find($parameters);
        if (count($replies) == 0) {
            $this->flash->notice("The search did not find any replies");
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            "data" => $replies,
            "limit"=> 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {

    }

    public function editAction($reply_id)
    {

        $request = $this->request;
        if (!$request->isPost()) {

            $reply_id = $this->filter->sanitize($reply_id, array("int"));

            $replies = Replies::findFirst('reply_id, users_user_id, topics_topic_id, topics_users_user_id="'.$reply_id.'"');
            if (!$replies) {
                $this->flash->error("replies was not found");
                return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
            }
            $this->view->setVar("reply_id, users_user_id, topics_topic_id, topics_users_user_id", $replies->reply_id);
        
            Tag::displayTo("reply_id", $replies->reply_id);
            Tag::displayTo("users_user_id", $replies->users_user_id);
            Tag::displayTo("topics_topic_id", $replies->topics_topic_id);
            Tag::displayTo("topics_users_user_id", $replies->topics_users_user_id);
            Tag::displayTo("reply_body", $replies->reply_body);
            Tag::displayTo("reply_created_date", $replies->reply_created_date);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }

        $replies = new Replies();
        $replies->reply_id = $this->request->getPost("reply_id");
        $replies->users_user_id = $this->request->getPost("users_user_id");
        $replies->topics_topic_id = $this->request->getPost("topics_topic_id");
        $replies->topics_users_user_id = $this->request->getPost("topics_users_user_id");
        $replies->reply_body = $this->request->getPost("reply_body");
        $replies->reply_created_date = $this->request->getPost("reply_created_date");
        if (!$replies->save()) {
            foreach ($replies->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "new"));
        } else {
            $this->flash->success("replies was created successfully");
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }

    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }

        $reply_id = $this->request->getPost("reply_id", "int");
        $replies = Replies::findFirst("reply_id='$reply_id'");
        if (!$replies) {
            $this->flash->error("replies does not exist ".$reply_id);
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }
    //    $replies->reply_id = $this->request->getPost("reply_id");
    //    $replies->users_user_id = $this->request->getPost("users_user_id");
   //     $replies->topics_topic_id = $this->request->getPost("topics_topic_id");
   //     $replies->topics_users_user_id = $this->request->getPost("topics_users_user_id");
        $replies->reply_body = $this->request->getPost("reply_body");
   //     $replies->reply_created_date = $this->request->getPost("reply_created_date");
        if (!$replies->save()) {
            foreach ($replies->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "edit", "params" => array($replies->reply_id, users_user_id, topics_topic_id, topics_users_user_id)));
        } else {
            $this->flash->success("replies was updated successfully");
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }

    }

    public function deleteAction($reply_id){

        $reply_id = $this->filter->sanitize($reply_id, array("int"));

        $replies = Replies::findFirst('reply_id, users_user_id, topics_topic_id, topics_users_user_id="'.$reply_id.'"');
        if (!$replies) {
            $this->flash->error("replies was not found");
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }

        if (!$replies->delete()) {
            foreach ($replies->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "search"));
        } else {
            $this->flash->success("replies was deleted");
            return $this->dispatcher->forward(array("controller" => "replies", "action" => "index"));
        }
    }

}

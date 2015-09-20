<?php

use \Phalcon\Tag as Tag;

class TopicsController extends ControllerBase
    {

    function indexAction()
    {
        $this->session->conditions = null;
    }

    public function detailsAction($topic_id){
        /*
@TODO get all replies
        @TODO list replies in date/time order */

     //Get all replies related to the topic_id

        $request = $this->request;
        if (!$request->isPost()) {

            $topic_id = $this->filter->sanitize($topic_id, array("int"));

            $topics = Topics::findfirst('topic_id="'.$topic_id.'"');
            if (!$topics) {
                $this->flash->error("topics was not found");
                return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
            }


            foreach ($topics->replies as $topic_replies) {
               echo $topic_replies->reply_body, "\n\n\n";
            }

    }}

    public function searchAction()
{

    //possible admin feature, could also be used for searching sitewide
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = \Phalcon\Mvc\Model\Criteria::fromInput($this->di, "Topics", $_POST);
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
        $parameters["order"] = "topic_id, users_user_id, sub_categories_sub_cat_id, sub_categories_categories_cat_id";

        $topics = Topics::find($parameters);
        if (count($topics) == 0) {
            $this->flash->notice("The search did not find any topics");
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            "data" => $topics,
            "limit"=> 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {

    }

    public function editAction($topic_id)
    {

        $request = $this->request;
        if (!$request->isPost()) {

            $topic_id = $this->filter->sanitize($topic_id, array("int"));

            $topics = Topics::findFirst('topic_id="'.$topic_id.'"');
            if (!$topics) {
                $this->flash->error("topics was not found");
                return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
            }
            $this->view->setVar("topic_id", $topics->topic_id);
        
            Tag::displayTo("topic_id", $topics->topic_id);
            Tag::displayTo("users_user_id", $topics->users_user_id);
            Tag::displayTo("sub_categories_sub_cat_id", $topics->sub_categories_sub_cat_id);
            Tag::displayTo("sub_categories_categories_cat_id", $topics->sub_categories_categories_cat_id);
            Tag::displayTo("topic_name", $topics->topic_name);
            Tag::displayTo("topic_body", $topics->topic_body);
            Tag::displayTo("topic_created_date", $topics->topic_created_date);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }

        $topics = new Topics();
        $topics->topic_id = $this->request->getPost("topic_id");
        $topics->users_user_id = $this->request->getPost("users_user_id");
        $topics->sub_categories_sub_cat_id = $this->request->getPost("sub_categories_sub_cat_id");
        $topics->sub_categories_categories_cat_id = $this->request->getPost("sub_categories_categories_cat_id");
        $topics->topic_name = $this->request->getPost("topic_name");
        $topics->topic_body = $this->request->getPost("topic_body");
        $topics->topic_created_date = $this->request->getPost("topic_created_date");
        if (!$topics->save()) {
            foreach ($topics->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "new"));
        } else {
            $this->flash->success("topics was created successfully");
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }

    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }

        $topic_id = $this->request->getPost("topic_id", "int");
        $topics = Topics::findFirst("topic_id='$topic_id'");
        if (!$topics) {
            $this->flash->error("topics does not exist ".$topic_id);
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }
      //  $topics->topic_id = $this->request->getPost("topic_id");
        $topics->users_user_id = $this->request->getPost("users_user_id");
        //$topics->sub_categories_sub_cat_id = $this->request->getPost("sub_categories_sub_cat_id");
        //$topics->sub_categories_categories_cat_id = $this->request->getPost("sub_categories_categories_cat_id");
        $topics->topic_name = $this->request->getPost("topic_name");
        $topics->topic_body = $this->request->getPost("topic_body");
        //$topics->topic_created_date = $this->request->getPost("topic_created_date");
        if (!$topics->save()) {
            foreach ($topics->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "edit", "params" => array($topics->topic_id, users_user_id, sub_categories_sub_cat_id, sub_categories_categories_cat_id)));
        } else {
            $this->flash->success("topics was updated successfully");
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }

    }


    public function deleteAction($topic_id){

        $topic_id = $this->filter->sanitize($topic_id, array("int"));

        $topics = Topics::findFirst('topic_id="'.$topic_id.'"');
        if (!$topics) {
            $this->flash->error("topics was not found");
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }

        if (!$topics->delete()) {
            foreach ($topics->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "search"));
        } else {
            $this->flash->success("topics was deleted");
            return $this->dispatcher->forward(array("controller" => "topics", "action" => "index"));
        }
    }

}

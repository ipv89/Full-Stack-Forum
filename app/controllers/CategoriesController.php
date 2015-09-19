<?php

use \Phalcon\Tag as Tag;

class CategoriesController extends ControllerBase
    {

    function indexAction()
    {
        $this->session->conditions = null;
    }

    public function searchAction()
{

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = \Phalcon\Mvc\Model\Criteria::fromInput($this->di, "Categories", $_POST);
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
        $parameters["order"] = "cat_id, users_user_id";

        $categories = Categories::find($parameters);
        if (count($categories) == 0) {
            $this->flash->notice("The search did not find any categories");
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            "data" => $categories,
            "limit"=> 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {

    }

    public function editAction($cat_id)
    {

        $request = $this->request;
        if (!$request->isPost()) {

            $cat_id = $this->filter->sanitize($cat_id, array("int"));
           $users_user_id = 1;
            $categories = Categories::findFirst('cat_id="'.$cat_id.'"');
            if (!$categories) {
                $this->flash->error("categories was not found");
                return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
            }
            $this->view->setVar("cat_id", $categories->cat_id);
        
            Tag::displayTo("cat_id", $categories->cat_id);
            Tag::displayTo("cat_name", $categories->cat_name);
            Tag::displayTo("cat_created_date", $categories->cat_created_date);
            Tag::displayTo("users_user_id", $categories->users_user_id);
            Tag::displayTo("cat_decription", $categories->cat_decription);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }

        $categories = new Categories();
        $categories->cat_name = $this->request->getPost("cat_name");

        //for testing this is manualy set, this will be from the logged in session later
        $categories->users_user_id = $this->request->getPost("users_user_id");
         $categories->cat_decription = $this->request->getPost("cat_decription");
        if (!$categories->save()) {
            foreach ($categories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "new"));
        } else {
            $this->flash->success("categories was created successfully");
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }

    }

    public function saveAction()
    {


        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }




        $users_user_id = $this->request->getPost("cat_id, users_user_id", "int");
        $cat_id = $this->request->getPost("cat_id", "int");

        $categories = Categories::findFirst("cat_id='$cat_id'");

        if (!$categories) {
            $this->flash->error("categories does not exist ".$cat_id, users_user_id);
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }



        $categories->cat_id = $this->request->getPost("cat_id");
        $categories->cat_name = $this->request->getPost("cat_name");
      //  $categories->cat_created_date = $this->request->getPost("cat_created_date");
        $categories->users_user_id = $this->request->getPost("users_user_id");
        $categories->cat_decription = $this->request->getPost("cat_decription");
        if (!$categories->save()) {
            foreach ($categories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "edit", "params" => array($categories->cat_id, users_user_id)));
        } else {
            $this->flash->success("categories was updated successfully");
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }

    }

    public function deleteAction($cat_id){

        $cat_id = $this->filter->sanitize($cat_id, array("int"));


        $categories = Categories::findFirst('cat_id="'.$cat_id.'"');
        if (!$categories) {
            $this->flash->error("categories was not found");
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }

        if (!$categories->delete()) {
            foreach ($categories->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "search"));
        } else {
            $this->flash->success("categories was deleted");
            return $this->dispatcher->forward(array("controller" => "categories", "action" => "index"));
        }
    }

}

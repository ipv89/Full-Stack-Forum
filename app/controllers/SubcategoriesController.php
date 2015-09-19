<?php

use \Phalcon\Tag as Tag;

class SubCategoriesController extends ControllerBase
    {

    function indexAction()
    {
        $this->session->conditions = null;
    }

    public function searchAction()
{

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = \Phalcon\Mvc\Model\Criteria::fromInput($this->di, "SubCategories", $_POST);
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
        $parameters["order"] = "sub_cat_id, categories_cat_id, users_user_id";

        $subcategories = SubCategories::find($parameters);
        if (count($subcategories) == 0) {
            $this->flash->notice("The search did not find any sub categories");
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            "data" => $subcategories,
            "limit"=> 10,
            "page" => $numberPage
        ));
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {

    }

    public function editAction($sub_cat_id)
    {

       $request = $this->request;
        if (!$request->isPost()) {

            $sub_cat_id = $this->filter->sanitize($sub_cat_id, array("int"));

            $subcategories = SubCategories::findFirst('sub_cat_id="'.$sub_cat_id.'"');
            if (!$subcategories) {
                $this->flash->error("sub categories was not found");
                return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
            }
            $this->view->setVar("sub_cat_id", $subcategories->sub_cat_id);
        
            Tag::displayTo("sub_cat_id", $subcategories->sub_cat_id);
            Tag::displayTo("categories_cat_id", $subcategories->categories_cat_id);
            Tag::displayTo("sub_cat_name", $subcategories->sub_cat_name);
            Tag::displayTo("sub_cat_created_date", $subcategories->sub_cat_created_date);
            Tag::displayTo("users_user_id", $subcategories->users_user_id);
            Tag::displayTo("sub_cat_decription", $subcategories->sub_cat_decription);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }

        $subcategories = new SubCategories();

        $subcategories->categories_cat_id = $this->request->getPost("categories_cat_id");
        $subcategories->sub_cat_name = $this->request->getPost("sub_cat_name");

        $subcategories->users_user_id = $this->request->getPost("users_user_id");
        $subcategories->sub_cat_decription = $this->request->getPost("sub_cat_decription");
        if (!$subcategories->save()) {
            foreach ($subcategories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "new"));
        } else {
            $this->flash->success("sub categories was created successfully");
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }

    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }

        $sub_cat_id = $this->request->getPost("sub_cat_id", "int");
        $subcategories = SubCategories::findFirst("sub_cat_id='$sub_cat_id'");
        if (!$subcategories) {
            $this->flash->error("sub categories does not exist ".$sub_cat_id);
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }
       // $subcategories->sub_cat_id = $this->request->getPost("sub_cat_id");
        $subcategories->categories_cat_id = $this->request->getPost("categories_cat_id");
        $subcategories->sub_cat_name = $this->request->getPost("sub_cat_name");
        //$subcategories->sub_cat_created_date = $this->request->getPost("sub_cat_created_date");
        $subcategories->users_user_id = $this->request->getPost("users_user_id");
        $subcategories->sub_cat_decription = $this->request->getPost("sub_cat_decription");
        if (!$subcategories->save()) {
            foreach ($subcategories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "edit", "params" => array($subcategories->sub_cat_id, categories_cat_id, users_user_id)));
        } else {
            $this->flash->success("sub categories was updated successfully");
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }

    }

    public function deleteAction($sub_cat_id){

        $sub_cat_id = $this->filter->sanitize($sub_cat_id, array("int"));

        $subcategories = SubCategories::findFirst('sub_cat_id="'.$sub_cat_id.'"');
        if (!$subcategories) {
            $this->flash->error("sub categories was not found");
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }

        if (!$subcategories->delete()) {
            foreach ($subcategories->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "search"));
        } else {
            $this->flash->success("sub categories was deleted");
            return $this->dispatcher->forward(array("controller" => "subcategories", "action" => "index"));
        }
    }

}

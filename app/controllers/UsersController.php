<?php

use \Phalcon\Tag as Tag;
use Phalcon\Mvc\Model\Query;
class UsersController extends ControllerBase



    {

    function indexAction()
    {
        $this->session->conditions = null;
    }



/*Search for a user with ID
@TODO search by email,username and full name

*/

   public function searchAction()
{
    $user_id = $_POST["user_id"];


        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = \Phalcon\Mvc\Model\Criteria::fromInput($this->di, "Users", $_POST);
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
        $parameters["order"] = "user_id";
        $parameters["user_id"] = $_POST["user_id"];


    $users = Users::query()
        ->where("user_id LIKE :user_id:")
        ->bind(array("user_id" => "%$user_id%"))
        ->execute();




        if (count($users) == 0) {
            $this->flash->notice("The search did not find any users");
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }

        $paginator = new \Phalcon\Paginator\Adapter\Model(array(
            "data" => $users,
            "limit"=> 10,
            "page" => $numberPage
        ));
    var_dump($paginator);
        $page = $paginator->getPaginate();

        $this->view->setVar("page", $page);
    }

    public function newAction()
    {

    }

    public function editAction($user_id)
    {

        $request = $this->request;
        if (!$request->isPost()) {

            $user_id = $this->filter->sanitize($user_id, array("int"));

            $users = Users::findFirst('user_id="'.$user_id.'"');

            if (!$users) {
                $this->flash->error("users was not found");
                return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
            }

            $this->view->setVar("user_id", $users->user_id);
        
            Tag::displayTo("user_id", $users->user_id);
            Tag::displayTo("full_name", $users->full_name);
            Tag::displayTo("email", $users->email);
            Tag::displayTo("password", $users->password);
            Tag::displayTo("date_joined", $users->date_joined);
            Tag::displayTo("username", $users->username);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }

        $users = new Users();
        $users->user_id = $this->request->getPost("user_id");
        $users->full_name = $this->request->getPost("full_name");
        $users->email = $this->request->getPost("email", "email");
        $users->password = $this->request->getPost("password");
        $users->date_joined = $this->request->getPost("date_joined");
        $users->username = $this->request->getPost("username");
        if (!$users->save()) {
            foreach ($users->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "users", "action" => "new"));
        } else {
            $this->flash->success("users was created successfully");
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }

    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }

        $user_id = $this->request->getPost("user_id", "int");
        var_dump($user_id);
        $users = Users::findFirst("user_id='$user_id'");
        if (!$users) {
            $this->flash->error("users does not exist ".$user_id);
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }
        $users->user_id = $this->request->getPost("user_id");
        $users->full_name = $this->request->getPost("full_name");
        $users->email = $this->request->getPost("email", "email");
        $users->password = $this->request->getPost("password");
        $users->date_joined = $this->request->getPost("date_joined");
        $users->username = $this->request->getPost("username");
        if (!$users->save()) {
            foreach ($users->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "users", "action" => "edit", "params" => array($users->user_id)));
        } else {
            $this->flash->success("users was updated successfully");
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }

    }

    public function deleteAction($user_id){

        $user_id = $this->filter->sanitize($user_id, array("int"));

        $users = Users::findFirst('user_id="'.$user_id.'"');
        if (!$users) {
            $this->flash->error("users was not found");
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }

        if (!$users->delete()) {
            foreach ($users->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array("controller" => "users", "action" => "search"));
        } else {
            $this->flash->success("users was deleted");
            return $this->dispatcher->forward(array("controller" => "users", "action" => "index"));
        }
    }

}

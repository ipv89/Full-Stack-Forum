<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 11/09/2015
 * Time: 8:26 PM
 */


class SessionController extends ControllerBase
{

    // ...

    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id'    => $user->id,
            'name'  => $user->username
        ));
    }

    /**
     * This action authenticate and logs a user into the application
     *
     */
    public function startAction()
    {
        if ($this->request->isPost()) {

            $email      = $this->request->getPost('email');
            $password   = $this->request->getPost('password');

            $user = Users::findFirst(array(
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => array('email' => $email, 'password' => sha1($password))
            ));
            if ($user != false) {
                $this->_registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->forward('invoices/index');
            }

            $this->flash->error('Wrong email/password');
        }

        return $this->forward('session/index');
    }
}
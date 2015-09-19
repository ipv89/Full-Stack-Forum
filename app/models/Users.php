<?php

use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $user_id;

    /**
     *
     * @var string
     */
    protected $full_name;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $date_joined;

    /**
     *
     * @var string
     */
    protected $username;

    /**
     * Method to set the value of field user_id
     *
     * @param integer $user_id
     * @return $this
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Method to set the value of field full_name
     *
     * @param string $full_name
     * @return $this
     */
    public function setFullName($full_name)
    {
        $this->full_name = $full_name;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field date_joined
     *
     * @param string $date_joined
     * @return $this
     */
    public function setDateJoined($date_joined)
    {
        $this->date_joined = $date_joined;

        return $this;
    }

    /**
     * Method to set the value of field username
     *
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Returns the value of field user_id
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Returns the value of field full_name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->full_name;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field date_joined
     *
     * @return string
     */
    public function getDateJoined()
    {
        return $this->date_joined;
    }

    /**
     * Returns the value of field username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('user_id', '\Categories', 'users_user_id', array('alias' => 'Categories'));
        $this->hasMany('user_id', '\Replies', 'users_user_id', array('alias' => 'Replies'));
        $this->hasMany('user_id', '\Sub_categories', 'users_user_id', array('alias' => 'Sub_categories'));
        $this->hasMany('user_id', '\Topics', 'users_user_id', array('alias' => 'Topics'));
        $this->hasMany('user_id', '\Categories', 'users_user_id', array('alias' => 'Categories'));
        $this->hasMany('user_id', '\Replies', 'users_user_id', array('alias' => 'Replies'));
        $this->hasMany('user_id', '\SubCategories', 'users_user_id', array('alias' => 'SubCategories'));
        $this->hasMany('user_id', '\Topics', 'users_user_id', array('alias' => 'Topics'));
    }

}

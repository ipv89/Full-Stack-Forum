<?php

class Replies extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $reply_id;

    /**
     *
     * @var integer
     */
    protected $users_user_id;

    /**
     *
     * @var integer
     */
    protected $topics_topic_id;

    /**
     *
     * @var integer
     */
    protected $topics_users_user_id;

    /**
     *
     * @var string
     */
    protected $reply_body;

    /**
     *
     * @var string
     */
    protected $reply_created_date;

    /**
     * Method to set the value of field reply_id
     *
     * @param integer $reply_id
     * @return $this
     */
    public function setReplyId($reply_id)
    {
        $this->reply_id = $reply_id;

        return $this;
    }

    /**
     * Method to set the value of field users_user_id
     *
     * @param integer $users_user_id
     * @return $this
     */
    public function setUsersUserId($users_user_id)
    {
        $this->users_user_id = $users_user_id;

        return $this;
    }

    /**
     * Method to set the value of field topics_topic_id
     *
     * @param integer $topics_topic_id
     * @return $this
     */
    public function setTopicsTopicId($topics_topic_id)
    {
        $this->topics_topic_id = $topics_topic_id;

        return $this;
    }

    /**
     * Method to set the value of field topics_users_user_id
     *
     * @param integer $topics_users_user_id
     * @return $this
     */
    public function setTopicsUsersUserId($topics_users_user_id)
    {
        $this->topics_users_user_id = $topics_users_user_id;

        return $this;
    }

    /**
     * Method to set the value of field reply_body
     *
     * @param string $reply_body
     * @return $this
     */
    public function setReplyBody($reply_body)
    {
        $this->reply_body = $reply_body;

        return $this;
    }

    /**
     * Method to set the value of field reply_created_date
     *
     * @param string $reply_created_date
     * @return $this
     */
    public function setReplyCreatedDate($reply_created_date)
    {
        $this->reply_created_date = $reply_created_date;

        return $this;
    }

    /**
     * Returns the value of field reply_id
     *
     * @return integer
     */
    public function getReplyId()
    {
        return $this->reply_id;
    }

    /**
     * Returns the value of field users_user_id
     *
     * @return integer
     */
    public function getUsersUserId()
    {
        return $this->users_user_id;
    }

    /**
     * Returns the value of field topics_topic_id
     *
     * @return integer
     */
    public function getTopicsTopicId()
    {
        return $this->topics_topic_id;
    }

    /**
     * Returns the value of field topics_users_user_id
     *
     * @return integer
     */
    public function getTopicsUsersUserId()
    {
        return $this->topics_users_user_id;
    }

    /**
     * Returns the value of field reply_body
     *
     * @return string
     */
    public function getReplyBody()
    {
        return $this->reply_body;
    }

    /**
     * Returns the value of field reply_created_date
     *
     * @return string
     */
    public function getReplyCreatedDate()
    {
        return $this->reply_created_date;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('topics_topic_id', '\Topics', 'topic_id', array('alias' => 'Topics'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('alias' => 'Users'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('foreignKey' => true,'alias' => 'Users'));
    }

}

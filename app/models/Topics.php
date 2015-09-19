<?php

class Topics extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $topic_id;

    /**
     *
     * @var integer
     */
    protected $users_user_id;

    /**
     *
     * @var integer
     */
    protected $sub_categories_sub_cat_id;

    /**
     *
     * @var integer
     */
    protected $sub_categories_categories_cat_id;

    /**
     *
     * @var string
     */
    protected $topic_name;

    /**
     *
     * @var string
     */
    protected $topic_body;

    /**
     *
     * @var string
     */
    protected $topic_created_date;

    /**
     * Method to set the value of field topic_id
     *
     * @param integer $topic_id
     * @return $this
     */
    public function setTopicId($topic_id)
    {
        $this->topic_id = $topic_id;

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
     * Method to set the value of field sub_categories_sub_cat_id
     *
     * @param integer $sub_categories_sub_cat_id
     * @return $this
     */
    public function setSubCategoriesSubCatId($sub_categories_sub_cat_id)
    {
        $this->sub_categories_sub_cat_id = $sub_categories_sub_cat_id;

        return $this;
    }

    /**
     * Method to set the value of field sub_categories_categories_cat_id
     *
     * @param integer $sub_categories_categories_cat_id
     * @return $this
     */
    public function setSubCategoriesCategoriesCatId($sub_categories_categories_cat_id)
    {
        $this->sub_categories_categories_cat_id = $sub_categories_categories_cat_id;

        return $this;
    }

    /**
     * Method to set the value of field topic_name
     *
     * @param string $topic_name
     * @return $this
     */
    public function setTopicName($topic_name)
    {
        $this->topic_name = $topic_name;

        return $this;
    }

    /**
     * Method to set the value of field topic_body
     *
     * @param string $topic_body
     * @return $this
     */
    public function setTopicBody($topic_body)
    {
        $this->topic_body = $topic_body;

        return $this;
    }

    /**
     * Method to set the value of field topic_created_date
     *
     * @param string $topic_created_date
     * @return $this
     */
    public function setTopicCreatedDate($topic_created_date)
    {
        $this->topic_created_date = $topic_created_date;

        return $this;
    }

    /**
     * Returns the value of field topic_id
     *
     * @return integer
     */
    public function getTopicId()
    {
        return $this->topic_id;
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
     * Returns the value of field sub_categories_sub_cat_id
     *
     * @return integer
     */
    public function getSubCategoriesSubCatId()
    {
        return $this->sub_categories_sub_cat_id;
    }

    /**
     * Returns the value of field sub_categories_categories_cat_id
     *
     * @return integer
     */
    public function getSubCategoriesCategoriesCatId()
    {
        return $this->sub_categories_categories_cat_id;
    }

    /**
     * Returns the value of field topic_name
     *
     * @return string
     */
    public function getTopicName()
    {
        return $this->topic_name;
    }

    /**
     * Returns the value of field topic_body
     *
     * @return string
     */
    public function getTopicBody()
    {
        return $this->topic_body;
    }

    /**
     * Returns the value of field topic_created_date
     *
     * @return string
     */
    public function getTopicCreatedDate()
    {
        return $this->topic_created_date;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('topic_id', '\Replies', 'topics_topic_id', array('alias' => 'Replies'));
        $this->belongsTo('sub_categories_sub_cat_id', '\Sub_categories', 'sub_cat_id', array('alias' => 'Sub_categories'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('alias' => 'Users'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('foreignKey' => true,'alias' => 'Users'));
    }

}

<?php

class Categories extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $cat_id;

    /**
     *
     * @var string
     */
    protected $cat_name;

    /**
     *
     * @var string
     */
    protected $cat_created_date;

    /**
     *
     * @var integer
     */
    protected $users_user_id;

    /**
     *
     * @var string
     */
    protected $cat_decription;

    /**
     *
     * @var string
     */
    protected $date_modified;

    /**
     * Method to set the value of field cat_id
     *
     * @param integer $cat_id
     * @return $this
     */
    public function setCatId($cat_id)
    {
        $this->cat_id = $cat_id;

        return $this;
    }

    /**
     * Method to set the value of field cat_name
     *
     * @param string $cat_name
     * @return $this
     */
    public function setCatName($cat_name)
    {
        $this->cat_name = $cat_name;

        return $this;
    }

    /**
     * Method to set the value of field cat_created_date
     *
     * @param string $cat_created_date
     * @return $this
     */
    public function setCatCreatedDate($cat_created_date)
    {
        $this->cat_created_date = $cat_created_date;

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
     * Method to set the value of field cat_decription
     *
     * @param string $cat_decription
     * @return $this
     */
    public function setCatDecription($cat_decription)
    {
        $this->cat_decription = $cat_decription;

        return $this;
    }

    /**
     * Method to set the value of field date_modified
     *
     * @param string $date_modified
     * @return $this
     */
    public function setDateModified($date_modified)
    {
        $this->date_modified = $date_modified;

        return $this;
    }

    /**
     * Returns the value of field cat_id
     *
     * @return integer
     */
    public function getCatId()
    {
        return $this->cat_id;
    }

    /**
     * Returns the value of field cat_name
     *
     * @return string
     */
    public function getCatName()
    {
        return $this->cat_name;
    }

    /**
     * Returns the value of field cat_created_date
     *
     * @return string
     */
    public function getCatCreatedDate()
    {
        return $this->cat_created_date;
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
     * Returns the value of field cat_decription
     *
     * @return string
     */
    public function getCatDecription()
    {
        return $this->cat_decription;
    }

    /**
     * Returns the value of field date_modified
     *
     * @return string
     */
    public function getDateModified()
    {
        return $this->date_modified;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('cat_id', '\Sub_categories', 'categories_cat_id', array('alias' => 'Sub_categories'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('alias' => 'Users'));
        $this->hasMany('cat_id', '\SubCategories', 'categories_cat_id', array('alias' => 'SubCategories'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('foreignKey' => true,'alias' => 'Users'));
    }

}

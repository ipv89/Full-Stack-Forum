<?php

class SubCategories extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $sub_cat_id;

    /**
     *
     * @var integer
     */
    protected $categories_cat_id;

    /**
     *
     * @var string
     */
    protected $sub_cat_name;

    /**
     *
     * @var string
     */
    protected $sub_cat_created_date;

    /**
     *
     * @var integer
     */
    protected $users_user_id;

    /**
     *
     * @var string
     */
    protected $sub_cat_decription;

    /**
     * Method to set the value of field sub_cat_id
     *
     * @param integer $sub_cat_id
     * @return $this
     */
    public function setSubCatId($sub_cat_id)
    {
        $this->sub_cat_id = $sub_cat_id;

        return $this;
    }

    /**
     * Method to set the value of field categories_cat_id
     *
     * @param integer $categories_cat_id
     * @return $this
     */
    public function setCategoriesCatId($categories_cat_id)
    {
        $this->categories_cat_id = $categories_cat_id;

        return $this;
    }

    /**
     * Method to set the value of field sub_cat_name
     *
     * @param string $sub_cat_name
     * @return $this
     */
    public function setSubCatName($sub_cat_name)
    {
        $this->sub_cat_name = $sub_cat_name;

        return $this;
    }

    /**
     * Method to set the value of field sub_cat_created_date
     *
     * @param string $sub_cat_created_date
     * @return $this
     */
    public function setSubCatCreatedDate($sub_cat_created_date)
    {
        $this->sub_cat_created_date = $sub_cat_created_date;

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
     * Method to set the value of field sub_cat_decription
     *
     * @param string $sub_cat_decription
     * @return $this
     */
    public function setSubCatDecription($sub_cat_decription)
    {
        $this->sub_cat_decription = $sub_cat_decription;

        return $this;
    }

    /**
     * Returns the value of field sub_cat_id
     *
     * @return integer
     */
    public function getSubCatId()
    {
        return $this->sub_cat_id;
    }

    /**
     * Returns the value of field categories_cat_id
     *
     * @return integer
     */
    public function getCategoriesCatId()
    {
        return $this->categories_cat_id;
    }

    /**
     * Returns the value of field sub_cat_name
     *
     * @return string
     */
    public function getSubCatName()
    {
        return $this->sub_cat_name;
    }

    /**
     * Returns the value of field sub_cat_created_date
     *
     * @return string
     */
    public function getSubCatCreatedDate()
    {
        return $this->sub_cat_created_date;
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
     * Returns the value of field sub_cat_decription
     *
     * @return string
     */
    public function getSubCatDecription()
    {
        return $this->sub_cat_decription;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('sub_cat_id', '\Topics', 'sub_categories_sub_cat_id', array('alias' => 'Topics'));
        $this->belongsTo('categories_cat_id', '\Categories', 'cat_id', array('alias' => 'Categories'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('alias' => 'Users'));
        $this->belongsTo('categories_cat_id', '\Categories', 'cat_id', array('foreignKey' => true,'alias' => 'Categories'));
        $this->belongsTo('users_user_id', '\Users', 'user_id', array('foreignKey' => true,'alias' => 'Users'));
    }

}

<?php

use \Phalcon\Tag as Tag;

class BaseForumController extends ControllerBase
{

    function indexAction()
    {
        $this->session->conditions = null;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 19:51
 */

namespace simpleengine\models;


interface DbModelInterface
{
    public function find($id);
    public function save($userid);
}
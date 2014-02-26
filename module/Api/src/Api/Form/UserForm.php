<?php

namespace Api\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class UserForm extends Form
{
 public function __construct($name = null)
 {
    parent::__construct('user');
    $this->setAttribute('method', 'post');

    $this->add(array(
        'name' => 'id',
        'type' => 'Hidden',
    ));
    $this->add(array(
        'name' => 'first_name',
        'type' => 'Text',
        'options' => array(
            'label' => 'First Name',
        ),
    ));
    $this->add(array(
        'name' => 'last_name',
        'type' => 'Text',
        'options' => array(
            'label' => 'Last Name',
        ),
    ));
    $this->add(array(
        'name' => 'username',
        'type' => 'Text',
        'options' => array(
            'label' => 'Username',
        ),
    ));
    $this->add(array(
        'name' => 'email',
        'type' => 'Text',
        'options' => array(
            'label' => 'Email',
        ),
    ));
    $this->add(array(
        'name' => 'dob',
        'type' => 'Text',
        'options' => array(
            'label' => 'Date of Birth',
        ),
    ));
    $this->add(array(
        'name' => 'password',
        'type' => 'Text',
        'options' => array(
            'label' => 'Password',
        ),
    ));
    $this->add(array(
         'name' => 'submit',
         'type' => 'Submit',
         'attributes' => array(
             'value' => 'Go',
             'id' => 'submitbutton',
         ),
     ));
 }
}
<?php
/**
 * Created by PhpStorm.
 * User: gmeyenberg
 * Date: 13.04.2015
 * Time: 18:06
 */
namespace Signup\Form;

use Zend\Form\Form;

class SignupForm extends Form
{
    public function __construct($camp= "DEFAULT")
    {
        // we want to ignore the name passed
        parent::__construct('signup');


        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Name',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'class' => 'form-control',
            ),
        ));
        $this->add(array(
            'name' => 'campaign',
            'type' => 'hidden',
            'options' => array(
            ),
            'attributes' => array(
                'value' => $camp,
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Submit',
                'id' => 'submit',
                'class' => 'btn btn-default',
            ),
        ));
    }
}
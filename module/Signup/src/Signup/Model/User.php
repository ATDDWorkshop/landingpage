<?php
/**
 * Created by PhpStorm.
 * User: gmeyenberg
 * Date: 13.04.2015
 * Time: 18:15
 */

namespace Signup\Model;


use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

use Zend\Http\Request;
use Zend\Http\Client;
use Zend\Stdlib\Parameters;

class User implements InputFilterAwareInterface
{
    public $name;
    public $password;
    public $email;
    public $campaign;

    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->name = (!empty($data['name'])) ? $data['name'] : null;
        $this->password = (!empty($data['password'])) ? $data['password'] : null;
        $this->email = (!empty($data['email'])) ? $data['email'] : null;
        $this->campaign = (!empty($data['campaign'])) ? $data['campaign'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function setCampaign($camp)
    {
        $this->campaign = $camp;
    }

    public function save()
    {
        $request = new Request();
        $request->getHeaders()->addHeaders(array(
            'Content-Type' => 'application/json',
            'Accept' => '*/*'
        ));
        $request->setUri("http://datawarehouse/user");
        $request->setMethod('POST');
        $request->setContent(
            json_encode(
                array(
                    "name" => $this->name,
                    "email" => $this->email,
                    "password" => $this->password,
                    "campaign" => $this->campaign
                )
            )
        );
        $client = new Client();
        $response = $client->dispatch($request);
        if ($response->getStatusCode() == 201) {
            return true;
        }
        return false;
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();


            $inputFilter->add(array(
                'name' => 'name',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'not_empty'),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'email',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'EmailAddress'),
                    array('name' => 'not_empty'),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'not_empty'),
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5
                        ),
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'campaign',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'not_empty'),
                ),
            ));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
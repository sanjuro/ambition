<?php

namespace Api\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class User implements InputFilterAwareInterface
{
	public $id;
	public $first_name;
	public $last_name;
	public $email;
	public $dob;
	public $password;
    protected $inputFilter;

	public function exchangeArray($data)
	{
		$this->id         = (!empty($data['id'])) ? $data['id'] : null;
		$this->first_name = (!empty($data['first_name'])) ? $data['first_name'] : null;
		$this->last_name  = (!empty($data['last_name'])) ? $data['last_name'] : null;
        $this->useranme   = (!empty($data['useranme'])) ? $data['useranme'] : null;
		$this->email      = (!empty($data['email'])) ? $data['email'] : null;
		$this->dob  	  = (!empty($data['dob'])) ? $data['dob'] : null;
		$this->password   = (!empty($data['password'])) ? $data['password'] : null;
	}

    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception("Not used");
	}

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                 'name'     => 'first_name',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
            )));

            $inputFilter->add($factory->createInput(array(
                 'name'     => 'dob',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
            )));

            $inputFilter->add($factory->createInput(array(
                 'name'     => 'username',
                 'required' => false,
                 'filters'  => array(
                     array('name' => 'StripTags'),
                     array('name' => 'StringTrim'),
                 ),
                 'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
            )));

            $inputFilter->add($factory->createInput(array(
                 'name'     => 'last_name',
                 'required' => false,
                 'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                 'validators' => array(
                    array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput([
                'name' => 'email',
                'required' => true,
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 5,
                            'max'      => 255,
                            'messages' => array(
                                \Zend\Validator\EmailAddress::INVALID_FORMAT => 'Email address format is invalid'
                            )
                        ],
                    ],
                ],
            ])); 

            $inputFilter->add($factory->createInput([
                'name' => 'password',
                'required' => true,
                'filters' => [ ['name' => 'StringTrim'], ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'encoding' => 'UTF-8',
                            'min'      => 6,
                            'max'      => 128,
                        ],
                    ],
                ],
            ])); 

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }
 
}
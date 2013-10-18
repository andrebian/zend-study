<?php

namespace Application\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Core\Model\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comment
 *
 * @author andre
 */
class Comment extends Entity
{
    
    protected $tableName = 'comments';
    protected $id;
    protected $post_id;
    protected $description;
    protected $name;
    protected $email;
    protected $webpage;
    protected $comment_date;
    
    public function getInputFilter()
    {
        if ( !$this->inputFilter ){
            $inputFilter = new InputFilter();
            $factory = new InputFactory();
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'id',
                'required' => true,
                'filters'  => array(
                    array('name' => 'Int'),
                ),
            )));
            
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'post_id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'description',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                )
            )));
            
            $inputFilter->add($factory->createInput(array(
                        'name' => 'name',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100
                                ),
                            )
                        )
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'email', 
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array('name' => 'EmailAddress',),
                )
            )));
            
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'webpage', 
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array( array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 200,
                    )
                ))
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name' => 'comment_date', 
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'Date',
                        'options' => array(
                            'format' => 'Y-m-d H:i:s'
                        )
                    )
                )
            )));
            
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
    
}

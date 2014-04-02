<?php
namespace Application\Form;

use Application\Model\Customer;
use Zend\Captcha;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Form\View;
use Zend\Stdlib\Hydrator;

/**
 * Class CustomersForm
 *
 * @package Application\Form
 */
class CustomersForm extends Form
{
    /**
     * Initialize the form.
     */
    public function __construct($name = null)
    {
        parent::__construct('Application');

        $this->setHydrator(new Hydrator\ClassMethods())
             ->setObject(new Customer());

        $this->add(
            [
                'name' => 'id',
                'type' => 'Zend\Form\Element\Hidden',
            ]
        );

        $this->add(
            [
                'name' => 'name',
                'attributes' =>
                [
                    'required' => 'required',
                    'type' => 'Zend\Form\Element\Text',
                ],
                'options' =>
                [
                    'label' => 'Name:',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'description',
                'type' => 'Zend\Form\Element\Text',
                'options' =>
                [
                    'label' => 'Description:',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'address',
                'type' => 'Zend\Form\Element\Text',
                'options' =>
                [
                    'label' => 'Address:',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'city',
                'type' => 'Zend\Form\Element\Text',
                'options' =>
                [
                    'label' => 'City:',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'state',
                'type' => 'Zend\Form\Element\Text',
                'options' =>
                [
                    'label' => 'State:',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'zip',
                'type' => 'Zend\Form\Element\Text',
                'options' =>
                [
                    'label' => 'Zip:',
                ],
            ]
        );

        $this->add(
            [
                'name' => 'phone',
                'type' => 'Zend\Form\Element\Text',
                'options' =>
                 [
                    'label' => 'Phone:',
                 ],
            ]
        );

        $this->add(
            [
                'name' => 'submit',
                'attributes' =>
                [
                    'type'  => 'submit',
                    'value' => 'submit',
                ]
            ]
        );
    }
}

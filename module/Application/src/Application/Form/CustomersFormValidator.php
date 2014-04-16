<?php
namespace Application\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * Initialize InputFilter / Validators
 *
 * @return InputFilter|InputFilterInterface
 */
class CustomersFormValidator implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    /**
     * Initialize InputFilter / Validators
     *
     * @return InputFilter|InputFilterInterface
     */
    public function getInputFilter()
    {
        if (!$this->inputFilter)
        {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'name',
                    'required' => true,
                    'filters' =>
                    [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '50',
                            ],
                        ],
                    ],
                ]
            ));

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'description',
                    'required' => false,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '50',
                            ],
                        ],
                    ],
                ]
            ));

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'phone',
                    'required' => false,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '12',
                            ],
                        ],
                    ],
                ]
            ));

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'address',
                    'required' => false,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '255',
                            ],
                        ],
                    ],
                ]
            ));

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'city',
                    'required' => false,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '50',
                            ],
                        ],
                    ],
                ]
            ));

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'state',
                    'required' => false,
                    'filters' => [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '2',
                            ],
                        ],
                    ],
                ]
            ));

            $inputFilter->add($factory->createInput(
                [
                    'name' => 'zip',
                    'required' => false,
                    'filters' =>
                    [
                        ['name' => 'StripTags'],
                        ['name' => 'StringTrim'],
                    ],
                    'validators' =>
                    [
                        [
                            'name' => 'StringLength',
                            'options' =>
                            [
                                'encoding' => 'UTF-8',
                                'min' => '0',
                                'max' => '10',
                            ],
                        ],
                        [
                            'name'=> 'PostCode',
                        ]
                    ],
                ]
            ));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}

<?php

namespace Application\Repository;

use Doctrine\ORM\EntityManager;
use Application\Model\Customer;

/**
 * Class CustomerRepository
 *
 * @package Application\Repository
 */
class CustomerRepository
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entityManager = $em;
    }

    /**
     * Retrieve all customers in the database
     *
     * @return array
     */
    public function getAll()
    {
        return $this->entityManager->getRepository('Application\Model\Customer')->findBy(
            array(),
            array('id' => 'asc')
        );
    }

    /**
     * Retrieve customer by id
     *
     * @param $id
     * @return object
     */
    public function getById($id)
    {
        return $this->entityManager->find('Application\Model\Customer', ['id'=>$id]);
    }

    /**
     * Save Customer Data
     *
     * @param Customer $customer
     */
    public function saveCustomer(Customer $customer)
    {
        // Check if new customer
        if($customer->getId() == null) {
        $this->entityManager->persist($customer);
        }
        $this->entityManager->flush();
    }

    /**
     * Delete Customer
     *
     * @param Customer $customer
     */
    public function removeCustomer(Customer $customer)
    {
        $this->entityManager->remove($customer);
        $this->entityManager->flush();
    }
}

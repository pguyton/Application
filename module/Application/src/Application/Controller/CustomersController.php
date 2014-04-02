<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Helper;
use Application\Model\Customer;
use Application\Form\CustomersForm;
use Application\Form\CustomersFormValidator;
use Application\Repository\CustomerRepository;

/**
 * Class CustomersController
 *
 * @package Application\Controller
 */
class CustomersController extends AbstractActionController
{
    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * Initialize Customer Repository
     *
     * @param CustomerRepository $repo
     */
    public function __construct(CustomerRepository $repo)
    {
        $this->customerRepository = $repo;
    }

    /**
     * Display all the customers in the system.
     *
     * @return ViewModel
     */
    public function indexAction()
    {
        $customers = $this->customerRepository->getAll();
        $form = new CustomersForm();
        $request = $this->getRequest();
        if($request->isPost()) {
            $this->redirect()->toUrl('customers/create');
        }
        $view = new ViewModel(
            [
                'customers' => $customers,
                'error' => $this->flashMessenger()->getErrorMessages(),
                'success' => $this->flashMessenger()->getSuccessMessages(),
                'form' => $form,
            ]
        );
        return $view;
    }

    /**
     * View Selected Customer Information
     *
     * @return ViewModel
     */
    public function viewAction()
    {
        $id = $this->params()->fromRoute('id');
        $customer = $this->customerRepository->getById($id);
        $form = new CustomersForm();
        $request = $this->getRequest();
        if($request->isPost()) {
            $this->redirect()->toRoute('customers');
        }
        $view = new ViewModel(
            [
                'customer' => $customer,
                'form' => $form
            ]
        );
        return $view;
    }

    /**
     * Create New Customer
     *
     * @return ViewModel
     */
    public function createAction()
    {
        $form = new CustomersForm();
        $customer = new Customer;
        $form->bind($customer);
        $request = $this->getRequest();

        if ($request->isPost()) {

            $formValidator = new CustomersFormValidator();
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->customerRepository->saveCustomer($form->getObject());
                $this->flashMessenger()->addSuccessMessage('Customer created');
                $this->redirect()->toRoute('customers');
            }
        }
        $view = new ViewModel(
            [
                'form' => $form,
            ]
        );
        return $view;
    }

    /**
     * Update Customer Information
     *
     * @return ViewModel
     */
    public function updateAction()
    {
        $form = new CustomersForm();
        $id = $this->params()->fromRoute('id');
        $customer = $this->customerRepository->getById($id);
        $form->bind($customer);
        $request = $this->getRequest();

        if ($request->isPost()) {
            $formValidator = new CustomersFormValidator();
            $form->setInputFilter($formValidator->getInputFilter());
            $form->setData($request->getPost());
            $form->bind($customer);

            if ($form->isValid()) {
                $this->customerRepository->saveCustomer($customer);
                $this->flashMessenger()->addSuccessMessage('Customer Updated');
                $this->redirect()->toRoute('customers');
            }
        }
        $view = new ViewModel(
            [
                'customer' => $customer,
                'form' => $form,
            ]
        );
        return $view;
    }

    /**
     * Delete Customer from system
     *
     * @return ViewModel
     */
    public function removeAction()
    {
        $id = $this->params()->fromRoute('id');
        $customer = $this->customerRepository->getById($id);
        $form = new CustomersForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->customerRepository->removeCustomer($customer);
                $this->flashMessenger()->addErrorMessage("Removed Customer");
                $this->redirect()->toRoute('customers');
            }
        }
        $view = new ViewModel(
            [
                'customer' => $customer,
                'form' => $form,
            ]
        );
        return $view;
    }
}

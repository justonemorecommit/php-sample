<?php

namespace App\Expense\Controllers;

use App\Common\Controllers\AppController;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Expense\Models\Expense;
use DateTime;

class ExpenseController extends AppController
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);

        $this->container = $container;
        $this->view = $this->container->get('view');
    }

    public function getRules()
    {
        return [
            'category' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'required'
        ];
    }

    public function index(Request $request, Response $response)
    {
        $expenses = Expense::getByUser($this->em, $this->auth->user()->id);

        echo $this->view->render('@expense/list.twig', [
            'expenses' => $expenses
        ]);

        return $response;
    }

    public function create(Request $request, Response $response)
    {
        echo $this->view->render('@expense/edit.twig', [
            'expense' => null
        ]);

        return $response;
    }

    public function store(Request $request, Response $response)
    {
        $errors = $this->validate($request, $this->getRules());
        if ($errors) {
            echo $this->view->render('@expense/edit.twig', [
                'expense' => null,
                'fields' => $request->getParsedBody(),
                'errors' => $errors
            ]);

            return $response;
        }

        $expense = new Expense($request->getParsedBody());
        $expense->date =  new DateTime($request->getAttribute('date'));
        $expense->setUserId($this->auth->user()->id);

        $this->em->persist($expense);
        $this->em->flush();

        $this->session->setStatus([
            'status' => 'success',
            'message' => 'An expense was successfully created.'
        ]);

        return $response->withStatus(302)
            ->withHeader('Location', '/expenses');
    }

    public function edit(Request $request, Response $response, array $args)
    {
        $expense = $this->findOr404($this->em, Expense::class, $args['id']);

        echo $this->view->render('@expense/edit.twig', [
            'expense' => $expense
        ]);

        return $response;
    }

    public function update(Request $request, Response $response, array $args)
    {
        $errors = $this->validate($request, $this->getRules());

        $expense = $this->findOr404($this->em, Expense::class, $args['id']);

        if ($errors) {
            echo $this->view->render('@expense/edit.twig', [
                'errors' => $errors,
                'fields' => $request->getParsedBody(),
                'expense' => $expense
            ]);

            return $response;
        }

        $expense->setAttributes($request->getParsedBody());
        $expense->date = date_create($request->getParsedBody()['date']);
        $this->em->persist($expense);
        $this->em->flush();

        return $this->redirect($response, '/expenses', [
            'status' => 'success',
            'message' => 'The expense was updated successfully.'
        ]);
    }

    public function destroy($request, $response, $args)
    {
        $expense = $this->findOr404($this->em, Expense::class, $args['id']);
        if (!$expense) {
            return $response;
        }

        $this->em->remove($expense);
        $this->em->flush();

        return $this->redirect($response, '/expenses', [
            'status' => 'success',
            'message' => 'The expense was removed successfully!'
        ]);
    }
}

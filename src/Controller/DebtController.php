<?php

namespace App\Controller;

use App\Entity\Debt;
use App\Entity\Person;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Doctrine\ORM\EntityManagerInterface;

class DebtController extends AbstractController
{
    /**
     * @Route("/debt", name="debt")
     */
    public function index(): Response
    {
        return $this->render('debt/index.html.twig', [
            'controller_name' => 'DebtController',
        ]);
    }

    /**
     * @Route("/debt/create")
     */
    public function createDebt(ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {

        $person = new Person();
        $person->setName("David López Pascual");
        $person->setEmail("davidanlopez@gmail.com");
        $person->setPassword("1234567890");
        $person->setCreationDate(new \DateTime());

        $debt = new Debt();
        $debt->setName("Compra Netflix");
        $debt->setDescription("Mensualidad Netflix");
        $debt->setAmount("1234567890");
        $debt->setCreationDate(new \DateTime());
        $debt->setPerson($person);

        // tell Doctrine you want to (eventually) save the Debt (no queries yet)
        $entityManager->persist($debt);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $errors = $validator->validate($debt);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        return new Response('Saved new debt with id ' . $debt->getId());
    }

    /**
     * @Route("/debt/all")
     */
    public function show()
    {
        $debts = $this->getDoctrine()->getRepository(Debt::class)->findAll();

        dd($debts); die();
        if (!$debts) {
            throw $this->createNotFoundException(
                'No person found for'
            );
        }

        //return new Response('La persona encontrada se llama: ' . $person->getName());

        // or render a template
        // in the template, print things with {{ person.name }}
        return $this->render('debt/index.html.twig', ['debts' => $debts]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Person;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Doctrine\ORM\EntityManagerInterface;

class PersonController extends AbstractController
{
    /**
     * @Route("/person", name="person")
     */
    public function index(): Response
    {
        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }
    /**
     * @Route("/person/create")
     */
    public function createPerson(ValidatorInterface $validator, EntityManagerInterface $entityManager): Response
    {

        $person = new Person();
        $person->setName("David López");
        $person->setEmail("davidanlopez@gmail.com");
        $person->setPassword("1234567890");
        $person->setCreationDate(new \DateTime());

        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        //$entityManager = $this->getDoctrine()->getManager();
        // tell Doctrine you want to (eventually) save the Person (no queries yet)
        $entityManager->persist($person);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        $errors = $validator->validate($person);
        if (count($errors) > 0) {
            return new Response((string) $errors, 400);
        }

        return new Response('Saved new person with id ' . $person->getId());
    }
    /**
     * @Route("/person/{id}")
     */
    public function show($id)
    {
        $person = $this->getDoctrine()->getRepository(Person::class)->find($id);

        if (!$person) {
            throw $this->createNotFoundException(
                'No person found for id ' . $id
            );
        }

        //return new Response('La persona encontrada se llama: ' . $person->getName());

        // or render a template
        // in the template, print things with {{ person.name }}
        return $this->render('person/index.html.twig', ['person' => $person]);
    }

    /**
     * @Route("/person-find-all")
     */
    public function showAll()
    {
        $persons = $this->getDoctrine()->getRepository(Person::class)->findAll();

        if (!$persons) {
            throw $this->createNotFoundException(
                'No person found for'
            );
        }

        //return new Response('La persona encontrada se llama: ' . $person->getName());

        // or render a template
        // in the template, print things with {{ person.name }}
        return $this->render('person/index.html.twig', ['persons' => $persons]);
    }
}

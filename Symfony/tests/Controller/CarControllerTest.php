<?php

namespace App\Tests\Controller;

use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CarControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $carRepository;
    private string $path = '/car/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->carRepository = $this->manager->getRepository(Car::class);

        foreach ($this->carRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Car index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'car[brand]' => 'Testing',
            'car[model]' => 'Testing',
            'car[year]' => 'Testing',
            'car[pricePerDay]' => 'Testing',
            'car[category]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->carRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Car();
        $fixture->setBrand('My Title');
        $fixture->setModel('My Title');
        $fixture->setYear('My Title');
        $fixture->setPricePerDay('My Title');
        $fixture->setCategory('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Car');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Car();
        $fixture->setBrand('Value');
        $fixture->setModel('Value');
        $fixture->setYear('Value');
        $fixture->setPricePerDay('Value');
        $fixture->setCategory('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'car[brand]' => 'Something New',
            'car[model]' => 'Something New',
            'car[year]' => 'Something New',
            'car[pricePerDay]' => 'Something New',
            'car[category]' => 'Something New',
        ]);

        self::assertResponseRedirects('/car/');

        $fixture = $this->carRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getBrand());
        self::assertSame('Something New', $fixture[0]->getModel());
        self::assertSame('Something New', $fixture[0]->getYear());
        self::assertSame('Something New', $fixture[0]->getPricePerDay());
        self::assertSame('Something New', $fixture[0]->getCategory());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Car();
        $fixture->setBrand('Value');
        $fixture->setModel('Value');
        $fixture->setYear('Value');
        $fixture->setPricePerDay('Value');
        $fixture->setCategory('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/car/');
        self::assertSame(0, $this->carRepository->count([]));
    }
}

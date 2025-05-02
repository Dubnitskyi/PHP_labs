<?php

namespace App\Tests\Controller;

use App\Entity\Rental;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RentalControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $rentalRepository;
    private string $path = '/rental/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->rentalRepository = $this->manager->getRepository(Rental::class);

        foreach ($this->rentalRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Rental index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'rental[rentFrom]' => 'Testing',
            'rental[rentTo]' => 'Testing',
            'rental[clients]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->rentalRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Rental();
        $fixture->setRentFrom('My Title');
        $fixture->setRentTo('My Title');
        $fixture->setClient('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Rental');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Rental();
        $fixture->setRentFrom('Value');
        $fixture->setRentTo('Value');
        $fixture->setClient('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'rental[rentFrom]' => 'Something New',
            'rental[rentTo]' => 'Something New',
            'rental[clients]' => 'Something New',
        ]);

        self::assertResponseRedirects('/rental/');

        $fixture = $this->rentalRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getRentFrom());
        self::assertSame('Something New', $fixture[0]->getRentTo());
        self::assertSame('Something New', $fixture[0]->getClient());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Rental();
        $fixture->setRentFrom('Value');
        $fixture->setRentTo('Value');
        $fixture->setClient('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/rental/');
        self::assertSame(0, $this->rentalRepository->count([]));
    }
}

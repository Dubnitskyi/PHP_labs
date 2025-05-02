<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250430131021 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, brand VARCHAR(255) DEFAULT NULL, model VARCHAR(255) DEFAULT NULL, year INT DEFAULT NULL, price_per_day DOUBLE PRECISION DEFAULT NULL, INDEX IDX_773DE69D12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE car_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, phone VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, rental_id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, paid_at DATE NOT NULL, method VARCHAR(50) NOT NULL, INDEX IDX_6D28840DA7CF2329 (rental_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, price  DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE rental (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, rent_from DATE NOT NULL, rent_to DATE NOT NULL, INDEX IDX_1619C27D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE car ADD CONSTRAINT FK_773DE69D12469DE2 FOREIGN KEY (category_id) REFERENCES car_category (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment ADD CONSTRAINT FK_6D28840DA7CF2329 FOREIGN KEY (rental_id) REFERENCES rental (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rental ADD CONSTRAINT FK_1619C27D19EB6921 FOREIGN KEY (client_id) REFERENCES clients (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE car DROP FOREIGN KEY FK_773DE69D12469DE2
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DA7CF2329
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE rental DROP FOREIGN KEY FK_1619C27D19EB6921
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE car_category
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE clients
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE payment
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE product
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE rental
        SQL);
    }
}

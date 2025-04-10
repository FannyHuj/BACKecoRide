<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250405151928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review ADD trip_id INT DEFAULT NULL, CHANGE notation notation INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id)');
        $this->addSql('CREATE INDEX IDX_794381C6A5BC2E0E ON review (trip_id)');
        $this->addSql('ALTER TABLE trip ADD credit_price INT NOT NULL, DROP price');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A5BC2E0E');
        $this->addSql('DROP INDEX IDX_794381C6A5BC2E0E ON review');
        $this->addSql('ALTER TABLE review DROP trip_id, CHANGE notation notation VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE trip ADD price DOUBLE PRECISION NOT NULL, DROP credit_price');
    }
}

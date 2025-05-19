<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250518142211 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE driver_preferences (id INT AUTO_INCREMENT NOT NULL, animals TINYINT(1) DEFAULT NULL, smoking TINYINT(1) DEFAULT NULL, tags JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD driver_preferences_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EFE9B7A6 FOREIGN KEY (driver_preferences_id) REFERENCES driver_preferences (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649EFE9B7A6 ON user (driver_preferences_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EFE9B7A6');
        $this->addSql('DROP TABLE driver_preferences');
        $this->addSql('DROP INDEX UNIQ_8D93D649EFE9B7A6 ON user');
        $this->addSql('ALTER TABLE user DROP driver_preferences_id');
    }
}

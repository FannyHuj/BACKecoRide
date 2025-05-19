<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250519154931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report_trip ADD report_owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE report_trip ADD CONSTRAINT FK_57A18C07E5CF884 FOREIGN KEY (report_owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_57A18C07E5CF884 ON report_trip (report_owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE report_trip DROP FOREIGN KEY FK_57A18C07E5CF884');
        $this->addSql('DROP INDEX IDX_57A18C07E5CF884 ON report_trip');
        $this->addSql('ALTER TABLE report_trip DROP report_owner_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250522223012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id SERIAL NOT NULL, user_id INT DEFAULT NULL, model VARCHAR(50) NOT NULL, registration VARCHAR(50) NOT NULL, energy VARCHAR(50) NOT NULL, color VARCHAR(50) NOT NULL, first_registration_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, brand VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_773DE69DA76ED395 ON car (user_id)');
        $this->addSql('CREATE TABLE driver_preferences (id SERIAL NOT NULL, animals BOOLEAN DEFAULT NULL, smoking BOOLEAN DEFAULT NULL, tags JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE members (id SERIAL NOT NULL, driver_preferences_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name VARCHAR(50) DEFAULT NULL, first_name VARCHAR(50) DEFAULT NULL, phone_number VARCHAR(50) DEFAULT NULL, address VARCHAR(50) DEFAULT NULL, birth_date DATE DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, credit INT NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45A0D2FFEFE9B7A6 ON members (driver_preferences_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON members (email)');
        $this->addSql('CREATE TABLE report_trip (id SERIAL NOT NULL, trip_id INT DEFAULT NULL, report_owner_id INT DEFAULT NULL, date DATE DEFAULT NULL, detail VARCHAR(255) DEFAULT NULL, publish BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57A18C0A5BC2E0E ON report_trip (trip_id)');
        $this->addSql('CREATE INDEX IDX_57A18C07E5CF884 ON report_trip (report_owner_id)');
        $this->addSql('CREATE TABLE review (id SERIAL NOT NULL, owner_id INT DEFAULT NULL, trip_id INT DEFAULT NULL, comment VARCHAR(50) DEFAULT NULL, notation INT DEFAULT NULL, publish BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_794381C67E3C61F9 ON review (owner_id)');
        $this->addSql('CREATE INDEX IDX_794381C6A5BC2E0E ON review (trip_id)');
        $this->addSql('CREATE TABLE trip (id SERIAL NOT NULL, car_id INT DEFAULT NULL, depart_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, depart_location VARCHAR(50) NOT NULL, arrival_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, arrival_location VARCHAR(50) NOT NULL, status VARCHAR(255) NOT NULL, place_number INT NOT NULL, credit_price INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7656F53BC3C6F69F ON trip (car_id)');
        $this->addSql('CREATE TABLE user_trip (user_id INT NOT NULL, trip_id INT NOT NULL, driver BOOLEAN NOT NULL, booking_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(user_id, trip_id))');
        $this->addSql('CREATE INDEX IDX_CD7B9F2A76ED395 ON user_trip (user_id)');
        $this->addSql('CREATE INDEX IDX_CD7B9F2A5BC2E0E ON user_trip (trip_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE members ADD CONSTRAINT FK_45A0D2FFEFE9B7A6 FOREIGN KEY (driver_preferences_id) REFERENCES driver_preferences (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE report_trip ADD CONSTRAINT FK_57A18C0A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE report_trip ADD CONSTRAINT FK_57A18C07E5CF884 FOREIGN KEY (report_owner_id) REFERENCES members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C67E3C61F9 FOREIGN KEY (owner_id) REFERENCES members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE trip ADD CONSTRAINT FK_7656F53BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_trip ADD CONSTRAINT FK_CD7B9F2A76ED395 FOREIGN KEY (user_id) REFERENCES members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_trip ADD CONSTRAINT FK_CD7B9F2A5BC2E0E FOREIGN KEY (trip_id) REFERENCES trip (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE car DROP CONSTRAINT FK_773DE69DA76ED395');
        $this->addSql('ALTER TABLE members DROP CONSTRAINT FK_45A0D2FFEFE9B7A6');
        $this->addSql('ALTER TABLE report_trip DROP CONSTRAINT FK_57A18C0A5BC2E0E');
        $this->addSql('ALTER TABLE report_trip DROP CONSTRAINT FK_57A18C07E5CF884');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C67E3C61F9');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6A5BC2E0E');
        $this->addSql('ALTER TABLE trip DROP CONSTRAINT FK_7656F53BC3C6F69F');
        $this->addSql('ALTER TABLE user_trip DROP CONSTRAINT FK_CD7B9F2A76ED395');
        $this->addSql('ALTER TABLE user_trip DROP CONSTRAINT FK_CD7B9F2A5BC2E0E');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE driver_preferences');
        $this->addSql('DROP TABLE members');
        $this->addSql('DROP TABLE report_trip');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE trip');
        $this->addSql('DROP TABLE user_trip');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

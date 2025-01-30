<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250130094453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE request (id SERIAL NOT NULL, request_type_id_id INT NOT NULL, collaborator_id_id INT NOT NULL, department_id INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, start_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, end_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, receipt_file VARCHAR(255) DEFAULT NULL, comment TEXT NOT NULL, answer_comment TEXT DEFAULT NULL, answer BOOLEAN DEFAULT NULL, answer_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B978F9F39B1DE1A ON request (request_type_id_id)');
        $this->addSql('CREATE INDEX IDX_3B978F9F60844807 ON request (collaborator_id_id)');
        $this->addSql('COMMENT ON COLUMN request.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN request.start_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN request.end_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN request.answer_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE request_type (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F39B1DE1A FOREIGN KEY (request_type_id_id) REFERENCES request_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE request ADD CONSTRAINT FK_3B978F9F60844807 FOREIGN KEY (collaborator_id_id) REFERENCES person (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE request DROP CONSTRAINT FK_3B978F9F39B1DE1A');
        $this->addSql('ALTER TABLE request DROP CONSTRAINT FK_3B978F9F60844807');
        $this->addSql('DROP TABLE request');
        $this->addSql('DROP TABLE request_type');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210416210622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT fk_327c5de77a7b68e1');
        $this->addSql('DROP SEQUENCE user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE public.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE public."user" (id INT NOT NULL, chief_id INT DEFAULT NULL, email VARCHAR(180) DEFAULT NULL, company_name VARCHAR(180) DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_327C5DE7E7927C74 ON public."user" (email)');
        $this->addSql('CREATE INDEX IDX_327C5DE77A7B68E1 ON public."user" (chief_id)');
        $this->addSql('ALTER TABLE public."user" ADD CONSTRAINT FK_327C5DE77A7B68E1 FOREIGN KEY (chief_id) REFERENCES public."user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        //$this->addSql('DROP TABLE "user"');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE public."user" DROP CONSTRAINT FK_327C5DE77A7B68E1');
        $this->addSql('DROP SEQUENCE public.user_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, chief_id INT DEFAULT NULL, email VARCHAR(180) DEFAULT NULL, company_name VARCHAR(180) DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_327c5de7e7927c74 ON "user" (email)');
        $this->addSql('CREATE INDEX idx_327c5de77a7b68e1 ON "user" (chief_id)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT fk_327c5de77a7b68e1 FOREIGN KEY (chief_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE public."user"');
    }
}

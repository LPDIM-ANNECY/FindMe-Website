<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414203425 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE itinerary_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE public.user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE category (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE itinerary (id INT NOT NULL, name VARCHAR(255) NOT NULL, duration DOUBLE PRECISION NOT NULL, length DOUBLE PRECISION NOT NULL, active BOOLEAN NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE itinerary_place (itinerary_id INT NOT NULL, place_id INT NOT NULL, PRIMARY KEY(itinerary_id, place_id))');
        $this->addSql('CREATE INDEX IDX_181CE54A15F737B2 ON itinerary_place (itinerary_id)');
        $this->addSql('CREATE INDEX IDX_181CE54ADA6A219 ON itinerary_place (place_id)');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, category_id INT NOT NULL, name VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, difficulty INT NOT NULL, radius_type INT NOT NULL, active BOOLEAN NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_741D53CD12469DE2 ON place (category_id)');
        $this->addSql('CREATE TABLE public."user" (id INT NOT NULL, email VARCHAR(180) DEFAULT NULL, company_name VARCHAR(180) DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_327C5DE7E7927C74 ON public."user" (email)');
        $this->addSql('ALTER TABLE itinerary_place ADD CONSTRAINT FK_181CE54A15F737B2 FOREIGN KEY (itinerary_id) REFERENCES itinerary (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE itinerary_place ADD CONSTRAINT FK_181CE54ADA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place DROP CONSTRAINT FK_741D53CD12469DE2');
        $this->addSql('ALTER TABLE itinerary_place DROP CONSTRAINT FK_181CE54A15F737B2');
        $this->addSql('ALTER TABLE itinerary_place DROP CONSTRAINT FK_181CE54ADA6A219');
        $this->addSql('DROP SEQUENCE category_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE itinerary_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE public.user_id_seq CASCADE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE itinerary');
        $this->addSql('DROP TABLE itinerary_place');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE public."user"');
    }
}

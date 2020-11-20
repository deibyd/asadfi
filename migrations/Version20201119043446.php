<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201119043446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE debt CHANGE person_id person_id INT DEFAULT NULL, CHANGE creation_date creation_date DATETIME DEFAULT NULL, CHANGE last_update last_update DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE person CHANGE creation_date creation_date DATETIME DEFAULT NULL, CHANGE last_update last_update DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE debt CHANGE person_id person_id INT DEFAULT NULL, CHANGE creation_date creation_date DATETIME DEFAULT \'NULL\', CHANGE last_update last_update DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE person CHANGE creation_date creation_date DATETIME DEFAULT \'NULL\', CHANGE last_update last_update DATETIME DEFAULT \'NULL\'');
    }
}

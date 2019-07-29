<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190729082000 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shedules DROP FOREIGN KEY shedules_ibfk_1');
        $this->addSql('ALTER TABLE shedules DROP FOREIGN KEY shedules_ibfk_2');
        $this->addSql('ALTER TABLE shedules DROP FOREIGN KEY shedules_ibfk_3');
        $this->addSql('ALTER TABLE shedules DROP FOREIGN KEY shedules_ibfk_4');
        $this->addSql('DROP INDEX arrival_airport_id ON shedules');
        $this->addSql('DROP INDEX flight_id ON shedules');
        $this->addSql('DROP INDEX transporter_id ON shedules');
        $this->addSql('DROP INDEX departure_airport_id ON shedules');
        $this->addSql('ALTER TABLE shedules CHANGE duration duration VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE shedules CHANGE duration duration INT NOT NULL');
        $this->addSql('ALTER TABLE shedules ADD CONSTRAINT shedules_ibfk_1 FOREIGN KEY (transporter_id) REFERENCES transporters (id)');
        $this->addSql('ALTER TABLE shedules ADD CONSTRAINT shedules_ibfk_2 FOREIGN KEY (flight_id) REFERENCES flights (id)');
        $this->addSql('ALTER TABLE shedules ADD CONSTRAINT shedules_ibfk_3 FOREIGN KEY (departure_airport_id) REFERENCES airports (id)');
        $this->addSql('ALTER TABLE shedules ADD CONSTRAINT shedules_ibfk_4 FOREIGN KEY (arrival_airport_id) REFERENCES airports (id)');
        $this->addSql('CREATE INDEX arrival_airport_id ON shedules (arrival_airport_id)');
        $this->addSql('CREATE INDEX flight_id ON shedules (flight_id)');
        $this->addSql('CREATE INDEX transporter_id ON shedules (transporter_id)');
        $this->addSql('CREATE INDEX departure_airport_id ON shedules (departure_airport_id)');
    }
}

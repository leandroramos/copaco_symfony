<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180111174648 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE equipamento ADD rede_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipamento ADD CONSTRAINT FK_B092C63247E84A0B FOREIGN KEY (rede_id) REFERENCES rede (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_B092C63247E84A0B ON equipamento (rede_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE equipamento DROP CONSTRAINT FK_B092C63247E84A0B');
        $this->addSql('DROP INDEX IDX_B092C63247E84A0B');
        $this->addSql('ALTER TABLE equipamento DROP rede_id');
    }
}

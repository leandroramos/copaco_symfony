<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180111171455 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE equipamento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rede_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipamento (id INT NOT NULL, patrimonio VARCHAR(255) NOT NULL, ip VARCHAR(255) NOT NULL, macaddress VARCHAR(255) NOT NULL, local VARCHAR(255) NOT NULL, vencimento TIMESTAMP(0) WITH TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rede (id INT NOT NULL, nome VARCHAR(255) NOT NULL, iprede VARCHAR(255) NOT NULL, cidr VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE equipamento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rede_id_seq CASCADE');
        $this->addSql('DROP TABLE equipamento');
        $this->addSql('DROP TABLE rede');
    }
}

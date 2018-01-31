<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180122225206 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE equipamento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rede_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE local_user_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE equipamento (id INT NOT NULL, rede_id INT DEFAULT NULL, descricaosempatrimonio VARCHAR(255) DEFAULT NULL, naopatromoniado BOOLEAN NOT NULL, patrimonio VARCHAR(10) DEFAULT NULL, macaddress VARCHAR(255) NOT NULL, local VARCHAR(255) NOT NULL, vencimento DATE NOT NULL, ip VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B092C63242CD65F6 ON equipamento (macaddress)');
        $this->addSql('CREATE INDEX IDX_B092C63247E84A0B ON equipamento (rede_id)');
        $this->addSql('CREATE TABLE rede (id INT NOT NULL, nome VARCHAR(255) NOT NULL, iprede VARCHAR(255) NOT NULL, cidr INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE local_user (id INT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN local_user.roles IS \'(DC2Type:json_array)\'');
        $this->addSql('ALTER TABLE equipamento ADD CONSTRAINT FK_B092C63247E84A0B FOREIGN KEY (rede_id) REFERENCES rede (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE equipamento DROP CONSTRAINT FK_B092C63247E84A0B');
        $this->addSql('DROP SEQUENCE equipamento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rede_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE local_user_id_seq CASCADE');
        $this->addSql('DROP TABLE equipamento');
        $this->addSql('DROP TABLE rede');
        $this->addSql('DROP TABLE local_user');
    }
}

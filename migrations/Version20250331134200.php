<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331134200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE country (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(2) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__l3_user AS SELECT id, login, roles, password, name, country FROM l3_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE l3_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE l3_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
            , password VARCHAR(255) NOT NULL, name VARCHAR(200) NOT NULL, country VARCHAR(2) NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO l3_user (id, login, roles, password, name, country) SELECT id, login, roles, password, name, country FROM __temp__l3_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__l3_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON l3_user (login)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE country
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__l3_user AS SELECT id, login, roles, password, name, country FROM l3_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE l3_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE l3_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
            , password VARCHAR(255) NOT NULL, name VARCHAR(200) NOT NULL, country VARCHAR(2) DEFAULT 'FR' NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO l3_user (id, login, roles, password, name, country) SELECT id, login, roles, password, name, country FROM __temp__l3_user
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__l3_user
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON l3_user (login)
        SQL);
    }
}

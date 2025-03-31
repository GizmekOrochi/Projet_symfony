<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331135825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__l3_CartItem AS SELECT id, cart_id, product_id FROM l3_CartItem
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE l3_CartItem
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE l3_CartItem (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, cart_id INTEGER NOT NULL, product_id INTEGER NOT NULL, CONSTRAINT FK_41603F291AD5CDBF FOREIGN KEY (cart_id) REFERENCES l3_Cart (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_41603F294584665A FOREIGN KEY (product_id) REFERENCES l3_FootballPlayer (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO l3_CartItem (id, cart_id, product_id) SELECT id, cart_id, product_id FROM __temp__l3_CartItem
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__l3_CartItem
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_41603F294584665A ON l3_CartItem (product_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_41603F291AD5CDBF ON l3_CartItem (cart_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE l3_CartItem ADD COLUMN quantity INTEGER NOT NULL
        SQL);
    }
}

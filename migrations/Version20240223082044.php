<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240223082044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE wishlist (id INT AUTO_INCREMENT NOT NULL, id_user LONGTEXT NOT NULL, album_link VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE album CHANGE fruit fruit VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD uuid LONGTEXT DEFAULT NULL, CHANGE mail mail VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE wishlist');
        $this->addSql('ALTER TABLE user DROP uuid, CHANGE mail mail VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE album CHANGE fruit fruit VARCHAR(100) NOT NULL');
    }
}

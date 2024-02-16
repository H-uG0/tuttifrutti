<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213124855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'First migration';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, artiste VARCHAR(100) DEFAULT NULL, styles LONGTEXT DEFAULT NULL, genres LONGTEXT DEFAULT NULL, sortie VARCHAR(50) DEFAULT NULL, tracklist LONGTEXT DEFAULT NULL, label VARCHAR(150) DEFAULT NULL, format LONGTEXT DEFAULT NULL, pays VARCHAR(200) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, vrai_nom VARCHAR(200) DEFAULT NULL, description LONGTEXT DEFAULT NULL, sites LONGTEXT DEFAULT NULL, alias VARCHAR(200) DEFAULT NULL, membres LONGTEXT DEFAULT NULL, variantes LONGTEXT DEFAULT NULL, groupes LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE label (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, description LONGTEXT DEFAULT NULL, contact_info LONGTEXT DEFAULT NULL, liens LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, lien_discogs LONGTEXT NOT NULL, type VARCHAR(50) NOT NULL, id_album_id INT DEFAULT NULL, id_label_id INT DEFAULT NULL, id_artiste_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_29A5EC2741EC475A (id_album_id), UNIQUE INDEX UNIQ_29A5EC276362C3AC (id_label_id), UNIQUE INDEX UNIQ_29A5EC278458D893 (id_artiste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(50) DEFAULT NULL, nom VARCHAR(70) DEFAULT NULL, mail VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2741EC475A FOREIGN KEY (id_album_id) REFERENCES album (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC276362C3AC FOREIGN KEY (id_label_id) REFERENCES label (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC278458D893 FOREIGN KEY (id_artiste_id) REFERENCES artiste (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2741EC475A');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC276362C3AC');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC278458D893');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE label');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323125555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, cover_image VARCHAR(255) NOT NULL, date_publication DATE NOT NULL, intro_text LONGTEXT NOT NULL, body_texts LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_titles LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_images LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_galeries LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_cta LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_links LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_videos LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_pdf LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', body_html_element LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', lectures INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, featured TINYINT(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_23A0E66BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, slug VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_article (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE tag_article');
    }
}

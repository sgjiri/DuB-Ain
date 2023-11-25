<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231124101924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, site_id_id INT DEFAULT NULL, site_id INT DEFAULT NULL, thumbnail VARCHAR(150) NOT NULL, attachment VARCHAR(150) DEFAULT NULL, room VARCHAR(255) NOT NULL, INDEX IDX_C53D045FBB1E4E52 (site_id_id), INDEX IDX_C53D045FF6BD1646 (site_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBB1E4E52 FOREIGN KEY (site_id_id) REFERENCES site (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FF6BD1646 FOREIGN KEY (site_id) REFERENCES site (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBB1E4E52');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FF6BD1646');
        $this->addSql('DROP TABLE image');
    }
}

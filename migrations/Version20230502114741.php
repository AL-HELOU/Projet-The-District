<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502114741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD cat_libelle VARCHAR(50) NOT NULL, ADD cat_image VARCHAR(50) NOT NULL, ADD cat_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE plat ADD plat_libelle VARCHAR(50) NOT NULL, ADD plat_description LONGTEXT NOT NULL, ADD plat_prix NUMERIC(6, 2) NOT NULL, ADD plat_image VARCHAR(50) NOT NULL, ADD plat_active TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP cat_libelle, DROP cat_image, DROP cat_active');
        $this->addSql('ALTER TABLE plat DROP plat_libelle, DROP plat_description, DROP plat_prix, DROP plat_image, DROP plat_active');
    }
}

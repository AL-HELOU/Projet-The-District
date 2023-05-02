<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230502120210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande ADD com_total NUMERIC(10, 2) NOT NULL, ADD com_datecommande DATE NOT NULL, ADD com_etat INT NOT NULL');
        $this->addSql('ALTER TABLE detail ADD det_quantite INT NOT NULL');
        $this->addSql('ALTER TABLE plat CHANGE plat_image plat_image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD util_email VARCHAR(50) NOT NULL, ADD util_password VARCHAR(255) NOT NULL, ADD util_nom VARCHAR(50) NOT NULL, ADD util_prenom VARCHAR(50) NOT NULL, ADD util_telephone VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP util_email, DROP util_password, DROP util_nom, DROP util_prenom, DROP util_telephone');
        $this->addSql('ALTER TABLE commande DROP com_total, DROP com_datecommande, DROP com_etat');
        $this->addSql('ALTER TABLE detail DROP det_quantite');
        $this->addSql('ALTER TABLE plat CHANGE plat_image plat_image VARCHAR(50) NOT NULL');
    }
}

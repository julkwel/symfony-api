<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429183747 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sk_cong (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, motif LONGTEXT DEFAULT NULL, ets_nom VARCHAR(100) DEFAULT NULL, ets_adresse LONGTEXT DEFAULT NULL, ets_responsable VARCHAR(100) DEFAULT NULL, ets_phone VARCHAR(100) DEFAULT NULL, ets_email VARCHAR(150) DEFAULT NULL, ets_logo VARCHAR(255) DEFAULT NULL, anne_scolaire_debut DATETIME DEFAULT NULL, anne_scolaire_fin DATETIME DEFAULT NULL, INDEX IDX_DA2CD469A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sk_cong ADD CONSTRAINT FK_DA2CD469A76ED395 FOREIGN KEY (user_id) REFERENCES sk_user (id)');
        $this->addSql('ALTER TABLE sk_classe DROP mat_coeff');
        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA623B6832');
        $this->addSql('ALTER TABLE sk_matiere ADD mat_coeff VARCHAR(100) DEFAULT NULL, ADD matClasse INT DEFAULT NULL, CHANGE mat_nom mat_nom VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA76AA3D43 FOREIGN KEY (matClasse) REFERENCES sk_classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA623B6832 FOREIGN KEY (matProf) REFERENCES sk_user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere (matClasse)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE sk_cong');
        $this->addSql('ALTER TABLE sk_classe ADD mat_coeff VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA76AA3D43');
        $this->addSql('ALTER TABLE sk_matiere DROP FOREIGN KEY FK_A1BC20CA623B6832');
        $this->addSql('DROP INDEX IDX_A1BC20CA76AA3D43 ON sk_matiere');
        $this->addSql('ALTER TABLE sk_matiere DROP mat_coeff, DROP matClasse, CHANGE mat_nom mat_nom VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE sk_matiere ADD CONSTRAINT FK_A1BC20CA623B6832 FOREIGN KEY (matProf) REFERENCES sk_user (id) ON DELETE SET NULL');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513124240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Crear columna nullable
        $this->addSql(<<<'SQL'
        ALTER TABLE conference ADD slug VARCHAR(255)
    SQL);

        // Rellenar datos
        $this->addSql(<<<'SQL'
        UPDATE conference SET slug = CONCAT(LOWER(city), '-', year)
    SQL);

        // Hacer NOT NULL correctamente en MySQL
        $this->addSql(<<<'SQL'
        ALTER TABLE conference MODIFY slug VARCHAR(255) NOT NULL
    SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE conference DROP slug
        SQL);
    }
}

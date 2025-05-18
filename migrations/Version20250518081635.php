<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250518081635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE event (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', owner_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', title VARCHAR(255) NOT NULL, start_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', end_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', address VARCHAR(255) DEFAULT NULL, latitude VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) DEFAULT NULL, INDEX IDX_3BAE0AA77E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE event_participant (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', event_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', owner_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', target_id BINARY(16) DEFAULT NULL COMMENT '(DC2Type:uuid)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', type VARCHAR(255) NOT NULL, INDEX IDX_7C16B89171F7E88B (event_id), INDEX IDX_7C16B8917E3C61F9 (owner_id), INDEX IDX_7C16B891158E0B66 (target_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE `user` (id BINARY(16) NOT NULL COMMENT '(DC2Type:uuid)', email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, avatar LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA77E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_participant ADD CONSTRAINT FK_7C16B89171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_participant ADD CONSTRAINT FK_7C16B8917E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_participant ADD CONSTRAINT FK_7C16B891158E0B66 FOREIGN KEY (target_id) REFERENCES `user` (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA77E3C61F9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_participant DROP FOREIGN KEY FK_7C16B89171F7E88B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_participant DROP FOREIGN KEY FK_7C16B8917E3C61F9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE event_participant DROP FOREIGN KEY FK_7C16B891158E0B66
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE event_participant
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE `user`
        SQL);
    }
}

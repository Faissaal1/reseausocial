<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221220152901 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE follows (id INT AUTO_INCREMENT NOT NULL, follower_id INT DEFAULT NULL, following_id INT DEFAULT NULL, INDEX IDX_4B638A73AC24F853 (follower_id), INDEX IDX_4B638A731816E3A3 (following_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE follows ADD CONSTRAINT FK_4B638A73AC24F853 FOREIGN KEY (follower_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE follows ADD CONSTRAINT FK_4B638A731816E3A3 FOREIGN KEY (following_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE follows DROP FOREIGN KEY FK_4B638A73AC24F853');
        $this->addSql('ALTER TABLE follows DROP FOREIGN KEY FK_4B638A731816E3A3');
        $this->addSql('DROP TABLE follows');
    }
}

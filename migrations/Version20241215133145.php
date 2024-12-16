<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241215133145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE credit_programm (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(500) NOT NULL, interest_rate INT NOT NULL, monthly_payment INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE credit_req (id INT AUTO_INCREMENT NOT NULL, programm_id_id INT NOT NULL, initial_payment INT NOT NULL, loan_term INT NOT NULL, INDEX IDX_38C79F609EC0F8EA (programm_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE credit_req ADD CONSTRAINT FK_38C79F609EC0F8EA FOREIGN KEY (programm_id_id) REFERENCES credit_programm (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_req DROP FOREIGN KEY FK_38C79F609EC0F8EA');
        $this->addSql('DROP TABLE credit_programm');
        $this->addSql('DROP TABLE credit_req');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241215134611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_req ADD car_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE credit_req ADD CONSTRAINT FK_38C79F60A0EF1B80 FOREIGN KEY (car_id_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_38C79F60A0EF1B80 ON credit_req (car_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE credit_req DROP FOREIGN KEY FK_38C79F60A0EF1B80');
        $this->addSql('DROP INDEX IDX_38C79F60A0EF1B80 ON credit_req');
        $this->addSql('ALTER TABLE credit_req DROP car_id_id');
    }
}

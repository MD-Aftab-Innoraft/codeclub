<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240418055958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exam_user_map_exams DROP FOREIGN KEY FK_77F238F62D84E958');
        $this->addSql('ALTER TABLE exam_user_map_exams DROP FOREIGN KEY FK_77F238F6602E93A9');
        $this->addSql('ALTER TABLE exam_user_map_user DROP FOREIGN KEY FK_4F4A60DB2D84E958');
        $this->addSql('ALTER TABLE exam_user_map_user DROP FOREIGN KEY FK_4F4A60DBA76ED395');
        $this->addSql('DROP TABLE exam_user_map_exams');
        $this->addSql('DROP TABLE exam_user_map_user');
        $this->addSql('ALTER TABLE exam_user_map ADD user_id_id INT NOT NULL, ADD exam_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE exam_user_map ADD CONSTRAINT FK_3BDF84039D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE exam_user_map ADD CONSTRAINT FK_3BDF84032DA198E7 FOREIGN KEY (exam_id_id) REFERENCES exams (id)');
        $this->addSql('CREATE INDEX IDX_3BDF84039D86650F ON exam_user_map (user_id_id)');
        $this->addSql('CREATE INDEX IDX_3BDF84032DA198E7 ON exam_user_map (exam_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exam_user_map_exams (exam_user_map_id INT NOT NULL, exams_id INT NOT NULL, INDEX IDX_77F238F6602E93A9 (exams_id), INDEX IDX_77F238F62D84E958 (exam_user_map_id), PRIMARY KEY(exam_user_map_id, exams_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE exam_user_map_user (exam_user_map_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_4F4A60DBA76ED395 (user_id), INDEX IDX_4F4A60DB2D84E958 (exam_user_map_id), PRIMARY KEY(exam_user_map_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE exam_user_map_exams ADD CONSTRAINT FK_77F238F62D84E958 FOREIGN KEY (exam_user_map_id) REFERENCES exam_user_map (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_user_map_exams ADD CONSTRAINT FK_77F238F6602E93A9 FOREIGN KEY (exams_id) REFERENCES exams (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_user_map_user ADD CONSTRAINT FK_4F4A60DB2D84E958 FOREIGN KEY (exam_user_map_id) REFERENCES exam_user_map (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_user_map_user ADD CONSTRAINT FK_4F4A60DBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exam_user_map DROP FOREIGN KEY FK_3BDF84039D86650F');
        $this->addSql('ALTER TABLE exam_user_map DROP FOREIGN KEY FK_3BDF84032DA198E7');
        $this->addSql('DROP INDEX IDX_3BDF84039D86650F ON exam_user_map');
        $this->addSql('DROP INDEX IDX_3BDF84032DA198E7 ON exam_user_map');
        $this->addSql('ALTER TABLE exam_user_map DROP user_id_id, DROP exam_id_id');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815101427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, class_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecturer (id INT AUTO_INCREMENT NOT NULL, lec_id INT NOT NULL, lec_name VARCHAR(255) NOT NULL, dob DATE NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecturer_subject (lecturer_id INT NOT NULL, subject_id INT NOT NULL, INDEX IDX_90086B4DBA2D8762 (lecturer_id), INDEX IDX_90086B4D23EDC87 (subject_id), PRIMARY KEY(lecturer_id, subject_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lecturer_classes (lecturer_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_692B2BF2BA2D8762 (lecturer_id), INDEX IDX_692B2BF29E225B24 (classes_id), PRIMARY KEY(lecturer_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mark (id INT AUTO_INCREMENT NOT NULL, student_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, mark VARCHAR(255) NOT NULL, INDEX IDX_6674F271CB944F1A (student_id), INDEX IDX_6674F27123EDC87 (subject_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lecturer_subject ADD CONSTRAINT FK_90086B4DBA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecturer_subject ADD CONSTRAINT FK_90086B4D23EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecturer_classes ADD CONSTRAINT FK_692B2BF2BA2D8762 FOREIGN KEY (lecturer_id) REFERENCES lecturer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecturer_classes ADD CONSTRAINT FK_692B2BF29E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mark ADD CONSTRAINT FK_6674F271CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE mark ADD CONSTRAINT FK_6674F27123EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id)');
        $this->addSql('ALTER TABLE class_room_student DROP FOREIGN KEY FK_9483E8859162176F');
        $this->addSql('ALTER TABLE class_room_student DROP FOREIGN KEY FK_9483E885CB944F1A');
        $this->addSql('ALTER TABLE major DROP FOREIGN KEY FK_3D34FD09D9E30415');
        $this->addSql('ALTER TABLE subject_student DROP FOREIGN KEY FK_12A1039123EDC87');
        $this->addSql('ALTER TABLE subject_student DROP FOREIGN KEY FK_12A10391CB944F1A');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE class_room');
        $this->addSql('DROP TABLE class_room_student');
        $this->addSql('DROP TABLE grade');
        $this->addSql('DROP TABLE major');
        $this->addSql('DROP TABLE semester');
        $this->addSql('DROP TABLE subject_student');
        $this->addSql('ALTER TABLE student ADD stu_id INT NOT NULL, ADD dob DATE NOT NULL, ADD address VARCHAR(255) NOT NULL, ADD image VARCHAR(255) NOT NULL, CHANGE phone_num class_id_id INT DEFAULT NULL, CHANGE email sex VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF339993BF61 FOREIGN KEY (class_id_id) REFERENCES classes (id)');
        $this->addSql('CREATE INDEX IDX_B723AF339993BF61 ON student (class_id_id)');
        $this->addSql('ALTER TABLE subject ADD image VARCHAR(255) NOT NULL, CHANGE subject_name name VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages');
        $this->addSql('ALTER TABLE messenger_messages CHANGE queue_name queue_name VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF339993BF61');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE class_room (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE class_room_student (class_room_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_9483E8859162176F (class_room_id), INDEX IDX_9483E885CB944F1A (student_id), PRIMARY KEY(class_room_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE grade (id INT AUTO_INCREMENT NOT NULL, grade VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, gpa DOUBLE PRECISION NOT NULL, top VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE major (id INT AUTO_INCREMENT NOT NULL, major_name_id INT NOT NULL, INDEX IDX_3D34FD09D9E30415 (major_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE semester (id INT AUTO_INCREMENT NOT NULL, semeter_num INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE subject_student (subject_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_12A10391CB944F1A (student_id), INDEX IDX_12A1039123EDC87 (subject_id), PRIMARY KEY(subject_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE class_room_student ADD CONSTRAINT FK_9483E8859162176F FOREIGN KEY (class_room_id) REFERENCES class_room (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE class_room_student ADD CONSTRAINT FK_9483E885CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE major ADD CONSTRAINT FK_3D34FD09D9E30415 FOREIGN KEY (major_name_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE subject_student ADD CONSTRAINT FK_12A1039123EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subject_student ADD CONSTRAINT FK_12A10391CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lecturer_subject DROP FOREIGN KEY FK_90086B4DBA2D8762');
        $this->addSql('ALTER TABLE lecturer_subject DROP FOREIGN KEY FK_90086B4D23EDC87');
        $this->addSql('ALTER TABLE lecturer_classes DROP FOREIGN KEY FK_692B2BF2BA2D8762');
        $this->addSql('ALTER TABLE lecturer_classes DROP FOREIGN KEY FK_692B2BF29E225B24');
        $this->addSql('ALTER TABLE mark DROP FOREIGN KEY FK_6674F271CB944F1A');
        $this->addSql('ALTER TABLE mark DROP FOREIGN KEY FK_6674F27123EDC87');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE lecturer');
        $this->addSql('DROP TABLE lecturer_subject');
        $this->addSql('DROP TABLE lecturer_classes');
        $this->addSql('DROP TABLE mark');
        $this->addSql('ALTER TABLE messenger_messages CHANGE queue_name queue_name VARCHAR(190) NOT NULL');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('DROP INDEX IDX_B723AF339993BF61 ON student');
        $this->addSql('ALTER TABLE student ADD email VARCHAR(255) NOT NULL, DROP stu_id, DROP dob, DROP sex, DROP address, DROP image, CHANGE class_id_id phone_num INT DEFAULT NULL');
        $this->addSql('ALTER TABLE subject ADD subject_name VARCHAR(255) NOT NULL, DROP name, DROP image');
    }
}

<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806114407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, doctor_id INT NOT NULL, scheduled_at DATETIME NOT NULL, patient_reason VARCHAR(255) NOT NULL, doctor_notes VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FE38F8446B899279 (patient_id), INDEX IDX_FE38F84487F4FB17 (doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(75) NOT NULL, country VARCHAR(90) NOT NULL, city VARCHAR(189) NOT NULL, email VARCHAR(255) NOT NULL, zip_code VARCHAR(18) NOT NULL, street_address VARCHAR(95) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinic_doctor_data (clinic_id INT NOT NULL, doctor_data_id INT NOT NULL, INDEX IDX_98744484CC22AD4 (clinic_id), INDEX IDX_98744484A458C291 (doctor_data_id), PRIMARY KEY(clinic_id, doctor_data_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conversation (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, doctor_id INT NOT NULL, title VARCHAR(40) NOT NULL, channel_id VARCHAR(32) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8A8E26E972F5A1AA (channel_id), INDEX IDX_8A8E26E96B899279 (patient_id), INDEX IDX_8A8E26E987F4FB17 (doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor_data (id INT AUTO_INCREMENT NOT NULL, doctor_id INT DEFAULT NULL, clinic_id INT DEFAULT NULL, medical_specialty_id INT NOT NULL, working_time LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', pwz_id VARCHAR(7) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_EB72CD036C90CC67 (pwz_id), UNIQUE INDEX UNIQ_EB72CD0387F4FB17 (doctor_id), INDEX IDX_EB72CD03CC22AD4 (clinic_id), INDEX IDX_EB72CD03BFC81879 (medical_specialty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, doctor_id INT NOT NULL, patient_id INT NOT NULL, prescription_id INT DEFAULT NULL, type VARCHAR(12) NOT NULL, hash VARCHAR(32) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D8698A76D1B862B8 (hash), INDEX IDX_D8698A7687F4FB17 (doctor_id), INDEX IDX_D8698A766B899279 (patient_id), UNIQUE INDEX UNIQ_D8698A7693DB413D (prescription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manager_data (id INT AUTO_INCREMENT NOT NULL, manager_id INT DEFAULT NULL, clinic_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_ABFA511A783E3463 (manager_id), INDEX IDX_ABFA511ACC22AD4 (clinic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_specialty (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(75) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, conversation_id INT NOT NULL, sender_id INT NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6BD307F9AC0396 (conversation_id), INDEX IDX_B6BD307FF624B39D (sender_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient_data (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, pesel VARCHAR(11) NOT NULL, gender VARCHAR(6) NOT NULL, born_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_2462BEAB6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescription (id INT AUTO_INCREMENT NOT NULL, document_id INT DEFAULT NULL, barcode VARCHAR(44) NOT NULL, prefix_id VARCHAR(38) NOT NULL, access_code VARCHAR(4) NOT NULL, prescription_file_id VARCHAR(22) NOT NULL, medicament_name VARCHAR(255) NOT NULL, medicament_description VARCHAR(255) NOT NULL, medicament_usage_description VARCHAR(255) NOT NULL, medicament_remission VARCHAR(4) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1FBFB8D9C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receptionist_data (id INT AUTO_INCREMENT NOT NULL, receptionist_id INT DEFAULT NULL, clinic_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D74D10ABBD690E33 (receptionist_id), INDEX IDX_D74D10ABCC22AD4 (clinic_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, patient_data_id INT DEFAULT NULL, doctor_data_id INT DEFAULT NULL, receptionist_data_id INT DEFAULT NULL, manager_data_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(50) NOT NULL, second_name VARCHAR(50) DEFAULT NULL, last_name VARCHAR(75) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6496A96F4D7 (patient_data_id), UNIQUE INDEX UNIQ_8D93D649A458C291 (doctor_data_id), UNIQUE INDEX UNIQ_8D93D649F1C3581A (receptionist_data_id), UNIQUE INDEX UNIQ_8D93D6498938942A (manager_data_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F8446B899279 FOREIGN KEY (patient_id) REFERENCES patient_data (id)');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84487F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor_data (id)');
        $this->addSql('ALTER TABLE clinic_doctor_data ADD CONSTRAINT FK_98744484CC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE clinic_doctor_data ADD CONSTRAINT FK_98744484A458C291 FOREIGN KEY (doctor_data_id) REFERENCES doctor_data (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E96B899279 FOREIGN KEY (patient_id) REFERENCES patient_data (id)');
        $this->addSql('ALTER TABLE conversation ADD CONSTRAINT FK_8A8E26E987F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor_data (id)');
        $this->addSql('ALTER TABLE doctor_data ADD CONSTRAINT FK_EB72CD0387F4FB17 FOREIGN KEY (doctor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE doctor_data ADD CONSTRAINT FK_EB72CD03CC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id)');
        $this->addSql('ALTER TABLE doctor_data ADD CONSTRAINT FK_EB72CD03BFC81879 FOREIGN KEY (medical_specialty_id) REFERENCES medical_specialty (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7687F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor_data (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A766B899279 FOREIGN KEY (patient_id) REFERENCES patient_data (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7693DB413D FOREIGN KEY (prescription_id) REFERENCES prescription (id)');
        $this->addSql('ALTER TABLE manager_data ADD CONSTRAINT FK_ABFA511A783E3463 FOREIGN KEY (manager_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE manager_data ADD CONSTRAINT FK_ABFA511ACC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F9AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FF624B39D FOREIGN KEY (sender_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient_data ADD CONSTRAINT FK_2462BEAB6B899279 FOREIGN KEY (patient_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prescription ADD CONSTRAINT FK_1FBFB8D9C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
        $this->addSql('ALTER TABLE receptionist_data ADD CONSTRAINT FK_D74D10ABBD690E33 FOREIGN KEY (receptionist_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE receptionist_data ADD CONSTRAINT FK_D74D10ABCC22AD4 FOREIGN KEY (clinic_id) REFERENCES clinic (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6496A96F4D7 FOREIGN KEY (patient_data_id) REFERENCES patient_data (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A458C291 FOREIGN KEY (doctor_data_id) REFERENCES doctor_data (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F1C3581A FOREIGN KEY (receptionist_data_id) REFERENCES receptionist_data (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498938942A FOREIGN KEY (manager_data_id) REFERENCES manager_data (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clinic_doctor_data DROP FOREIGN KEY FK_98744484CC22AD4');
        $this->addSql('ALTER TABLE doctor_data DROP FOREIGN KEY FK_EB72CD03CC22AD4');
        $this->addSql('ALTER TABLE manager_data DROP FOREIGN KEY FK_ABFA511ACC22AD4');
        $this->addSql('ALTER TABLE receptionist_data DROP FOREIGN KEY FK_D74D10ABCC22AD4');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F9AC0396');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84487F4FB17');
        $this->addSql('ALTER TABLE clinic_doctor_data DROP FOREIGN KEY FK_98744484A458C291');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E987F4FB17');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7687F4FB17');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A458C291');
        $this->addSql('ALTER TABLE prescription DROP FOREIGN KEY FK_1FBFB8D9C33F7837');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498938942A');
        $this->addSql('ALTER TABLE doctor_data DROP FOREIGN KEY FK_EB72CD03BFC81879');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F8446B899279');
        $this->addSql('ALTER TABLE conversation DROP FOREIGN KEY FK_8A8E26E96B899279');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A766B899279');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6496A96F4D7');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7693DB413D');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F1C3581A');
        $this->addSql('ALTER TABLE doctor_data DROP FOREIGN KEY FK_EB72CD0387F4FB17');
        $this->addSql('ALTER TABLE manager_data DROP FOREIGN KEY FK_ABFA511A783E3463');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FF624B39D');
        $this->addSql('ALTER TABLE patient_data DROP FOREIGN KEY FK_2462BEAB6B899279');
        $this->addSql('ALTER TABLE receptionist_data DROP FOREIGN KEY FK_D74D10ABBD690E33');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE clinic');
        $this->addSql('DROP TABLE clinic_doctor_data');
        $this->addSql('DROP TABLE conversation');
        $this->addSql('DROP TABLE doctor_data');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE manager_data');
        $this->addSql('DROP TABLE medical_specialty');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE patient_data');
        $this->addSql('DROP TABLE prescription');
        $this->addSql('DROP TABLE receptionist_data');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}

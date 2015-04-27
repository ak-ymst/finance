<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150427185821 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = "ALTER TABLE `dealing` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
        $this->addSql($sql);
        
        $sql = "ALTER TABLE `dealing_type` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT;";
        $this->addSql($sql);
        
        $sql = "ALTER TABLE `dealing` ADD `amount` INT(10) NOT NULL;";
        $this->addSql($sql);

        $sql = "ALTER TABLE `dealing` ADD `created_at` TIMESTAMP NOT NULL;";
        $this->addSql($sql);
        
        $sql = "ALTER TABLE `dealing` ADD `updated_at` TIMESTAMP NOT NULL;";
        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $sql = "ALTER TABLE `dealing` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL;";

        $this->addSql($sql);
        
        $sql = "ALTER TABLE `dealing_type` CHANGE `id` `id` INT(10) UNSIGNED NOT NULL;";

        $this->addSql($sql);

        $sql = "ALTER TABLE `dealing` DROP `amount`;";
        $this->addSql($sql);
        
        $sql = "ALTER TABLE `dealing` DROP `created_at`;";
        $this->addSql($sql);
        
        $sql = "ALTER TABLE `dealing` DROP `updated_at`;";
        $this->addSql($sql);
    }
}

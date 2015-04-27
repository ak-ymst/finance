<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150427164211 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $sql = "CREATE TABLE dealing (";
        $sql .= " id int(10) unsigned NOT NULL ";
        $sql .= " , date date ";
        $sql .= " , dealing_type_id int(10) ";
        $sql .= " , description text ";
        $sql .= " , client varchar(255) ";
        $sql .= " , PRIMARY KEY(id) ";
        $sql .= " ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->addSql($sql);

        $sql = "CREATE TABLE dealing_type (";
        $sql .= " id int(10) unsigned NOT NULL ";
        $sql .= " , name varchar(255) ";
        $sql .= " , PRIMARY KEY(id) ";
        $sql .= " ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";

        $this->addSql($sql);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $sql = "DROP TABLE IF EXISTS dealing;";
        $this->addSql($sql);
        
        $sql = "DROP TABLE IF EXISTS dealing_type;";
        $this->addSql($sql);
    }
}

<?php

App::uses( 'Mysql', 'Model/Datasource/Database');

class MysqlLog extends Mysql {

    function logQuery( $sql, $params = array()) {

        parent::logQuery( $sql);

        if (Configure::read('Cake.logQuery') ) {

          $this->log( $sql, SQL_LOG);                // SQLクエリーのみ

        }

    }

}

?>
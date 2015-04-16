<?php

class DBAccess {

    function __construct() {
        $dbhost = 'localhost';
        $port = '3306';
        $dbname = 'image_gallery';
        $user = 'root';
        $passwd = '';

        $dsn = 'mysql:dbname=' . $dbname . ';host=' . $dbhost . ';port=' . $port;

        try {
            $this->dbh = new PDO($dsn, $user, $passwd); // also allows an extra parameter of configuration
        } catch (PDOException $e) {
            die('Could not connect to the database:<br/>' . $e);
        }
    }

//    function get_where($table = '', $where = array(), $limit = false, $order_by = false, $order = 'DESC') {
//        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        try {
//            $where_value = "";
//
//            $execute = array();
//            if (count($where) == 0) {
//                return FALSE;
//            }
//            if ($table == '') {
//                return FALSE;
//            }
//            if (count($where) > 1) {
//                foreach ($where as $key => $value) {
//                    $where_value .= " " . $key . " = :" . $key . " AND";
//                    $execute[':' . $key] = $value;
//                }
//                $where_value = mb_substr($where_value, 0, -3);
//            } else {
//                foreach ($where as $key => $value) {
//                    $where_value .= " " . $key . " = :" . $key . " ";
//                    $execute[':' . $key] = $value;
//                }
//            }
//            if ($order_by) {
//                $where_value .=" ORDER BY $order_by $order";
//            }
//            if ($limit) {
//                $where_value .=" LIMIT $limit ";
//            }
//
//            $sql = $this->dbh->prepare("SELECT * FROM $table WHERE $where_value");
//            $sql->execute($execute);
//            return $this->id2int($sql->fetchAll());
//        } catch (PDOException $e) {
//            throw new RestException(501, 'MySQL: ' . $e->getMessage());
//        }
//    }

    function get_where($table = '', $fields = '*', $where = array(), $limit = false, $order_by = false, $order = 'DESC') {
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $where_value = "";

            $execute = array();
            if (count($where) == 0) {
                return FALSE;
            }
            if ($table == '') {
                return FALSE;
            }
            if (count($where) > 1) {
                foreach ($where as $key => $value) {
                    $where_value .= " " . $key . " = :" . $key . " AND";
                    $execute[':' . $key] = $value;
                }
                $where_value = mb_substr($where_value, 0, -3);
            } else {
                foreach ($where as $key => $value) {
                    $where_value .= " " . $key . " = :" . $key . " ";
                    $execute[':' . $key] = $value;
                }
            }
            if ($order_by) {
                $where_value .=" ORDER BY $order_by $order";
            }
            if ($limit) {
                $where_value .=" LIMIT $limit ";
            }

            $query = "SELECT " . $fields . " FROM $table WHERE $where_value";
            $sql = $this->dbh->prepare($query);
            $sql->execute($execute);
            return $this->id2int($sql->fetchAll());
        } catch (PDOException $e) {
            throw new RestException(501, 'MySQL: ' . $e->getMessage());
        }
    }

    function getAll($table = '') {
        if ($table == '') {
            return FALSE;
        }
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $stmt = $this->dbh->query("SELECT * FROM $table");
            return $this->id2int($stmt->fetchAll());
        } catch (PDOException $e) {
            throw new RestException(501, 'MySQL: ' . $e->getMessage());
        }
    }

    function insert($table = '', $fields = NULL, $get = false) {
        if (count($fields) == 0) {
            return FALSE;
        }

        if ($table == '') {
            return FALSE;
        }
        $field_name = $field_value = "";
        $execute = array();
        foreach ($fields as $key => $value) {
            $field_name .= $key . ",";
            $field_value .= ":" . $key . ",";
            //$field_value .= "'" . $value . "',";
            $execute[':' . $key] = $value;
        }
        $field_name = mb_substr($field_name, 0, -1);
        $field_value = mb_substr($field_value, 0, -1);

        $sql = $this->dbh->prepare("INSERT INTO $table ($field_name) VALUES ($field_value)");
        if (!$sql->execute($execute)) {
            print_r($sql->errorInfo());
            return FALSE;
        }
        if ($get)
            return get_where($table, '*', array('id' => $this->dbh->lastInsertId()));
        else
            return $this->dbh->lastInsertId();
    }

    function update_where($table = '', $data = array(), $where = array(), $get = false) {
        if (count($data) == 0 OR count($where) == 0) {
            return FALSE;
        }
        if ($table == '') {
            return FALSE;
        }
        $set_data = $where_data = "";
        $execute = array();
        foreach ($data as $key => $value) {
            $set_data .= " " . $key . " = :" . $key . " ,";
            $execute[':' . $key] = $value;
        }
        $set_data = mb_substr($set_data, 0, -1);

        foreach ($where as $key => $value) {
            $where_data .= " " . $key . " = :" . $key . " ";
            $execute[':' . $key] = $value;
        }

        $sql = $this->dbh->prepare("UPDATE $table SET $set_data WHERE $where_data");
        if (!$sql->execute($execute)) {
            print_r($sql->errorInfo());
            return FALSE;
        }
        if ($get)
            return get_where($table, '*', $where);
        else
            return true;
    }

    function delete_where($table = '', $where = array()) {
        if (count($where) == 0 OR count($where) > 1) {
            return FALSE;
        }
        if ($table == '') {
            return FALSE;
        }
        $where_value = "";
        $execute = array();
        foreach ($where as $key => $value) {
            $where_value .= " " . $key . " = :" . $key . " ";
            $execute[':' . $key] = $value;
        }
        $r = get_where($table, '*', $where);
        if (!$r || !$this->dbh->prepare("DELETE FROM $table WHERE $where_value")->execute($execute))
            return FALSE;
        return $r;
    }

    function id2int($r) {
        if (is_array($r)) {
            if (isset($r['id'])) {
                $r['id'] = intval($r['id']);
            } else {
                foreach ($r as &$r0) {
                    $r0['id'] = intval($r0['id']);
                }
            }
        }
        return $r;
    }

}

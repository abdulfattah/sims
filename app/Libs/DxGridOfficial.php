<?php

    namespace App\Libs;

    use App\Libs\DxGridOfficial\DataSourceLoader;
    use App\Libs\DxGridOfficial\DbSet;
    use mysqli;

    class DxGridOfficial {

        private $dbSet;
        private $mySQL;

        public function __construct($view, $select, $where = '') {
            $this->mySQL = new mysqli(env('DB_HOST'), env('DB_USERNAME'), env('DB_PASSWORD'), env('DB_DATABASE'));
            $this->dbSet = new DbSet($this->mySQL, $view, $select, $where);
        }

        public function Get($params) {
            $result = DataSourceLoader::Load($this->dbSet, $params);
            if (!isset($result)) {
                $result = $this->dbSet->GetLastError();
            }

            $this->mySQL->close();
            return $result;
        }

        function GetParseParams($params, $assoc = FALSE) {
            $result = NULL;
            if (is_array($params)) {
                $result = [];
                foreach ($params as $key => $value) {
                    $result[$key] = json_decode($params[$key], $assoc);
                    if ($result[$key] === NULL) {
                        $result[$key] = $params[$key];
                    }
                }
            }
            else {
                $result = $params;
            }

            return $result;
        }

        function GetParamsFromInput() {
            $result = NULL;
            $content = file_get_contents("php://input");
            if ($content !== FALSE) {
                $params = [];
                parse_str($content, $params);
                $result = $this->GetParseParams($params, TRUE);
            }

            return $result;
        }
    }
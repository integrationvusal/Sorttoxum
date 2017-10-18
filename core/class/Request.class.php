<?php
    class Request {
        public function isAjax() {
            $result = false;
            if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') $result = true;
            return $result;
        }
    }
?>
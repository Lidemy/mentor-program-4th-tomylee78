<?php
    class user{
        private $_account;
        private $_password;

        function addUser($ac,$psw){
            $this->_account = $ac;
            $this->_password = $psw;
        }

        function printInfo(){
            echo $this->_account . $this->_password;
        }
    }
    $tt = new user;

    $tt->adduser('aa', 'bb');
    $tt->printInfo();
?>
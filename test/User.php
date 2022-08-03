<?php


    class User {
        private $name;
        private $login;
        private $email;
        private $password;


        function __construct($login,$name, $email, $password)
        {
            $this->name = $name;
            $this->login = $login;
            $this->email = $email;
            $this->password = $password;
        }

        function getName() {
            return $this->name;
        }

        function getLogin() {
            return $this->login;
        }

        function getEmail() {
            return $this->email;
        }

        function getPassword() {
            return $this->password;
        }

        function getData() {
            return ['login' => $this->login,'name'=>$this->name, 'email' => $this->email, 'password' => $this->password];
        }

    }
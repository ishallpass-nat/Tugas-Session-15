<?php
    class customer{
        private string $name;
        private string $email;
        private string $number;

        public function __construct(string $name, string $email, string $number)
        {
            $this->name = trim($name);
            $this->email = trim($email);
            $this->number = trim($number);
        }
        public function getname(){
        return $this->name;

        }
        public function getEmail(){
        return $this->email;

        }
        public function getNumber(){
        return $this->number;

        }
    }

?>
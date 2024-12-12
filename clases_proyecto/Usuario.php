<?php
    
    class Usuario {

        private string $emailUsu;
        private string $nomUsu;
        private string $apeUsu;

        /**
         * Undocumented function
         */
        public function __construct() { }

        /**
         * Setter para $emailUsu
         *
         * @param string $emailUsu
         * @return void
         */
        public function setEmailUsu(string $emailUsu) {
            $this->emailUsu = $emailUsu;
        }

        /**
         * Setter para $nomUsu
         *
         * @param string $nomUsu
         * @return void
         */
        public function setNomUsu(string $nomUsu) {
            $this->nomUsu = $nomUsu;
        }

        /**
         * Setter para $apeUsu
         *
         * @param string $apeUsu
         * @return void
         */
        public function setApeUsu(string $apeUsu) {
            $this->apeUsu = $apeUsu;
        }

        /**
         * Getter para $emailUsu
         *
         * @return string
         */
        public function getEmailUsu(): string {
            return $this->emailUsu;
        }

        /**
         * Getter para $nomUsu
         *
         * @return string
         */
        public function getNomUsu(): string {
            return $this->nomUsu;
        }

        /**
         * Getter para $apeUsu
         *
         * @return string
         */
        public function getApeUsu(): string {
            return $this->apeUsu;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function __toString(): string {
            return "{$this->nomUsu} {$this->apeUsu}";
        }

    }
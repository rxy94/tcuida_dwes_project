<?php

    class Medico {

        private int $idMed;
        private string $nomMed;
        private string $apeMed;
        private string $contactoMed;
        private string $numColegiado;
        private string $emailMed;
        private string $fotoMed;

        /**
         * Undocumented function
         */
        public function __construct() { }

        /**
         * Undocumented function
         *
         * @param int $idMed
         * @return void
         */
        public function setIdMed(int $idMed) {
            $this->idMed = $idMed;
        }

        /**
         * Undocumented function
         *
         * @param string $nomMed
         * @return void
         */
        public function setNomMed(string $nomMed) {
            $this->nomMed = $nomMed;
        }

        /**
         * Undocumented function
         *
         * @param string $apeMed
         * @return void
         */
        public function setApeMed(string $apeMed) {
            $this->apeMed = $apeMed;
        }

        /**
         * Undocumented function
         *
         * @param string $contactoMed
         * @return void
         */
        public function setContactoMed(string $contactoMed) {
            $this->contactoMed = $contactoMed;
        }

        /**
         * Undocumented function
         *
         * @param string $numColegiado
         * @return void
         */
        public function setNumColegiado(string $numColegiado) {
            $this->numColegiado = $numColegiado;
        }

        /**
         * Undocumented function
         *
         * @param string $emailMed
         * @return void
         */
        public function setEmailMed(string $emailMed) {
            $this->emailMed = $emailMed;
        }

        /**
         * Undocumented function
         *
         * @param string $fotoMed
         * @return void
         */
        public function setFotoMed(string $fotoMed) {
            $this->fotoMed = $fotoMed;
        }

        /**
         * Undocumented function
         *
         * @return integer
         */
        public function getIdMed(): int {
            return $this->idMed;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getNomMed(): string {
            return $this->nomMed;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getApeMed(): string {
            return $this->apeMed;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getNumColegiado(): string {
            return $this->numColegiado;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getContactoMed(): string {
            return $this->contactoMed;
        }
        
        /**
         * Undocumented function
         *
         * @return string
         */
        public function getEmailMed(): string {
            return $this->emailMed;
        }

        /**
         * Undocumented function
         *
         * @return string
         */ 
        public function getFotoMed(): string {
            return $this->fotoMed;
        }


    }


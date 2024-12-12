<?php
    
    class Paciente {

        private int $idPac;
        private int $idMed;
        private string $nomPac;
        private string $apePac;
        private string $dniPac;
        private string $fechaNac;
        private string $genero;
        private string $contactoPac;
        private string $numHistoria;
        private string $dirPaciente;

        /**
         * Undocumented function
         */
        public function __construct() { }

        /**
         * Undocumented function
         *
         * @param integer $idPac
         * @return void
         */
        public function setIdPac(int $idPac) {
            $this->idPac = $idPac;
        }

        /**
         * Undocumented function
         *
         * @param integer $idPac
         * @return void
         */
        public function setIdMed(int $idMed) {
            $this->idMed = $idMed;
        }

        /**
         * Undocumented function
         *
         * @param string $nomPac
         * @return void
         */
        public function setNomPac(string $nomPac) {
            $this->nomPac = $nomPac;
        }

        /**
         * Undocumented function
         *
         * @param string $apePac
         * @return void
         */
        public function setApePac(string $apePac) {
            $this->apePac = $apePac;
        }

        /**
         * Undocumented function
         *
         * @param string $dniPac
         * @return void
         */
        public function setDniPac(string $dniPac) {
            $this->dniPac = $dniPac;
        }

        /**
         * Undocumented function
         *
         * @param string $fechaNac
         * @return void
         */
        public function setFechaNac(string $fechaNac) {
            $this->fechaNac = $fechaNac;
        }
        
        /**
         * Undocumented function
         *
         * @param string $genero
         * @return void
         */
        public function setGenero(string $genero) {
            $this->genero = $genero;
        }
        
        /**
         * Undocumented function
         *
         * @param string $contactoPac
         * @return void
         */
        public function setContactoPac(string $contactoPac) {
            $this->contactoPac = $contactoPac;
        }

        /**
         * Undocumented function
         *
         * @param string $numHistoria
         * @return void
         */
        public function setNumHistoria(string $numHistoria) {
            $this->numHistoria = $numHistoria;
        }

        /**
         * Undocumented function
         *
         * @param string $dirPaciente
         * @return void
         */
        public function setDirPaciente(string $dirPaciente) {
            $this->dirPaciente = $dirPaciente;
        }

        /**
         * Undocumented function
         *
         * @return integer
         */
        public function getIdPac(): int {
            return $this->idPac;
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
        public function getNomPac(): string {
            return $this->nomPac;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getApePac(): string {
            return $this->apePac;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getDniPac(): string {
            return $this->dniPac;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getFechaNac(): string {
            return $this->fechaNac;
        }
        
        /**
         * Undocumented function
         *
         * @return string
         */
        public function getGenero(): string {
            return $this->genero;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getContactoPac(): string {
            return $this->contactoPac;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getNumHistoria(): string {
            return $this->numHistoria;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getDirPac(): string {
            return $this->dirPaciente;
        }

    }
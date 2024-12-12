<?php

    class Especialidad {

        private int $idEsp;
        private string $nomEsp;

        // Constructor
        public function __construct(int $idEsp, string $nomEsp) {
            $this->idEsp = $idEsp;
            $this->nomEsp = $nomEsp;
        }

        /**
         * Undocumented function
         *
         * @return integer
         */
        public function getIdEspecialidad(): int {
            return $this->idEsp;
        }

        /**
         * Undocumented function
         *
         * @return string
         */
        public function getNombre(): string {
            return $this->nomEsp;
        }


        /**
         * Undocumented function
         *
         * @param integer $idEsp
         * @return void
         */
        public function setIdEspecialidad(int $idEsp) {
            $this->idEsp = $idEsp;
        }

        /**
         * Undocumented function
         *
         * @param string $nomEsp
         * @return void
         */
        public function setNombre(string $nomEsp) {
            $this->nomEsp = $nomEsp;
        }

    }

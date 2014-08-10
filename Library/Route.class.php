<?php
    namespace Library;
    
	/**
	* Classe représentant une route.
	*/
    class Route {
        protected $action;
        protected $module;
        protected $url;
        protected $varsNames;
        protected $vars = array();
        
		/**
		* Constructeur.
		* @param $url url à afficher
		* @param $module module concerné
		* @param $action action concerné
		* @param $varsNames tableau de variables
		*/
        public function __construct($url, $module, $action, array $varsNames) {
            $this->setUrl($url);
            $this->setModule($module);
            $this->setAction($action);
            $this->setVarsNames($varsNames);
        }
        
		/**
		* Permet de savoir si l'url contient des variables.
		* @return booléen
		*/
        public function hasVars() {
            return !empty($this->varsNames);
        }
        
		/**
		* Permet de savoir si l'url match le format.
		* @param $url url à analyser
		* @return booléen
		*/
        public function match($url) {
            if (preg_match('`^'.$this->url.'$`', $url, $matches)) {
                return $matches;
            } else {
                return false;
            }
        }
        
		/**
		* Setter de l'action.
		* @param $action action du module
		*/
        public function setAction($action) {
            if (is_string($action)) {
                $this->action = $action;
            }
        }
        
		/**
		* Setter du module.
		* @param $module module
		*/
        public function setModule($module) {
            if (is_string($module)) {
                $this->module = $module;
            }
        }
        
		/**
		* Setter de l'URL.
		* @param $url url
		*/
        public function setUrl($url) {
            if (is_string($url)) {
                $this->url = $url;
            }
        }
        
		/**
		* Setter des noms des variables.
		* @param $varsNames tableau des noms variables
		*/
        public function setVarsNames(array $varsNames) {
            $this->varsNames = $varsNames;
        }
        
		/**
		* Setter des variables.
		* @param $varsNames tableau des variables
		*/
        public function setVars(array $vars) {
            $this->vars = $vars;
        }
        
		/**
		* Getter de l'action.
		* @return l'action
		*/
        public function action() {
            return $this->action;
        }
        
		/**
		* Getter du module.
		* @return le module
		*/
        public function module() {
            return $this->module;
        }
        
		/**
		* Getter des variables.
		* @return le tableau de variables
		*/
        public function vars() {
            return $this->vars;
        }
        
		/**
		* Getter des noms des variables.
		* @return le tableau des noms des variables
		*/
        public function varsNames() {
            return $this->varsNames;
        }
    }

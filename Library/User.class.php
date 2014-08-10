<?php
    namespace Library;
    
    session_start();
    
	/**
	* Classe permettant de gérer la session d'un utilisateur.
	*/
    class User extends ApplicationComponent {
        /**
		* Getter d'un attribut.
		* @param $attr attribut dont on souhaite récupérer la valeur
		* @return valeur de l'attribut
		*/
		public function getAttribute($attr) {
            return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
        }
        
		/**
		* Getter du message flash.
		* @return le message
		*/
        public function getFlash() {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            
            return $flash;
        }
		
		/**
		* Getter du message flashError.
		* @return le message
		*/
        public function getFlashError() {
            $flash = $_SESSION['flashError'];
            unset($_SESSION['flashError']);
            
            return $flash;
        }
		
		/**
		* Getter du message flashCaptcha.
		* @return le message
		*/
        public function getFlashCaptcha() {
            $flash = $_SESSION['flashCaptcha'];
            unset($_SESSION['flashCaptcha']);
            
            return $flash;
        }
        
		/**
		* Permet de savoir s'il y a un message flash.
		* @return booléen.
		*/
        public function hasFlash() {
            return isset($_SESSION['flash']);
        }
		
		/**
		* Permet de savoir s'il y a un message flashError.
		* @return booléen.
		*/
        public function hasFlashError() {
            return isset($_SESSION['flashError']);
        }
		
		/**
		* Permet de savoir s'il y a un message flashCaptcha.
		* @return booléen.
		*/
        public function hasFlashCaptcha() {
            return isset($_SESSION['flashCaptcha']);
        }
        
		/**
		* Permet de savoir si l'utilisateur est actuellement identifié.
		* @return booléen
		*/
        public function isAuthenticated() {
            return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
        }
        
		/**
		* Setter de l'attribut.
		* Permet d'ajouter un attrivut en session.
		* @param $attr nom de l'attribut
		* @param $value valeur de l'attribut
		*/
        public function setAttribute($attr, $value) {
            $_SESSION[$attr] = $value;
        }
        
		/**
		* Permet d'indiquer que l'utilisateur est authentifié ou pas.
		* @param authenticated true par defaut
		*/
        public function setAuthenticated($authenticated = true) {
            if (!is_bool($authenticated)) {
                throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
            }
            
            $_SESSION['auth'] = $authenticated;
			
			if(!$authenticated) {
				$_SESSION = array();
				session_destroy();
			}
        }
        
		/**
		* Permet de mettre un message flash en session.
		* @param $value message flash
		*/
        public function setFlash($value) {
            $_SESSION['flash'] = $value;
        }
		
		/**
		* Permet de mettre un message flash en session.
		* @param $value message flash
		*/
        public function setFlashError($value) {
            $_SESSION['flashError'] = $value;
        }
		
		/**
		* Permet de mettre un message flash en session.
		* @param $value message flash
		*/
        public function setFlashCaptcha($value) {
            $_SESSION['flashCaptcha'] = $value;
        }
    }
	
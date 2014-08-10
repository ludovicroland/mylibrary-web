<?php
    namespace Library;
    
	/**
	* Classe permettant de construite la réponse HTTP à une requête GET ou POST.
	*/
    class HTTPResponse {
        protected $page;
        
		/**
		* Permet d'ajouter un header à la page.
		* @param $header header à ajouter
		*/
        public function addHeader($header) {
            header($header);
        }
        
		/**
		* Permet de rediriger.
		* @param $location page vers laquelle rediriger
		*/
        public function redirect($location) {
            header('Location: '.$location);
            exit;
        }
        
		/**
		* Permet de faire une redirection 404.
		*/
        public function redirect404() {
			$this->page = new Page($this->app);
            $this->page->setContentFile(__DIR__.'/../Errors/404.html');
            
            $this->addHeader('HTTP/1.0 404 Not Found');
            
            $this->send();
        }
        
		/**
		* Envoie la réponse.
		*/
        public function send()  {
            exit($this->page->getGeneratedPage());
        }
        
		/**
		* Setter de la page.
		* @param $page page
		*/
        public function setPage(Page $page)  {
            $this->page = $page;
        }
        
        /**
		* Changement par rapport à la fonction setcookie() : le dernier argument est par défaut à true.
		* @param...
		*/
        public function setCookie($name, $value = '', $expire = 0, $path = null, $domain = null, $secure = false, $httpOnly = true) {
            setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
        }
    }

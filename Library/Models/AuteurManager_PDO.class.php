<?php  namespace Library\Models;    	use \Library\Entities\Auteur;	  class AuteurManager_PDO     extends AuteurManager   {  		public function getAuteursList()     {			$auteursList = array();					$requete = $this->dao->query(                  "SELECT                    AUT_ID AS id,                    AUT_NOM AS nom,                    AUT_PRENOM AS prenom                  FROM                    AUTEUR                  ORDER BY                    AUT_NOM,                    AUT_PRENOM");						while($auteur = $requete->fetch(\PDO::FETCH_ASSOC))       {								$auteursList[] = new Auteur($auteur);			}						$requete->closeCursor();						return $auteursList;		}				public function add(Auteur $auteur)     {			$requete = $this->dao->prepare('INSERT INTO AUTEUR (AUT_ID, AUT_NOM, AUT_PRENOM) VALUES(:id, :nom, :prenom)');			$requete->bindValue(':nom', strtoupper(htmlspecialchars($auteur->nom())));			$requete->bindValue(':prenom', ucfirst(htmlspecialchars($auteur->prenom())));			$requete->bindValue(':id', (int) $auteur->id());			$requete->execute();						$auteur->setId($this->dao->lastInsertId());		}				public function modify(Auteur $auteur)     {			$requete = $this->dao->prepare('UPDATE AUTEUR SET AUT_NOM = :nom, AUT_PRENOM = :prenom WHERE AUT_ID = :id');			$requete->bindValue(':nom', strtoupper(htmlspecialchars($auteur->nom())));			$requete->bindValue(':prenom', ucfirst(htmlspecialchars($auteur->prenom())));			$requete->bindValue(':id', (int) $auteur->id());			$requete->execute();		}				public function delete($id)     {			try       {				$requete = $this->dao->prepare("DELETE FROM AUTEUR WHERE AUT_ID = :id");				$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);				$requete->execute();				}			catch (\PDOException $e)       {				return false;			}						return true;					}		public function getAuteurById($id)     {			$requete = $this->dao->prepare("SELECT AUT_ID AS id, AUT_NOM AS nom, AUT_PRENOM AS prenom FROM AUTEUR WHERE AUT_ID = :id");			$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);      $requete->execute();                  if ($auteur = $requete->fetch(\PDO::FETCH_ASSOC))       {                       return new Auteur($auteur);      }            return null;		}      }
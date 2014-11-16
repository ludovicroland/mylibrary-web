<?php  namespace Library\Models;    	use \Library\Entities\Livre;	use \Library\Entities\Recherche;	use \Library\Entities\Utilisateur;	  class LivreManager_PDO     extends LivreManager   {		public function getLivreList($letter)     {			$livresList = array();					$requete = $this->dao->prepare(                    "SELECT                      LIV_ID AS id,                      LIV_ANNEE AS annee,                      LIV_NOM AS nom,                      AUT_NOM AS auteurNom,                      AUT_PRENOM AS auteurPrenom                    FROM                      LIVRE                      JOIN AUTEUR ON LIVRE.AUT_ID = AUTEUR.AUT_ID                    WHERE                      LIV_NOM LIKE :letter                    ORDER BY                      LIV_NOM,                      AUT_NOM,                      AUT_PRENOM");						$requete->bindValue(':letter', $letter.'%');			$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livresList[] = new Livre($livre);			}						$requete->closeCursor();						return $livresList;		}		public function add(Livre $livre)     {			$requete = $this->dao->prepare('INSERT INTO LIVRE (LIV_NOM, LIV_ANNEE, LIV_POCHE, LIV_COUVERTURE, GEN_ID, AUT_ID) VALUES(:nom, :annee, :poche, :couverture, :genreId, :auteurId)');						//photo			$photo = $livre->couverture();						if(!empty($photo))       {								$date = md5(uniqid(rand(), true));								$urlPhoto = '../Web/images/upload/'.$date;				$urlPhotoBdd = '/images/upload/'.$date;								//On envoie le fichier sur le serveur				if(in_array($_FILES['couverture']['type'], array('image/jpeg', 'image/pjpeg', 'image/jpg')))         {					$urlPhoto .= '.jpg';					$urlPhotoBdd .= '.jpg';					move_uploaded_file($livre->couverture(), $urlPhoto);					$source = imagecreatefromjpeg($urlPhoto);				}				else if($_FILES['couverture']['type'] == 'image/png')         {					$urlPhoto .= '.png';					$urlPhotoBdd .= '.png';					move_uploaded_file($livre->couverture(), $urlPhoto);					$source = imagecreatefrompng($urlPhoto);				}								//On définit la hauteur et la largeur de la source				$largeur_source = imagesx($source);				$hauteur_source = imagesy($source);								//portrait				if($largeur_source >= $hauteur_source)         {					$largeur_destination = 640;					$hauteur_destination = ($hauteur_source*$largeur_destination)/$largeur_source;										// On crée la miniature vide					$destination = imagecreatetruecolor($largeur_destination, $hauteur_destination); 										// On crée la miniature					imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);										// On enregistre la miniature					if(in_array($_FILES['couverture']['type'], array('image/jpeg', 'image/pjpeg', 'image/jpg')))           {						imagejpeg($destination, $urlPhoto);					}					else if($_FILES['couverture']['type'] == 'image/png')           {						imagepng($destination, $urlPhoto);					}				}				else         {					$hauteur_destination =  640;					$largeur_destination = ($hauteur_destination*$largeur_source)/$hauteur_source;										// On crée la miniature vide					$destination = imagecreatetruecolor($largeur_destination, $hauteur_destination); 										// On crée la miniature					imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);										// On enregistre la miniature					if(in_array($_FILES['couverture']['type'], array('image/jpeg', 'image/pjpeg', 'image/jpg')))           {						imagejpeg($destination, $urlPhoto);					}					else if($_FILES['couverture']['type'] == 'image/png')           {						imagepng($destination, $urlPhoto);					}				}								$requete->bindValue(':couverture', $urlPhotoBdd);			}			else       {				$requete->bindValue(':couverture', "");			}						$requete->bindValue(':nom', ucwords(htmlspecialchars($livre->nom())));			$requete->bindValue(':annee', htmlspecialchars($livre->annee()));			$requete->bindValue(':poche', (int)$livre->poche());			$requete->bindValue(':genreId', (int)$livre->genreId());			$requete->bindValue(':auteurId', (int)$livre->auteurId());			$requete->execute();						$livre->setId($this->dao->lastInsertId());		}				public function modify(Livre $livre)     {			$photo = $livre->couverture();						//cas sans photo			if(empty($photo))       {				$requete = $this->dao->prepare('UPDATE LIVRE SET LIV_NOM = :nom, LIV_ANNEE = :annee, LIV_POCHE = :poche, GEN_ID = :genreId, AUT_ID = :auteurId WHERE LIV_ID = :id');				$requete->bindValue(':nom', ucwords(htmlspecialchars($livre->nom())));				$requete->bindValue(':annee', htmlspecialchars($livre->annee()));				$requete->bindValue(':poche', (int)$livre->poche());				$requete->bindValue(':genreId', (int)$livre->genreId());				$requete->bindValue(':auteurId', (int)$livre->auteurId());				$requete->bindValue(':id', (int)$livre->id());				$requete->execute();			}			else       {				//On récupère le nom du fichier pour le supprimer après				$requete_delete = $this->dao->prepare('SELECT LIV_COUVERTURE AS photo FROM LIVRE WHERE LIV_ID = :id');							$requete_delete->bindValue(':id', (int) $livre->id(), \PDO::PARAM_INT);				$requete_delete->execute();								if ($old_image = $requete_delete->fetch(\PDO::FETCH_ASSOC))         {                					if(file_exists('../Web/'.$old_image['photo']) && $old_image['photo'] != '')           {						unlink('../Web/'.$old_image['photo']);					}				}								//MAJ				$requete = $this->dao->prepare('UPDATE LIVRE SET LIV_NOM = :nom, LIV_ANNEE = :annee, LIV_POCHE = :poche, LIV_COUVERTURE = :couverture, GEN_ID = :genreId, AUT_ID = :auteurId WHERE LIV_ID = :id');				$date = md5(uniqid(rand(), true));				$urlPhoto = '../Web/images/upload/'.$date;				$urlPhotoBdd = '/images/upload/'.$date;								//On envoie le fichier sur le serveur				if(in_array($_FILES['couverture']['type'], array('image/jpeg', 'image/pjpeg', 'image/jpg')))         {					$urlPhoto .= '.jpg';					$urlPhotoBdd .= '.jpg';					move_uploaded_file($livre->couverture(), $urlPhoto);					$source = imagecreatefromjpeg($urlPhoto);				}				else if($_FILES['couverture']['type'] == 'image/png')         {					$urlPhoto .= '.png';					$urlPhotoBdd .= '.png';					move_uploaded_file($livre->couverture(), $urlPhoto);					$source = imagecreatefrompng($urlPhoto);				}								//On définit la hauteur et la largeur de la source				$largeur_source = imagesx($source);				$hauteur_source = imagesy($source);								//portrait				if($largeur_source >= $hauteur_source)         {					$largeur_destination = 640;					$hauteur_destination = ($hauteur_source*$largeur_destination)/$largeur_source;										// On crée la miniature vide					$destination = imagecreatetruecolor($largeur_destination, $hauteur_destination); 										// On crée la miniature					imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);										// On enregistre la miniature					if(in_array($_FILES['couverture']['type'], array('image/jpeg', 'image/pjpeg', 'image/jpg')))           {						imagejpeg($destination, $urlPhoto);					}					else if($_FILES['couverture']['type'] == 'image/png')           {						imagepng($destination, $urlPhoto);					}				}				else         {					$hauteur_destination =  640;					$largeur_destination = ($hauteur_destination*$largeur_source)/$hauteur_source;										// On crée la miniature vide					$destination = imagecreatetruecolor($largeur_destination, $hauteur_destination); 										// On crée la miniature					imagecopyresampled($destination, $source, 0, 0, 0, 0, $largeur_destination, $hauteur_destination, $largeur_source, $hauteur_source);										// On enregistre la miniature					if(in_array($_FILES['couverture']['type'], array('image/jpeg', 'image/pjpeg', 'image/jpg')))           {						imagejpeg($destination, $urlPhoto);					}					else if($_FILES['couverture']['type'] == 'image/png')           {						imagepng($destination, $urlPhoto);					}				}								$requete->bindValue(':id', (int)$livre->id());				$requete->bindValue(':nom', ucwords(htmlspecialchars($livre->nom())));				$requete->bindValue(':annee', htmlspecialchars($livre->annee()));				$requete->bindValue(':poche', (int)$livre->poche());				$requete->bindValue(':genreId', (int)$livre->genreId());				$requete->bindValue(':auteurId', (int)$livre->auteurId());				$requete->bindValue(':couverture', $urlPhotoBdd);				$requete->execute();			}		}				public function delete($id)     {						//On supprime l'image associée si image il y a			$requete_photo = $this->dao->prepare('SELECT LIV_COUVERTURE AS couverture FROM LIVRE WHERE LIV_ID = :id');			$requete_photo->bindValue(':id', (int) $id, \PDO::PARAM_INT);			$requete_photo->execute();			$old_image = $requete_photo->fetch(\PDO::FETCH_ASSOC);                			$requete_photo->closeCursor();			try       {				//On supprime la ligne en BDD				$requete = $this->dao->prepare("DELETE FROM LIVRE WHERE LIV_ID = :id");				$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);				$requete->execute();				}			catch (\PDOException $e)       {				return false;			}						if(file_exists('../Web/'.$old_image['couverture']) && $old_image['couverture'] != '')       {				unlink('../Web/'.$old_image['couverture']);			}						return true;					}		public function getLivreById($id)     {                  $requete = $this->dao->prepare(                  "SELECT                    LIV_ID AS id,                    LIV_NOM AS nom,                    LIV_ANNEE AS annee,                    LIV_COUVERTURE AS couverture,                    LIV_POCHE AS poche,                    GENRE.GEN_ID as genreId,                    GENRE.GEN_LIBELLE as genreLibelle,                    AUTEUR.AUT_ID as auteurId,                    AUTEUR.AUT_PRENOM as auteurPrenom,                    AUTEUR.AUT_NOM as auteurNom                  FROM                    LIVRE                    JOIN AUTEUR ON AUTEUR.AUT_ID = LIVRE.AUT_ID                    JOIN GENRE ON GENRE.GEN_ID = LIVRE.GEN_ID                  WHERE                    LIV_ID = :id");						$requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);      $requete->execute();                  if ($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {                        return new Livre($livre);      }            return null;		}		public function hasGetLivre($livreId, $userId)     {			$requete = $this->dao->prepare(                  "SELECT                    LIV_ID AS id                  FROM                    HAS                  WHERE                    LIV_ID = :livreId                    AND UTI_ID = :userId");															$requete->bindValue(':livreId', (int) $livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int) $userId, \PDO::PARAM_INT);      $requete->execute();						if ($result = $requete->fetch(\PDO::FETCH_ASSOC))       {                        return true;      }                  return false;		}		public function hasWantLivre($livreId, $userId)     {			$requete = $this->dao->prepare(                  "SELECT                    LIV_ID AS id                  FROM                    WANT                  WHERE                    LIV_ID = :livreId                    AND UTI_ID = :userId");															$requete->bindValue(':livreId', (int) $livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int) $userId, \PDO::PARAM_INT);      $requete->execute();						if ($result = $requete->fetch(\PDO::FETCH_ASSOC))       {                      return true;      }                  return false;		}				public function hasReadLivre($livreId, $userId)     {			$requete = $this->dao->prepare(                  "SELECT                    LIV_ID AS id                  FROM                    `READ`                  WHERE                    LIV_ID = :livreId                    AND UTI_ID = :userId");															$requete->bindValue(':livreId', (int) $livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int) $userId, \PDO::PARAM_INT);      $requete->execute();						if ($result = $requete->fetch(\PDO::FETCH_ASSOC))       {                        return true;      }                  return false;		}				public function addGetLivre($livreId, $userId)     {			$requete = $this->dao->prepare('INSERT INTO HAS (LIV_ID, UTI_ID) VALUES(:livreId, :userId)');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}		public function removeGetLivre($livreId, $userId)     {			$requete = $this->dao->prepare('DELETE FROM HAS WHERE LIV_ID = :livreId AND UTI_ID = :userId');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}				public function addWantLivre($livreId, $userId)     {			$requete = $this->dao->prepare('INSERT INTO WANT (LIV_ID, UTI_ID) VALUES(:livreId, :userId)');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}		public function removeWantLivre($livreId, $userId)     {			$requete = $this->dao->prepare('DELETE FROM WANT WHERE LIV_ID = :livreId AND UTI_ID = :userId');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}				public function addReadLivre($livreId, $userId)     {			$requete = $this->dao->prepare('INSERT INTO `READ` (LIV_ID, UTI_ID) VALUES(:livreId, :userId)');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}		public function removeReadLivre($livreId, $userId)     {			$requete = $this->dao->prepare('DELETE FROM `READ` WHERE LIV_ID = :livreId AND UTI_ID = :userId');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}				public function getGetList($userId)     {			$livresList = array();					$requete = $this->dao->prepare(                  "SELECT                    LIVRE.LIV_ID AS id,                    LIV_ANNEE AS annee,                    LIV_NOM AS nom,                    AUT_NOM AS auteurNom,                    AUT_PRENOM AS auteurPrenom                  FROM                    LIVRE                    JOIN AUTEUR ON LIVRE.AUT_ID = AUTEUR.AUT_ID                    JOIN HAS ON LIVRE.LIV_ID = HAS.LIV_ID                  WHERE                    UTI_ID = :userId                  ORDER BY                    LIV_NOM,                    AUT_NOM,                    AUT_PRENOM");						$requete->bindValue(':userId', $userId);			$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livresList[] = new Livre($livre);			}						$requete->closeCursor();						return $livresList;		}		public function getReadList($userId)     {			$livresList = array();					$requete = $this->dao->prepare(                  "SELECT                    LIVRE.LIV_ID AS id,                    LIV_ANNEE AS annee,                    LIV_NOM AS nom,                    AUT_NOM AS auteurNom,                    AUT_PRENOM AS auteurPrenom                  FROM                    LIVRE                    JOIN AUTEUR ON LIVRE.AUT_ID = AUTEUR.AUT_ID                    JOIN `READ` ON LIVRE.LIV_ID = `READ`.LIV_ID                  WHERE                    UTI_ID = :userId                  ORDER BY                    LIV_NOM,                    AUT_NOM,                    AUT_PRENOM");						$requete->bindValue(':userId', $userId);			$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livresList[] = new Livre($livre);			}						$requete->closeCursor();						return $livresList;		}		public function getWantList($userId)     {			$livresList = array();					$requete = $this->dao->prepare(                  "SELECT                    LIVRE.LIV_ID AS id,                    LIV_ANNEE AS annee,                    LIV_NOM AS nom,                    AUT_NOM AS auteurNom,                    AUT_PRENOM AS auteurPrenom                  FROM                    LIVRE                    JOIN AUTEUR ON LIVRE.AUT_ID = AUTEUR.AUT_ID                    JOIN WANT ON LIVRE.LIV_ID = WANT.LIV_ID                  WHERE                    UTI_ID = :userId                  ORDER BY                    LIV_NOM,                    AUT_NOM,                    AUT_PRENOM");						$requete->bindValue(':userId', $userId);			$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livresList[] = new Livre($livre);			}						$requete->closeCursor();						return $livresList;		}		public function getSuggestionList($userId)     {			$livresList = array();					$requete = $this->dao->prepare(                  "SELECT DISTINCT                    LIVRE.LIV_ID AS id,                    LIV_ANNEE AS annee,                    LIV_NOM AS nom,                    AUT_NOM AS auteurNom,                    AUT_PRENOM AS auteurPrenom                  FROM                    LIVRE                    JOIN AUTEUR ON LIVRE.AUT_ID = AUTEUR.AUT_ID                    JOIN HAS ON LIVRE.LIV_ID = HAS.LIV_ID                  WHERE                    LIVRE.LIV_ID NOT IN (                      SELECT LIV_ID                      FROM `READ`                      WHERE UTI_ID = :userId                                            UNION                                            SELECT LIV_ID                      FROM BLACKLIST                      WHERE UTI_ID = :userId                      )                  ORDER BY                    LIV_NOM,                    AUT_NOM,                    AUT_PRENOM");						$requete->bindValue(':userId', $userId);			$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livresList[] = new Livre($livre);			}						$requete->closeCursor();						return $livresList;		}		public function removeSuggestions($livreId, $userId)     {			$requete = $this->dao->prepare('INSERT INTO BLACKLIST (LIV_ID, UTI_ID) VALUES (:livreId, :userId)');			$requete->bindValue(':livreId', (int)$livreId, \PDO::PARAM_INT);			$requete->bindValue(':userId', (int)$userId, \PDO::PARAM_INT);						try       {							$requete->execute();			}			catch (\PDOException $e)       {				return false;			}						return true;		}		public function peopleHaveLivre($livreId, $userId)     {			$users = array();					$requete = $this->dao->prepare(                  "SELECT                    UTI_LOGIN AS login,                    UTI_MAIL AS email                  FROM                    UTILISATEUR                    JOIN HAS ON UTILISATEUR.UTI_ID = HAS.UTI_ID                  WHERE                    LIV_ID = :livreId                    AND UTILISATEUR.UTI_ID <> :userId                  ORDER BY                    UTI_LOGIN");						$requete->bindValue(':livreId', $livreId);			$requete->bindValue(':userId', $userId);			$requete->execute();						while($user = $requete->fetch(\PDO::FETCH_ASSOC))       {								$users[] = new Utilisateur($user);			}						$requete->closeCursor();						return $users;		}		public function search(Recherche $recherche)     {			$livres = array();						$firstWhere = true;			$useName = false;			$useYear = false;			$useGenre = false;			$useAuteur = false;						$stringRequest = "SELECT                          LIV_ID AS id,                          LIV_NOM AS nom,                          LIV_ANNEE AS annee,                          LIV_COUVERTURE AS couverture,                          LIV_POCHE AS poche,                          GENRE.GEN_ID as genreId,                          GENRE.GEN_LIBELLE as genreLibelle,                          AUTEUR.AUT_ID as auteurId,                          AUTEUR.AUT_PRENOM as auteurPrenom,                          AUTEUR.AUT_NOM as auteurNom                        FROM                          LIVRE                          JOIN AUTEUR ON AUTEUR.AUT_ID = LIVRE.AUT_ID                          JOIN GENRE ON GENRE.GEN_ID = LIVRE.GEN_ID";						if(strlen($recherche->nom()) != 0)      {				$useName = true;				$firstWhere = false;								$stringRequest .= "WHERE UPPER(LIV_NOM) LIKE :name";			}						if(strlen($recherche->annee()) != 0)       {				$useYear = true;								if($firstWhere)         {					$stringRequest .= "WHERE LIV_ANNEE = :annee";				}				else         {					$stringRequest .= "AND LIV_ANNEE = :annee";				}								$firstWhere = false;			}						if(strlen($recherche->genreId()) != 0)       {				$useGenre = true;								if($firstWhere)         {					$stringRequest .= "WHERE GENRE.GEN_ID = :genre";				}				else         {					$stringRequest .= "AND GENRE.GEN_ID = :genre";				}								$firstWhere = false;			}						if(strlen($recherche->auteurId()) != 0)       {				$useAuteur = true;								if($firstWhere)         {					$stringRequest .= "WHERE AUTEUR.AUT_ID = :auteur";				}				else         {					$stringRequest .= "AND AUTEUR.AUT_ID = :auteur";				}			}						$stringRequest .= "ORDER BY                          LIV_NOM,                          AUT_NOM,                          AUT_PRENOM";			$requete = $this->dao->prepare($stringRequest);									if($useName)       {				$requete->bindValue(":name", "%".strtoupper(htmlspecialchars(addslashes($recherche->nom())))."%");			}						if($useYear)       {				$requete->bindValue(':annee', (int) $recherche->annee(), \PDO::PARAM_INT);			}						if($useGenre)       {				$requete->bindValue(':genre', (int) $recherche->genreId(), \PDO::PARAM_INT);			}						if($useAuteur)       {				$requete->bindValue(':auteur', (int) $recherche->auteurId(), \PDO::PARAM_INT);			}						$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livres[] = new Livre($livre);			}						$requete->closeCursor();						return $livres;		}    		public function getAllList()     {			$livresList = array();					$requete = $this->dao->prepare(                  "SELECT DISTINCT                    LIVRE.LIV_ID AS id,                    LIV_ANNEE AS annee,                    LIV_NOM AS nom,                    AUT_NOM AS auteurNom,                    AUT_PRENOM AS auteurPrenom                  FROM                    LIVRE                    JOIN AUTEUR ON LIVRE.AUT_ID = AUTEUR.AUT_ID                    JOIN HAS ON LIVRE.LIV_ID = HAS.LIV_ID                  ORDER BY                    AUT_NOM,                    AUT_PRENOM,                    LIV_NOM");						$requete->execute();						while($livre = $requete->fetch(\PDO::FETCH_ASSOC))       {								$livresList[] = new Livre($livre);			}						$requete->closeCursor();						return $livresList;		}      }
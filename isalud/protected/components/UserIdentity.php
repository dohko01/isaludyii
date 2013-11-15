<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
 
class UserIdentity extends CUserIdentity
{
	private $_id;
	public function authenticate()
	{
		$record=Usuario::model()->findByAttributes(array('username'=>$this->username));  // here I use Username as user name which comes from database
		//print_r($record); exit(0);
		if($record===null)
		{
			$this->_id='user Null';
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if($record->pass!==md5($this->password))            // here I compare db password with passwod field
		{
			//$this->_id=$this->username;
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
		else if(!$record->activo)                //  here I check status as Active in db
		{        
			$err = "You have been Inactive by Admin.";
			$this->errorCode = $err;
		}
		else
		{  
			$this->_id = $record->activo;
			$this->setState('tipoUsuario', $record->id_cat_tipo_usuario);
			$this->setState('id_cat_institucion', $record->id_cat_institucion);
			//$this->setState('activo', $record->activo);
			$this->setState('title', $record->nombre);
			$this->errorCode=self::ERROR_NONE;		
		}
		return !$this->errorCode;
	}
	
	public function getId()       //  override Id
	{
		return $this->_id;
	}
}
 
/*class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 *
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}*/
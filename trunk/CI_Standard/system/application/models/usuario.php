<?php
class Usuario extends Model 
{
	
	function Login($username, $password)
	{
		$result = $this->db->select('id_usuario')
		->where('nombre_usuario', $username)
		->where('clave', md5($password))
		->limit('1')
		->get('usuario');

		if ($result->num_rows() == '1') return TRUE;

		return FALSE;
	}

	function GetUserInfo($user, $fields = NULL)
	{
		if (is_numeric($user) and $user > 0) $this->db->where('id_usuario', $user);
		else $this->db->where('nombre_usuario', $user);

		if ($fields !== NULL) $this->db->select($fields);

		$this->db->limit('1');

		$result = $this->db->get('usuario');

		if ($result->num_rows() != '1') return FALSE;

		$result = $result->result_array();

		return $result[0];
	}
	function ChangePassword($userid, $actual, $new){
		
		$result = $this->db->select('id_usuario')
		->where('id_usuario', $userid)
		->where('clave', md5($actual))
		->limit('1')
		->get('usuario');

		if ($result->num_rows() < 1)
			return FALSE;
		
		$params['id_usuario'] = $userid;
		$params['clave'] = md5($new);
	
		// -------------------------------------------------------
		$this->db->where("id_usuario",$userid);
    	return ($this->db->update($params));
		
	}

}
?>
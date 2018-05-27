<?php 
class Usuario {
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;


    /**
     * @return mixed
     */
    public function getIdusuario()
    {
        return $this->idusuario;
    }

    /**
     * @return mixed
     */
    public function getDeslogin()
    {
        return $this->deslogin;
    }

    /**
     * @return mixed
     */
    public function getDessenha()
    {
        return $this->dessenha;
    }

    /**
     * @return mixed
     */
    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }


    /**
     * @param mixed $idusuario
     *
     * @return self
     */
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }

    /**
     * @param mixed $deslogin
     *
     * @return self
     */
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        return $this;
    }

    /**
     * @param mixed $dessenha
     *
     * @return self
     */
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        return $this;
    }

    /**
     * @param mixed $dtcadastro
     *
     * @return self
     */
    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        return $this;
    }

    public function loadById($id) {
    	$sql = new Sql();
    	$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
    		':ID' => $id
    	));
    	if(count($results) > 0) {
    		$row = $results[0];
    		$this->setIdusuario($row['idusuario']);
    		$this->setDeslogin($row['deslogin']);
    		$this->setDessenha($row['dessenha']);
    		$this->setDtcadastro(new DateTime($row['dtcadastro']));
    	}
    }
               
    public static function getList() {
    	$sql = new Sql();
    	return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login) {
    	$sql = new Sql();
    	return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
    		':SEARCH' => "%".$login."%"
    	));
    }

    public function login($login, $password) {
    	$sql = new Sql();
    	$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
    		':LOGIN' => $login,
    		':PASSWORD' => $password
    	));
    	if(count($results) > 0) {
    		$row = $results[0];
    		$this->setIdusuario($row['idusuario']);
    		$this->setDeslogin($row['deslogin']);
    		$this->setDessenha($row['dessenha']);
    		$this->setDtcadastro(new DateTime($row['dtcadastro']));
    	} else {
    		throw new Exception("Login ou senha invalidos.");
    	}
    }

    public function setData($data) {
    	$this->setIdusuario($data['idusuario']);
    	$this->setDeslogin($data['deslogin']);
    	$this->setDessenha($data['dessenha']);
    	$this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert() {
    	$sql = new Sql();
    	$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
    		':LOGIN' => $this->getDeslogin(),
    		':PASSWORD' => $this->getDessenha()
    	));

    	if(count($results) > 0) {
    		$this->setData($results[0]);
    	}
    }

    public function update($login, $password) {
    	$this->setDeslogin($login);
    	$this->setDessenha($password);
    	$sql = new Sql();
    	$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha=:PASSWORD WHERE idusuario = :ID", array(
    		':LOGIN' => $this->getDeslogin(),
    		':PASSWORD' => $this->getDessenha(),
    		':ID' => $this->getIdusuario()
    	));
    }

    public function __construct($login = "", $password= "") {
    	$this->setDeslogin($login);
    	$this->setDessenha($password);
    }

    public function __toString() {
    	return json_encode(array(
    		'idusuario' => $this->getIdusuario(),
    		'deslogin' => $this->getDeslogin(),
    		'dessenha' => $this->getDessenha(),
    		'dtcadastro' => $this->getDtcadastro()->format("d/m/Y H:i:s")
    	));
    }
}
?>
<?php

namespace Core;

class Model{

	protected static $con = null;
	protected $table = null;
	protected $fields = [];
	protected $data = [];


	public static function initialize($con = null){
		if(self::$con === null){
			self::$con = $con;
		}
	}

	public function __set($name, $value)
	{
			$this->data[$name] = $value;
	}

	public function __get($name)
	{
		if (array_key_exists($name, $this->data)) {
			return $this->data[$name];
		}
	}

	public function getTable(){
		if($this->table !== null){
			return $this->table;
		}
		$name = explode('\\', get_class($this));
		$name = array_pop($name);
		return strtolower($name).'s';
		
	}

	public function getFields(){
		if(count($this->fields) > 0){
			return implode(',', $this->fields);
		}
		return '*';
	}

	private function execute($sql = null, $arr = null){
		try{
			$con = self::$con->prepare($sql);
			if($arr != null){
				foreach($arr as $key => $value){
					$con->bindValue(utf8_encode($key),$value);
				}
			}
			$con->execute();
			return $con->rowCount();

		}
		catch(\PDOException $e){
			echo 'ERROR: '. $e->getMessage();
		}
	}

	public function select(){
		// -->
	}

	public function findAll($sql = null, $arr = null){
		try{
			if($sql == null ){
				$sql  =  ' select id, '.$this->getFields().' from '. $this->getTable().' ; ';
			}
		
			$con = self::$con->prepare($sql);
			$con->execute();

			if($con){
				$arr = []; 
				foreach($con->fetchAll(\PDO::FETCH_ASSOC) as $value){
					$class =  get_class($this);
					$cls = new $class;
					$cls->data = $value;
					array_push($arr, $cls);
				}
			}
			return $arr;
		}
		catch(\PDOException $e){
			echo 'ERROR: '. $e->getMessage();
		}
	}


	public function edit($id, $sql = null, $arr = null ){
		if($sql == null){
			$str = '' ;
			$arr = [];
			foreach($this->data as $key => $value){
				if($str !== ''){
					$str .= ', ';
				}
				$str .= "$key = :$key";
				$arr[":$key"] = $value;
			}
			$arr[":id"] = $id;
			$sql = ' update '. $this->getTable() . ' set ' .$str. ' where id = :id ; ';
		}
		return $this->execute($sql, $arr);
	}

	public function delete($id, $sql = null, $arr = null){
		if($sql == null){
			$sql = ' delete from ' . $this->getTable(). ' where id = '. $id . ' ; ';
		}
		return $this->execute($sql, $arr);
	}

	public function insert($sql =  null, $arr = null){
		if($sql == null ){
			$arr = [];
			foreach($this->data as $key => $value){
				$arr[":$key"] = $value;
			}
			$sql = 'insert into '. $this->getTable() .'('.implode(',', array_keys($this->data)).') values ('.implode(',',array_keys($arr)).');';
		}
		return $this->execute($sql, $arr);
	}

}

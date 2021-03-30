<?php

class Database
{
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $db = "petbook_db";


function connect()

{

	$connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
	return $connection;

}


	function read($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn, $query);

		if(!$result)
		{
			return false;
		}
		else
		{
			$data = false;

			// if(strstr($query, "delete"))
			// {
			//  	var_dump($query);
			//  	var_dump($result);
			// 	die;
			// }


			while($row = mysqli_fetch_assoc($result))
			{

				$data[] = $row;
			}

			return $data;
		}
	}

	function read_for_delete($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn, $query);

		if(!$result)
		{
			return false;
		}
		else
		{
			$data = false;
		}

	}

	function save($query)
	{
		$conn = $this->connect();
		$result = mysqli_query($conn, $query);

		if(!$result)
		{
			return false;
		}else
		{
			return true;
		}
	}

}
$DB = new Database();





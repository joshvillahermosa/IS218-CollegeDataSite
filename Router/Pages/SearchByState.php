<?php
	class SearchByState extends page
	{
		function post()
		{
			//include '../www/Logins/CollegeDataLogin.php';
			include 'DataManip.php';
			$this->title = 'Search By State View';
			include 'DBLogin.php';
			$CollegeData = new DBManip($host, $dbname, $user, $pass);
			$this->content.='<div class="container">';
			$this->content.= '
			<div class="jumbotron">
				<h1 class="CollegeText" style="color: #0022C4;">List of colleges from '.$_REQUEST['NJ'].'</h1>
			</div>
			'; 
			$this->content.= '<h1>College From '.$_REQUEST['Year'].'</h1>
			<a href="#List" class="btn btn-primary">List</a> - <a href="#Code" class="btn btn-primary">SQL Code</a>';
			$this->content.= '<h3 id="List"3> List </h3>';			
			$this->content.=$CollegeData->querySearchByState($_REQUEST['State']).'<br>';
			//$this->content.= $CollegeData->queryLargestLNR('2010', 'TotalNetAssets', 20);
			$this->content.= '<p>SQL query used for this search:<br>';
			$this->content.= "
				<code id='Code'>				
				$this->STH = $this->DBH->query('SELECT InstNm, Addr, City, StAbbr, Zip, WebAddr FROM Institutions
				WHERE StAbbr = '$state);
				$this->STH->setFetchMode(PDO::FETCH_OBJ); 
				</code></p>"; 
			$this->content.='</div>';
			//$this->content = print_r($_REQUEST);
		}
	}
?>
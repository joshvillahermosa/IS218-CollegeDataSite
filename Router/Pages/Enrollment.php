<?php
	class Enrollment extends page
	{
		function post()
		{
			//include '../www/Logins/CollegeDataLogin.php';
			include 'DataManip.php';
			$this->title = 'LNR per Student Page';
			include 'DBLogin.php';
			$CollegeData = new DBManip($host, $dbname, $user, $pass);
			$this->content.='<div class="container">';
			$this->content.= '
			<div class="jumbotron">
				<h1 class="CollegeText" style="color: #0022C4;">Enrollment for the year of '.$_REQUEST['Year'].'</h1>
			</div>
			'; 
			$this->content.= '<h1>College Data of Enrollment for '.$_REQUEST['Year'].'</h1>
			<a href="#Graph" class="btn btn-primary">Graph</a> - <a href="#List" class="btn btn-primary">List</a> - <a href="#Code" class="btn btn-primary">SQL Code</a>
			<h3 id="Graph">Graph Representation</h3>'
			;
			$this->content.=$CollegeData->queryHighestEnrollment($_REQUEST['Year'], $_REQUEST['Range'], 'BarChart').'<hr>';	
			$this->content.= '<h3 id="List"3> List </h3>';			
			$this->content.=$CollegeData->queryHighestEnrollment($_REQUEST['Year'], $_REQUEST['Range'], 'Table').'<br>';
			//$this->content.= $CollegeData->queryLargestLNR('2010', 'TotalNetAssets', 20);
			$this->content.= '<p>SQL query used for this search:<br>';
			$this->content.= '
				<code id="Code">				
				$this->STH = $this->DBH->query("SELECT InstNm, (FinancialData".$year.".".$LNR."/Demographics".$year.".GrandTotal) <br>
					AS ".$LNR." FROM Institutions INNER JOIN FinancialData".$year." ON Institutions.UnitId = FinancialData".$year.".UnitId INNER JOIN Demographics".$year." <br>
					ON Institutions.UnitId = Demographics".$year.".UnitId  ORDER BY ".$LNR." DESC LIMIT ".$range);<br>
				$this->STH->setFetchMode(PDO::FETCH_OBJ); <br>
				$count = 1;
				</code></p>'; 
			$this->content.='</div>';
			//$this->content = print_r($_REQUEST);
		}
	}
?>
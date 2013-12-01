<?php
	class LNR extends page
	{
		function post()
		{
			include 'DataManip.php';
			$this->title = 'LNR Page';
			include 'DBLogin.php';
			$CollegeData = new DBManip($host, $dbname, $user, $pass);
			$this->content.='<div class="container">';
			$this->content.= '
			<div class="jumbotron">
				<h1 class="CollegeText" style="color: #3CC43F;">'.$_REQUEST['LNR'].' for the year of '.$_REQUEST['Year'].'</h1>
			</div>
			'; 
			$this->content.= '<h1>College Data of '.$_REQUEST['LNR'].' for the year '.$_REQUEST['Year'].'</h1>
			<a href="#Graph" class="btn btn-primary">Graph</a> - <a href="#List" class="btn btn-primary">List</a> - <a href="#Code" class="btn btn-primary">SQL Code</a>
			<h3 id="Graph">Graph Representation</h3>'
			;
			$this->content.=$CollegeData->queryLargestLNR($_REQUEST['Year'], $_REQUEST['LNR'], $_REQUEST['Range'], 'BarChart').'<rr>';	
			$this->content.= '<h3 id="List"3> List </h3>';		
			$this->content.=$CollegeData->queryLargestLNR($_REQUEST['Year'], $_REQUEST['LNR'], $_REQUEST['Range'], 'Table').'<br>';
			//$this->content.= $CollegeData->queryLargestLNR('2010', 'TotalNetAssets', 20);
			$this->content.= '<p>SQL query used for this search:<br>';
			$this->content.= '
				<code id="Code">			
				$this->STH = $this->DBH->query("SELECT InstNm, FinancialData$year.$LNR <br>
				FROM Institutions INNER JOIN FinancialData.$year WHERE Institutions.UnitId = FinancialData$year.UnitId <br>
				GROUP BY FinancialData$year.$NR. ORDER BY FinancialData$year.$LNR DESC LIMIT $range");<br>
				$this->STH->setFetchMode(PDO::FETCH_OBJ); 
				</code></p>'; 
			$this->content.='</div>';

			//$this->content = print_r($_REQUEST);
		}
	}
?>
<?php
	class LiabilitiesChange extends page
	{
		function post()
		{
			//include '../www/Logins/CollegeDataLogin.php';
			include 'DataManip.php';
			$this->title = 'Highest Liabilities Percentage Change';
			include 'DBLogin.php';
			$CollegeData = new DBManip($host, $dbname, $user, $pass);
			$this->content.='<div class="container">';
			$this->content.= '
			<div class="jumbotron">
				<h1 class="CollegeText" style="color: #FC91FF;">Highest Liabilities Percentage Change</h1>
			</div>
			'; 
			$this->content.= '<h1>College Data of Highest Liabilities Percentage Change</h1>
			<p>At this point Im just typing anything in the description</p>
			<a href="#Graph" class="btn btn-primary">Graph</a> - <a href="#List" class="btn btn-primary">List</a> - <a href="#Code" class="btn btn-primary">SQL Code</a>
			<h3 id="Graph">Graph Representation</h3>'
			;
			$this->content.=$CollegeData->queryPercentChangeLiabilities($_REQUEST['Range'], 'BarChart').'<hr>';	
			$this->content.= '<h3 id="List"3> List </h3>';			
			$this->content.=$CollegeData->queryPercentChangeLiabilities($_REQUEST['Range'], 'Table').'<br>';
			//$this->content.= $CollegeData->queryLargestLNR('2010', 'TotalNetAssets', 20);
			$this->content.= '<p>SQL query used for this search:<br>';
			$this->content.= "
				<code id='Code'>				
					$this->STH = $this->DBH->query('SELECT InstNm, ((FinancialData2010.TotalLiabilities - FinancialData2011.TotalLiabilities)/FinancialData2010.TotalLiabilities) <br>
						AS PercentChange FROM Institutions <br>
						INNER JOIN FinancialData2010 ON Institutions.UnitId = FinancialData2010.UnitId <br>
						INNER JOIN FinancialData2011 ON Institutions.UnitId = FinancialData2011.UnitId <br>
						ORDER BY PercentChange DESC LIMIT '.$range);<br>
					$this->STH->setFetchMode(PDO::FETCH_OBJ); <br>
					$count = 1;<br>
					</code></p>"; 
			$this->content.='</div>';
			//$this->content = print_r($_REQUEST);
		}
	}
?>
<?php
	class TotalLNR extends page
	{
		function get()
		{
			//include '../www/Logins/CollegeDataLogin.php';
			include 'DataManip.php';
			$this->title = 'LNR per Student Page';
			include 'DBLogin.php';
			$CollegeData = new DBManip($host, $dbname, $user, $pass);
			$this->content.='<div class="container">';
			$this->content.= '
			<div class="jumbotron">
				<h1 class="CollegeText" style="color: #14FCE4;">Top 5 College LNR Stats</h1>
			</div>
			'; 
			$this->content.= '<h1>College Data for total LNR with the top 5 Colleges</h1>'
			;

			$this->content.= '<h1 id="Tables">Tables</h1>';
			$this->content.= '<h2>2010 Total Liabilities</h2>';
			$this->content.= $CollegeData->queryLargestLNR(2010, 'TotalLiabilities', 5 , 'Table');
			$this->content.= '<h2>2010 Total Net Assets</h2>';
			$this->content.= $CollegeData->queryLargestLNR(2010, 'TotalNetAssets', 5 , 'Table');
			$this->content.= '<h2>2010 Total Revenues</h2>';
			$this->content.= $CollegeData->queryLargestLNR(2010, 'TotalRevenues', 5 , 'Table');
			$this->content.= '<h2>2011 Total Liabilities</h2>';
			$this->content.= $CollegeData->queryLargestLNR(2011, 'TotalLiabilities', 5 , 'Table');
			$this->content.= '<h2>2011 Total Net Assets</h2>';
			$this->content.= $CollegeData->queryLargestLNR(2011, 'TotalNetAssets', 5 , 'Table');
			$this->content.= '<h2>2011 Total Revenues</h2>';
			$this->content.= $CollegeData->queryLargestLNR(2011, 'TotalRevenues', 5 , 'Table');
			
			$this->content.= '<p>SQL query used for this search:<br>';
			$this->content.='</div>';
			//$this->content = print_r($_REQUEST);
		}
	}
?>
<?php

	error_reporting(0);
	//$CollegeData = new DBManip('localhost', 'CollegeData', 'root', 'JayJPVillaUS07*');
	//$CollegeData->queryTopTenInsitutions();
	//$CollegeData->queryHighestEnrollment('2011', 100);

	class DBManip
	{
		public $DBH;
		public $STH;

		function __construct($host, $dbName, $user, $pass)
		{
			try
			{
				$this->DBH = new PDO('mysql:host='.$host.'; dbname='.$dbName, $user, $pass);
				echo 'Database connected<br><hr>';
			}
			catch(PDOException $e)
			{
				echo 'Connection Failed <br> Error message: ';
				echo $e->getMessage();
			}
		}

		//TestQuery
		function queryTopTenInsitutions()
		{
			$this->STH = $this->DBH->query('SELECT * FROM Institutions LIMIT 10');
			$this->STH->setFetchMode(PDO::FETCH_OBJ);
			while ($row = $this->STH->fetch())
			{
				echo $row->UnitId.'<br>';
				echo $row->InstNm.'<br>';
				echo $row->Addr.'<br>';
				echo $row->City.'<br>';
				echo $row->StAbbr.'<br>';
				echo $row->Zip.'<br>';
				echo '<a href="http://'.$row->WebAddr.'">'.$row->WebAddr.'</a><br>';
				echo $row->GeoLong.'<br>';
				echo $row->GeoLat.'<hr>';
			}
		}

		function queryHighestEnrollment($year, $range, $returnType)
		{
			if(!isset($range))
			{
				$range = 10;
			}
			if ($range <= 0)
			{
				$range = 1;
			}
			elseif ($range >= 50) 
			{
				$range = 50;
			}
			$this->STH = $this->DBH->query('SELECT InstNm, Demographics'.$year.'.GrandTotal FROM Institutions INNER JOIN  
				Demographics'.$year.' WHERE Institutions.UnitId = Demographics'.$year.'.UnitId ORDER BY Demographics'.$year.'.GrandTotal DESC 
				LIMIT '.$range);
			$this->STH->setFetchMode(PDO::FETCH_OBJ); 
			$count = 1;

			//Return Type Table
			if($returnType == 'Table')
			{
				$content .= "<table class='table'>
					<tr>
						<th>Rank</th><th>College/University of</th><th>Enrollment of ".$year."</th>
					</tr>
				";
				while ($row = $this->STH->fetch()) 
				{
					$content .= '<tr>';
					$content .= '<td>'.$count.'</td>';
					$content .= '<td>'.$row->InstNm.'</td>';
					$content .= '<td>'.$row->GrandTotal.'</td>';
					$content .= '</tr>';
					//echo '<hr>';
					$count++;
				}
				$content .= '</table>';
				return $content;
			}
			elseif ($returnType == 'BarChart') 
			{
				$college;
				$data;
				while ($row = $this->STH->fetch()) 
				{
					$college[$count] = $row->InstNm;
					$data[$count] = $row->GrandTotal;
					$count++;
				}
				$content = '
				<div class="container">
		            <div class="row">
		                <canvas id="Chart" class="col-lg-12" width="1200" height="600"></canvas>
		            </div>
		        </div>
				<script>
					 var data = 
				        {
				            labels :[
				';
				for($i = 1; $i <= count($college); $i++)
				{
					$content.= '"'.$college[$i].'"';
					if($i < count($college))
					{
						$content .= ',';
					}
				}
				$content .= '],
					datasets:
	                [
	                    {
	                        fillColor:  "#1A4604",
	                        strokeColor : "#000000",
	                        data:  [
				';
				for($j = 1; $j <= count($data); $j++)
				{
					$content.= $data[$j];
					if($j < count($data))
					{
						$content .= ',';
					}					
				}
				$content .= '
								]
		                    }  
		                ]
		            }
		            var ctx = $("#Chart").get(0).getContext("2d");
		            var BarChart = new Chart(ctx).Bar(data);
		        </script>

				';
				return $content;
			}
			else
			{
				echo '<p>No return type specified.</p>';
			}

		}

		function queryLargestLNR($year, $LNR, $range, $returnType) //IMPORT DATA FOR TOTAL REVUNES
		{
			$content;
			if(!isset($range))
			{
				$range = 10;
			}
			if ($range <= 0)
			{
				$range = 1;
			}
			elseif ($range >= 50) 
			{
				$range = 50;
			}

			//Formatter: CONCAT("$", FORMAT(FinancialData'.$year.'.'.$LNR.', 2)) AS '$LNR.'

			$this->STH = $this->DBH->query('SELECT InstNm, FinancialData'.$year.'.'.$LNR.' 
				FROM Institutions INNER JOIN FinancialData'.$year.' WHERE Institutions.UnitId = FinancialData'.$year.'.UnitId 
				GROUP BY FinancialData'.$year.'.'.$LNR.' ORDER BY FinancialData'.$year.'.'.$LNR.' DESC LIMIT '.$range);
			$this->STH->setFetchMode(PDO::FETCH_OBJ); 
			$count = 1;

			//If return type is Table
			if($returnType == 'Table')
			{
				$content .= "<table class='table'>
					<tr>
						<th>Rank</th><th>College/University</th><th>".$LNR." of ".$year."</th>
					</tr>
				";
				while ($row = $this->STH->fetch()) 
				{
					$content .= '<tr>';
					$content .= '<td>'.$count.'</td>';
					$content .= '<td>'.$row->InstNm.'</td>';
					$content .= '<td id="Currency">$'.$row->$LNR.'</td>';
					$content .= '</tr>';
					//echo '<hr>';
					$count++;
				}
				$content .= '</table>';
				return $content;
			}
			elseif ($returnType == 'BarChart') 
			{
				$college;
				$data;
				while ($row = $this->STH->fetch()) 
				{
					$college[$count] = $row->InstNm;
					$data[$count] = $row->$LNR;
					$count++;
				}
				$content = '
				<div class="container">
		            <div class="row">
		                <canvas id="Chart" class="col-lg-12" width="1200" height="600"></canvas>
		            </div>
		        </div>
				<script>
					 var data = 
				        {
				            labels :[
				';
				for($i = 1; $i <= count($college); $i++)
				{
					$content.= '"'.$college[$i].'"';
					if($i < count($college))
					{
						$content .= ',';
					}
				}
				$content .= '],
					datasets:
	                [
	                    {
	                        fillColor:  "#1A4604",
	                        strokeColor : "#000000",
	                        data:  [
				';
				for($j = 1; $j <= count($data); $j++)
				{
					$content.= $data[$j];
					if($j < count($data))
					{
						$content .= ',';
					}					
				}
				$content .= '
								]
		                    }  
		                ]
		            }
		            var ctx = $("#Chart").get(0).getContext("2d");
		            var BarChart = new Chart(ctx).Bar(data);
		        </script>

				';
				return $content;
			}
			else
			{
				echo '<p>No return type specified.</p>';
			}
		}

		function queryLargestLNRPerStudent($year, $LNR, $range, $returnType) //IMPORT DATA FOR TOTAL REVUNES
		{
			$content;
			if(!isset($range))
			{
				$range = 10;
			}

			if ($range <= 0)
			{
				$range = 1;
			}
			elseif ($range >= 50) 
			{
				$range = 50;
			}

			//Formatter: CONCAT("$", FORMAT(FinancialData'.$year.'.'.$LNR.', 2)) AS '$LNR.'

			$this->STH = $this->DBH->query('SELECT InstNm, (FinancialData'.$year.'.'.$LNR.'/Demographics'.$year.'.GrandTotal) 
				AS '.$LNR.' FROM Institutions INNER JOIN FinancialData'.$year.' ON Institutions.UnitId = FinancialData'.$year.'.UnitId INNER JOIN Demographics'.$year.' 
				ON Institutions.UnitId = Demographics'.$year.'.UnitId  ORDER BY '.$LNR.' DESC LIMIT '.$range);
			$this->STH->setFetchMode(PDO::FETCH_OBJ); 
			$count = 1;

			//If return type is Table
			if($returnType == 'Table')
			{
				$content .= "<table class='table'>
					<tr>
						<th>Rank</th><th>College/University</th><th>".$LNR." per student of ".$year."</th>
					</tr>
				";
				while ($row = $this->STH->fetch()) 
				{
					$content .= '<tr>';
					$content .= '<td>'.$count.'</td>';
					$content .= '<td>'.$row->InstNm.'</td>';
					$content .= '<td id="Currency">$'.$row->$LNR.'</td>';
					$content .= '</tr>';
					//echo '<hr>';
					$count++;
				}
				$content .= '</table>';
				return $content;
			}
			elseif ($returnType == 'BarChart') 
			{
				$college;
				$data;
				while ($row = $this->STH->fetch()) 
				{
					$college[$count] = $row->InstNm;
					$data[$count] = $row->$LNR;
					$count++;
				}
				$content = '
				<div class="container">
		            <div class="row">
		                <canvas id="Chart" class="col-lg-12" width="1200" height="600"></canvas>
		            </div>
		        </div>
				<script>
					 var data = 
				        {
				            labels :[
				';
				for($i = 1; $i <= count($college); $i++)
				{
					$content.= '"'.$college[$i].'"';
					if($i < count($college))
					{
						$content .= ',';
					}
				}
				$content .= '],
					datasets:
	                [
	                    {
	                        fillColor:  "#1A4604",
	                        strokeColor : "#000000",
	                        data:  [
				';
				for($j = 1; $j <= count($data); $j++)
				{
					$content.= $data[$j];
					if($j < count($data))
					{
						$content .= ',';
					}					
				}
				$content .= '
								]
		                    }  
		                ]
		            }
		            var ctx = $("#Chart").get(0).getContext("2d");
		            var BarChart = new Chart(ctx).Bar(data);
		        </script>

				';
				return $content;
			}
			else
			{
				echo '<p>No return type specified.</p>';
			}
		}

		function queryPercentChangeLiabilities($range, $returnType) //IMPORT DATA FOR TOTAL REVUNES
		{
			$content;
			if(!isset($range))
			{
				$range = 10;
			}
			if ($range <= 0)
			{
				$range = 1;
			}
			elseif ($range >= 50) 
			{
				$range = 50;
			}

			//Formatter: CONCAT("$", FORMAT(FinancialData'.$year.'.'.$LNR.', 2)) AS '$LNR.'
			
			$this->STH = $this->DBH->query('SELECT InstNm, ((FinancialData2010.TotalLiabilities - FinancialData2011.TotalLiabilities)/FinancialData2010.TotalLiabilities) 
				AS PercentChange FROM Institutions 
				INNER JOIN FinancialData2010 ON Institutions.UnitId = FinancialData2010.UnitId 
				INNER JOIN FinancialData2011 ON Institutions.UnitId = FinancialData2011.UnitId 
				ORDER BY PercentChange DESC LIMIT '.$range);
			$this->STH->setFetchMode(PDO::FETCH_OBJ); 
			$count = 1;

			//If return type is Table
			if($returnType == 'Table')
			{
				$content .= "<table class='table'>
					<tr>
						<th>Rank</th><th>College/University</th><th>Percent Change</th>
					</tr>
				";
				while ($row = $this->STH->fetch()) 
				{
					$content .= '<tr>';
					$content .= '<td>'.$count.'</td>';
					$content .= '<td>'.$row->InstNm.'</td>';
					$content .= '<td id="Currency">'.(($row->PercentChange)*100).'%</td>';
					$content .= '</tr>';
					//echo '<hr>';
					$count++;
				}
				$content .= '</table>';
				return $content;
			}
			elseif ($returnType == 'BarChart') 
			{
				$college;
				$data;
				while ($row = $this->STH->fetch()) 
				{
					$college[$count] = $row->InstNm;
					$data[$count] = $row->PercentChange;
					$count++;
				}
				$content = '
				<div class="container">
		            <div class="row">
		                <canvas id="Chart" class="col-lg-12" width="1200" height="600"></canvas>
		            </div>
		        </div>
				<script>
					 var data = 
				        {
				            labels :[
				';
				for($i = 1; $i <= count($college); $i++)
				{
					$content.= '"'.$college[$i].'"';
					if($i < count($college))
					{
						$content .= ',';
					}
				}
				$content .= '],
					datasets:
	                [
	                    {
	                        fillColor:  "#1A4604",
	                        strokeColor : "#000000",
	                        data:  [
				';
				for($j = 1; $j <= count($data); $j++)
				{
					$content.= $data[$j];
					if($j < count($data))
					{
						$content .= ',';
					}					
				}
				$content .= '
								]
		                    }  
		                ]
		            }
		            var ctx = $("#Chart").get(0).getContext("2d");
		            var BarChart = new Chart(ctx).Bar(data);
		        </script>

				';
				return $content;
			}
			else
			{
				echo '<p>No return type specified.</p>';
			}
		}

		function queryPercentChangeEnrollment($range, $returnType) //IMPORT DATA FOR TOTAL REVUNES
		{
			$content;
			if(!isset($range))
			{
				$range = 10;
			}
			if ($range <= 0)
			{
				$range = 1;
			}
			elseif ($range >= 50) 
			{
				$range = 50;
			}

			//Formatter: CONCAT("$", FORMAT(FinancialData'.$year.'.'.$LNR.', 2)) AS '$LNR.'
			
			$this->STH = $this->DBH->query('SELECT InstNm, ((Demographics2010.GrandTotal - Demographics2011.GrandTotal)/Demographics2010.GrandTotal) 
				AS PercentChange FROM Institutions 
				INNER JOIN Demographics2010 ON Institutions.UnitId = Demographics2010.UnitId 
				INNER JOIN Demographics2011 ON Institutions.UnitId = Demographics2011.UnitId 
				ORDER BY PercentChange DESC LIMIT '.$range);
			$this->STH->setFetchMode(PDO::FETCH_OBJ); 
			$count = 1;

			//If return type is Table
			if($returnType == 'Table')
			{
				$content .= "<table class='table'>
					<tr>
						<th>Rank</th><th>College/University</th><th>Percent Change</th>
					</tr>
				";
				while ($row = $this->STH->fetch()) 
				{
					$content .= '<tr>';
					$content .= '<td>'.$count.'</td>';
					$content .= '<td>'.$row->InstNm.'</td>';
					$content .= '<td id="Currency">'.(($row->PercentChange)*100).'%</td>';
					$content .= '</tr>';
					//echo '<hr>';
					$count++;
				}
				$content .= '</table>';
				return $content;
			}
			elseif ($returnType == 'BarChart') 
			{
				$college;
				$data;
				while ($row = $this->STH->fetch()) 
				{
					$college[$count] = $row->InstNm;
					$data[$count] = $row->PercentChange;
					$count++;
				}
				$content = '
				<div class="container">
		            <div class="row">
		                <canvas id="Chart" class="col-lg-12" width="1200" height="600"></canvas>
		            </div>
		        </div>
				<script>
					 var data = 
				        {
				            labels :[
				';
				for($i = 1; $i <= count($college); $i++)
				{
					$content.= '"'.$college[$i].'"';
					if($i < count($college))
					{
						$content .= ',';
					}
				}
				$content .= '],
					datasets:
	                [
	                    {
	                        fillColor:  "#1A4604",
	                        strokeColor : "#000000",
	                        data:  [
				';
				for($j = 1; $j <= count($data); $j++)
				{
					$content.= $data[$j];
					if($j < count($data))
					{
						$content .= ',';
					}					
				}
				$content .= '
								]
		                    }  
		                ]
		            }
		            var ctx = $("#Chart").get(0).getContext("2d");
		            var BarChart = new Chart(ctx).Bar(data);
		        </script>

				';
				return $content;
			}
			else
			{
				echo '<p>No return type specified.</p>';
			}
		}

		function querySearchByState($state) //IMPORT DATA FOR TOTAL REVUNES
		{
			$content;

			//Formatter: CONCAT("$", FORMAT(FinancialData'.$year.'.'.$LNR.', 2)) AS '$LNR.'
			
			$this->STH = $this->DBH->query('SELECT InstNm, Addr, City, StAbbr, Zip, WebAddr FROM Institutions
				WHERE StAbbr = "'.$state.'"');
			$this->STH->setFetchMode(PDO::FETCH_OBJ); 

			//If return type is Table
			$content .= "<table class='table'>
				<tr>
					<th>College/University</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>URL</th>
				</tr>
			";
			while ($row = $this->STH->fetch()) 
			{
				$content .= '<tr>';
				$content .= '<td>'.$row->InstNm.'</td>';
				$content .= '<td>'.$row->Addr.'</td>';
				$content .= '<td>'.$row->City.'</td>';
				$content .= '<td>'.$row->StAbbr.'</td>';
				$content .= '<td>'.$row->Zip.'</td>';
				$content .= '<td><a href="http://'.$row->WebAddr.'"">'.$row->WebAddr.'</a></td>';
				$content .= '</tr>';
				//echo '<hr>';
				$count++;
			}
			$content .= '</table>';
			return $content;
		}
		function kill()
		{
			$this->DBH = NULL;
		}

		function __destruct()
		{

		}
	}	
?>
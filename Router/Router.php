<?php

	include 'Pages/Page.php';
	include 'Pages/HomePage.php';
	include 'Pages/LNRPerStudent.php';
	include 'Pages/LNR.php';
	include 'Pages/Enrollment.php';
	include 'Pages/TotalLNR.php';
	include 'Pages/LiabilitiesChange.php';
	include 'Pages/EnrollmentChange.php';
	include 'Pages/SearchByState.php';


	class website
	{
		function __construct()
		{
			$page = 'homePage';
            $arg = NULL;

            if (isset($_REQUEST['page'])){
                    $page = $_REQUEST['page'];
            }
            if (isset($_REQUEST['arg'])){
                    $arg = $_REQUEST['arg'];
            }
            $page = new $page($arg);
		}

		function check()
		{
			echo 'Function works';
		}
	}		
?>
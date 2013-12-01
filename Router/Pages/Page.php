<?php	
	abstract class page
	{
		//Variables to create web page

		//Dynamic attributes. 
		public $title; 
		public $contentHeader; 
		public $contnet;

		//Static attributes
		public $hmtl;
		public $head;
		public $body;
		public $headBody;
		public $nav;
		public $footer;
		public $libraries;
		public $modals;

		function createPage(){
			$this->libraries = '
		        <script src="js/vendor/jquery-1.10.1.min.js"></script>
		        <script src="js/vendor/bootstrap.min.js"></script>
		        <script src="js/vendor/jquery.cycle.all.js"></script>
		        <script src="js/vendor/underscore-min.js"></script>
		        <script src="js/vendor/backbone-min.js"></script>
		        <script src="js/vendor/handlebars.js"></script>
		        <script src="js/vendor/Chart.min.js"></script>

		        <!-- JavaScript Made Files -->
		        <script src="js/views/viewTools.js"></script>
		        <script src="js/main.js"></script>

			';

			$this->modals ='
				<!--LNR-->
				<div class="modal fade" id="LNR" tabindex="-1" role="dialog" aria-labelledby="LNR" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="LNRLabel">LNR Selector</h3>
				            </div>
				            <div class="modal-body">
				                <p>The LNR (Liabilities, Net Assets, Revenues)View will gather the largest of the three from top to bottom</p>
				                <form class="form" action="index.php?page=LNR" method="POST">
				                    <div class="form-group">
				                        <h4>Choose the year you would like to generate</h4>
				                        <div class="radio">
				                            <label for="Year">2010  
				                                <input type="radio" name="Year" value="2010">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="Year">2011  
				                                <input type="radio" name="Year" value="2011">
				                            </label>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <h4>Choose the data you would like to generate</h4>
				                        <div class="radio">
				                            <label for="LNR">Total Liabilities  
				                                <input type="radio" name="LNR" value="TotalLiabilities">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="LNR">Total Net Assets  
				                                <input type="radio" name="LNR" value="TotalNetAssets">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="LNR">Total Revenues  
				                                <input type="radio" name="LNR" value="TotalRevenues">
				                            </label>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <h4>Enter your range from 1 - 50 </h4>
				                        <p>(If the value is above or less than it will default to 1 or 50, sorry)</p>
				                        <label for="Range">
				                            <input type="text" name="Range">
				                        </label>
				                    </div>
				                    <button type="submit" class="btn btn-success btn-lg">View</button>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default btn-xsm" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/LNR-->

				<!--LNRPerStudent-->
				<div class="modal fade" id="LNRPerStudent" tabindex="-1" role="dialog" aria-labelledby="LNRPerStudent" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="LNRPerStudentLabel">LNR Per Student Selector</h3>
				            </div>
				            <div class="modal-body">
				                <p>The LNR (Liabilities, Net Assets, Revenues) per Student view will gather the largest of the three from top to bottom. This is calculated by your choice of of LNR divided by enrollment of each instutition</p>
				                <form class="form" action="index.php?page=LNRPerStudent" method="POST">
				                    <div class="form-group">
				                        <h4>Choose the year you would like to generate</h4>
				                        <div class="radio">
				                            <label for="Year">2010  
				                                <input type="radio" name="Year" value="2010">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="Year">2011  
				                                <input type="radio" name="Year" value="2011">
				                            </label>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <h4>Choose the data you would like to generate</h4>
				                        <div class="radio">
				                            <label for="LNR">Total Liabilities  
				                                <input type="radio" name="LNR" value="TotalLiabilities">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="LNR">Total Net Assets  
				                                <input type="radio" name="LNR" value="TotalNetAssets">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="LNR">Total Revenues  
				                                <input type="radio" name="LNR" value="TotalRevenues">
				                            </label>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <h4>Enter your range from 1 - 50 </h4>
				                        <p>(If the value is above or less than it will default to 1 or 50, sorry)</p>
				                        <label for="Range">
				                            <input type="text" name="Range">
				                        </label>
				                    </div>
				                    <button type="submit" class="btn btn-success btn-lg">View</button>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/LNRPerstudnet-->

				<!--Enrollment-->
				<div class="modal fade" id="Enrollment" tabindex="-1" role="dialog" aria-labelledby="Enrollment" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="EnrollmentLabel">Highest Enrollment Selector</h3>
				            </div>
				            <div class="modal-body">
				                <p>View the highest enrollment for the 2011 and 2012</p>
				                <form class="form" action="index.php?page=Enrollment" method="POST">
				                    <div class="form-group">
				                        <h4>Choose the year you would like to generate</h4>
				                        <div class="radio">
				                            <label for="Year">2010  
				                                <input type="radio" name="Year" value="2010">
				                            </label>
				                        </div>
				                        <div class="radio">
				                            <label for="Year">2011  
				                                <input type="radio" name="Year" value="2011">
				                            </label>
				                        </div>
				                    </div>
				                    <div class="form-group">
				                        <h4>Enter your range from 1 - 50 </h4>
				                        <p>(If the value is above or less than it will default to 1 or 50, sorry)</p>
				                        <label for="Range">
				                            <input type="text" name="range">
				                        </label>
				                    </div>
				                    <button type="submit" class="btn btn-success">View</button>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/Enrollment-->

				<!--TotalLNR-->
				<div class="modal fade" id="TotalLNR" tabindex="-1" role="dialog" aria-labelledby="TotalLNR" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="TotalLNRLabel">Total Liabilities, Net Assets, and Revenues (TotalLNR)</h3>
				            </div>
				            <div class="modal-body">
				                <p>Total Liabilities, Net Assets, and Revenues (TotalLNR) will give you the top 5 colleges in comparison with LNR statistics. It will give you multiple tables and graphs relating to each college.</p>
				                <a href="index.php?page=TotalLNR" class="btn btn-danger"> View Total LNR</a>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/TotalLNR-->

				<!--LiabilitiesChange-->
				<div class="modal fade" id="LiabilitiesChange" tabindex="-1" role="dialog" aria-labelledby="LiabilitiesChange" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="TotalLNRLabel">Highest Liabilities Percent Change for 2010 to 2011</h3>
				            </div>
				            <div class="modal-body">
				                <p>Change of Liabilities from 2010 to 2011. Oh man Im tired of typing out detail....</p>
				                 <form class="form" action="index.php?page=LiabilitiesChange" method="POST">
				                    <div class="form-group">
				                        <h4>Enter your range from 1 - 50 </h4>
				                        <p>(If the value is above or less than it will default to 1 or 50, sorry)</p>
				                        <label for="Range">
				                            <input type="text" name="range">
				                        </label>
				                    </div>
				                    <button type="submit" class="btn btn-success">View</button>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/LiablilitiesChange-->

				<!--Enrollment Change-->
				<div class="modal fade" id="EnrollmentChange" tabindex="-1" role="dialog" aria-labelledby="EnrollmentChan" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="EnrollmentChangeLabel">Highest Enrollment Percent Change for 2010 to 2011</h3>
				            </div>
				            <div class="modal-body">
				                <p>Change of Enrollment for each college/university from 2010 to 2011. Oh man Im tired of typing out detail....</p>
				                 <form class="form" action="index.php?page=EnrollmentChange" method="POST">
				                    <div class="form-group">
				                        <h4>Enter your range from 1 - 50 </h4>
				                        <p>(If the value is above or less than it will default to 1 or 50, sorry)</p>
				                        <label for="Range">
				                            <input type="text" name="range">
				                        </label>
				                    </div>
				                    <button type="submit" class="btn btn-success">View</button>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/Enrollment Change-->

				<!--Enrollment Change-->
				<div class="modal fade" id="SearchByState" tabindex="-1" role="dialog" aria-labelledby="SearchByState" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                 <button class="close" type="button" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h3 class="modal-title" id="SearchByStateLabel">Search A college by State Abbrevation</h3>
				            </div>
				            <div class="modal-body">
				                <p>Find colleges and Universities by state</p>
				                 <form class="form" action="index.php?page=SearchByState" method="POST">
				                    <div class="form-group">
				                        <h4>Enter state abbreviations</h4>
				                        <p>Enter the state abbreviation to generate a list of colleges.</p>
				                        <label for="Range">
				                            <input type="text" name="State" maxlength="2">
				                        </label>
				                    </div>
				                    <button type="submit" class="btn btn-success">View</button>
				                </form>
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				            </div>
				        </div>
				    </div>
				</div>
				<!--/Enrollment Change-->
				<!--/________________________MODALS__________________________________-->
			';
			$this->nav = '
		        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		            <div class="container">
		                <div class="navbar-header">
		                    <a href="index.php?page=homePage" class="nav navbar-brand">Home Page</a>
		                </div>
		                <ul class="nav navbar-nav">
                            <li><a href="" data-toggle="modal" data-target="#Enrollment">Largest Enrollments</a></li>
                            <li><a href="" data-toggle="modal" data-target="#EnrollmentChange">Enrollment Change</a></li>
		                    <li><a href="" data-toggle="modal" data-target="#LNR">LNR View</a></li>
		                    <li><a href="" data-toggle="modal" data-target="#LNRPerStudent">LNR Per Student View</a></li>
		                    <li><a href="" data-toggle="modal" data-target="#TotalLNR">TotalLNR</a></li>
		                    <li><a href="" data-toggle="modal" data-target="#LiabilitiesChange">Liabilities Change</a></li>
		                    <li><a href="" data-toggle="modal" data-target="#SearchByState">Search By State</a></li>
		                </ul>
		            </div>
		        </nav>
        ';
			$this->head = '
			    <head>
			        <meta charset="utf-8">
			        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
			        <title>'.$this->title.'</title>
			        <meta name="description" content="">
			        <meta name="viewport" content="width=device-width">

			        <link rel="stylesheet" href="css/bootstrap.min.css">
			        <style>
			            body {
			                padding-top: 0px;
			                padding-bottom: 40px;
			            }
			        </style>

			        <!-- CSS Files -->
			        <link rel="stylesheet" href="css/main.css">
			        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
			        '.$this->libraries.'
			    </head>			
		';
			$this->footer = '
		         <footer id="footer" class="footer container">
		            <div class="text-muted">
		                &copy; Joshua John Villahermosa <br>
		                <p>Note: All tools made with the development of this Website are NOT tools created by me and NOT coprtighted by me. They belong to thier respective developers to bring a awesome user expernence. For more information about these tools, <a href="#/tools">click here</a> to visit thier website.</p>
		            </div>
		            <div id="tools"></div>
		        </footer>
			';

			$this->body = '
                 <body>
                    <!--[if lt IE 7]>
                        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
                    <![endif]-->

                    <!-- This code is taken from http://twitter.github.com/Boilerplate/examples/hero.html -->
                    <!-- Content Here -->
                   '.$this->nav.'       
                   '.$this->content.'
                   '.$this->footer.'
                   '.$this->modals.'
               </body>
			';
			$this->headBody = $this->head.$this->body;
			$this->html = '
				 <!DOCTYPE html>
				 <html>
                    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
                    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
                    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
                    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
                	<div id="BG">
                    	'.$this->headBody.'
                	</div>
                </html>
            ';
		} 

		function __construct($arg = NULL)
		{
			if($_SERVER['REQUEST_METHOD'] == 'GET')
			{
				$this->get();
			}
			else
			{
				$this->post();
			}
		}

		function get(){}
		function post(){}

		function __destruct()
		{
			$this->createPage();
			echo $this->html;
		}
	}
?>
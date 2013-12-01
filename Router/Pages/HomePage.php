<?php
	//include 'Page.php';	
	class homePage extends page
	{
		function get()
		{
			$this->title = 'IS218 College Data 2010 and 2011';
			//$this->contentHeader = '<h1>Welcome!</h1>';
			$this->content = '
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h4 style="color: white;">The Angry Honeybager presents...</h4>
                        <h1 class="CollegeText" style="color: #3CC43F;">College Data of 2010 and 2011</h1>  
                        <a href="http://google.com" class="btn btn-primary">Who is the Angry Honey Badger?</a>
                        <a href="http://google.com" class="btn btn-success">About this frickin Project</a>
                    </div>
                    <div class="col-lg-4">
                        <img src="img/StrctImg/angry-honey-badger.png">
                    </div>
                </div>
                <div class="row">
                    <hr>
                    <h4 style="color: white;">From the assignment document</h4>
                    <a href="">Q1</a> |
                    <a href="index.php?page=LNR&Year=2010&LNR=Liabilities">Q2</a> |
                    <a href="">Q3</a> |
                    <a href="">Q4</a> |
                    <a href="">Q5</a> |
                    <a href="">Q6</a> |
                    <a href="">Q7</a> |
                    <a href="">Q8</a> |
                    <a href="">Q9</a> |
                    <a href="">Q10</a> |
                    <a href="">Q11</a>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <h3>Data Comparison of all US colleges</h3>
                <p>This project (NJIT - IS218 - Advance Web Development) demonstrates the capabilities of using PHP, MySQL, and PDO to change the content of the website. This web application will compare different colleges all around the US with financial data and diversity. This data comes from 2010 and 2012 Carnegie college survey (I think... I was just given the data to put this together). Anyway, enjoy exploring the site and compare college data and see which fits your..... needs? (Why are you even here? Im pretty sure there are alot better resources out there) Derp Lore Ipsum!
                <b>Please note all image are from <a href="http://google.com">Google.com</a></b></p>
            </div>
            <div class="row">          
                <div class="col-lg-8">
                    <h2>College Enrollment</h2>
                    <p>View the college rates of 2010 and 2011. Data collected will show who has the highest enrollment, and see how they have changed from year to another.</p>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#Enrollment">Enrollment Rates!</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#EnrollmentChange">Yearly Enrollment Changes!</button>
                </div>
                <div class="col-lg-4">
                    <img src="img/StrctImg/funny-college-party.jpg" class="img-circle ImgBorder" width="350" height="218">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <img src="img/StrctImg/Saving-money-in-college.jpg" class="img-circle ImgBorder" width="350" height="218">
                </div>
                <div class="col-lg-8">
                    <h2>Total Liabilities, Net Assets, and Revenues (LNR)</h2>
                    <p>See how colleges are spending your money! Our data will tell who who has the highest Liabilites, Net Assets, and Revenues (LNR) for you money. We present you with a graphical represntation and a table fo you to see whats up. All for your education to them getting fat with your misery and money!</p>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#LNR">Your LNR!</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#LNRPerStudent">Your LNR Per Student!</button>
                    <button class="btn btn-success" data-toggle="modal" data-target="#TotalLNR">Top Colleges of LNR</button>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#LiabilitiesChange">Highest Change in Liabilities</button>
                </div>
            </div>
            <div class="row">          
                <div class="col-lg-8">
                    <h2>Find a College</h2>
                    <p>Search a college, se thier LNR, Demographics, enrollment and more! View by typing in the name, state, even longtitude or lattidue!</p>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#LNR">Search by name!<button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#SearchByState">Search by state!</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#LNR">Search by Long and Lat!</button>

                </div>
                <div class="col-lg-4">
                    <img src="img/StrctImg/college-logos.jpg" class="img-circle ImgBorder" width="350" height="218">
                </div>
            </div>

        </div>
			';
		}
	}
?>
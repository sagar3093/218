
<link rel="stylesheet" href="style.css" type="text/css"> 
<?php

// CREDENTIALS

$dsn = 'mysql:host=sql2.njit.edu;dbname=sip5';
$db_user = 'sip5';  //  username
$user_pw = 'nGecvjCZi';  //  password
$database = 'sip5';

// Try connection with new PDO object, Connect
try {
    $db = new PDO($dsn, $db_user, $user_pw);
    } catch (PDOException $e){
        $error_message = $e->getMessage();
        echo "Failed to connect to MySQL: " .$error_message;
        #include('database_error.php');
        exit();
}


/*$test = new DBTest();
$test->test();
$test->querySomething();
class DBtest
{
	public $db;
	function test (){
	
					try
                        {
						$this->db = new PDO('mysql:host=sql2.njit.edu;dbname=sip5;charset=utf8', 'sip5', 'nGecvjCZi');
                                echo 'Database connected<br><hr>';
                        }
                        catch(PDOException $e)
                        {
                                echo 'Connection Failed <br> Error message: ';
                                echo $e->getMessage();
                        }
		}
		
		function querySomething()
		{
			$STH = $this->db->query('SELECT * FROM name');
			$STH->setFetchMode(PDO::FETCH_OBJ);
			
			echo '<table>';
			while($row = $this->db->fetch())
			{
				echo '<tr>';
				echo '<td>'.$row->id.'</td>';
				echo '<td>'.$row->name.'</td>';
				echo '<td>'.$row->state.'</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		*/
}
// Instantiate program
$program = new program();


// begin the prog
class program {
    function __construct() {
        $page='homepage';
        $arg=NULL;
        if(isset($_REQUEST['page'])){
            $page=$_REQUEST['page'];
        }
        if(isset($_REQUEST['arg'])){
            $arg=$_REQUEST['arg'];
        }
        // echo $page
        $page = new $page($arg);
	}
    
	function __destruct() {
    }
}

// absc page class
abstract class page{
        public $content;
		public $enroll = 'SELECT * FROM enroll2011 ORDER BY enrollment DESC LIMIT 10'; 
        function menu() {
            $menu.='<P>qUESTIONS</P>';
			$menu.='<a href="./index.php"> Home &nbsp; &nbsp; &nbsp; </a>';
            $menu.='<a href="./index.php?page=q1"> Question 1 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q2"> Question 2 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q4"> Question 4 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q5"> Question 5 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q6"> Question 6 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q7"> Question 7 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q8"> Question 8 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q9"> Question 9 &nbsp; &nbsp; &nbsp; </a>';			
			$menu.='<a href="./index.php?page=q10"> Question 10 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q11"> Question 11 &nbsp; &nbsp; &nbsp; </a>';
			$menu.='<a href="./index.php?page=q12"> Question 12 &nbsp; &nbsp; &nbsp; </a>';
            return $menu;
        } 

       function __construct($arg=NULL){
            if($_SERVER['REQUEST_METHOD']=='GET'){
                $this->get();
            }
            else{
                $this->post();
            }
        } 
        function __destruct(){
            echo $this->content;
        }
} 

class homepage extends page {
	function get(){
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->intro();
	}
	function header(){
		echo '<h1>Final Project IS 218 - College Data</h1>';		
	}
	function intro(){
		echo 'hope it works!!!';
		}	
	}


// 1. 
class q1 extends page {
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}
	
	function Header(){
		echo '<h2>1. Highest Enrollment in 2011</h2>';
	}
	
	function table()
	
		global $db;
		$enroll = 'SELECT * FROM enroll2011 ORDER BY enrollment DESC LIMIT 10'; 
		echo '<table border="1"; cellpadding="5">';
		echo '<tr><th>UNI ID</th><th>Total Enrolled</th><th>Year</th></tr>';
		foreach($db->query($enroll) as $row){
    		echo '<tr><td>';
    		echo $row['id'];
    		echo '</td><td>';
    		echo $row['enrollment'];
    		echo '</td><td>';
	    	echo $row['year'];
		}
		echo '</td></tr>';
		echo '</table>';
		echo '<br />';
	}
	


// 2.
class q2 extends page {
function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}
	
	function Header(){
		echo '<h2>2. Total Liabilities 2011</h2>';
	}
	
	
	function table(){
		global $db;
		$liab = 'SELECT * FROM fin2011 ORDER BY fin2011.liability DESC LIMIT 10';
		echo '<table border="1"; cellpadding="5">';
		echo '<tr><th>UNI ID</th><th>Liabilities</th><th>Asset</th><th>Revenue</th><th>year</th></tr>';
		foreach($db->query($liab) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['liability'];
		    echo '</td><td>';
			echo $row['asset'];
		    echo '</td><td>';
			echo $row['revenue'];
		    echo '</td><td>';
		    echo $row['year'];
		    echo '</td></tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}

// 3 AND 4
class q4 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>3. - 4. Highest Net Assets: 2011</h2>';
	}
	
	function table(){
		global $db;
		$asset = 'SELECT * FROM fin2011 ORDER BY fin2011.asset DESC LIMIT 10';
		echo '<table border="1"; cellpadding="10">';
		echo '<tr><th>UNI ID</th><th>Liabilities</th><th>Asset</th><th>Revenue</th><th>year</th></tr>';
		foreach($db->query($asset) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['liability'];
		    echo '</td><td>';
			echo $row['asset'];
		    echo '</td><td>';
			echo $row['revenue'];
		    echo '</td><td>';
		    echo $row['year'];
		    echo '</td></tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}

// 5. 
class q5 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>5. Highest Total Revenues: 2011</h2>';
	}
	
	function table(){
		global $db;
		$revenue = 'SELECT * FROM fin2011 ORDER BY revenue DESC LIMIT 10;';
			echo '<table border="1"; cellpadding="10">';
			echo '<tr><th>UNI ID</th><th>Liabilities</th><th>Asset</th><th>Revenue</th><th>year</th></tr>';
		foreach($db->query($revenue) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['liability'];
		    echo '</td><td>';
			echo $row['asset'];
		    echo '</td><td>';
			echo $row['revenue'];
		    echo '</td><td>';
		    echo $row['year'];
		    echo '</td></tr>';
		}
			echo '</table>';
			echo '<br />';
	}
}

// 6.
class q6 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>6. Highest Revenues Per Student: 2011</h2>';
	}
	
	function table(){
		global $db;
		$rps= 'SELECT id, (revenue / enrollment) AS sum FROM x ORDER BY x DESC LIMIT 10';
		echo '<table border="1px"; cellpadding="10">';
		echo '<tr><th>UNI ID</th><th>Revenue/Student</th></tr>';
		foreach($db->query($rps) as $row){
		    echo '<tr><td>';
		    echo $row['universityName'];
		    echo '</td><td>';
		    echo $row['x'];
		    echo '</td><tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}

// 7. 
class q7 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function header(){
		echo '<h2>7. Highest Net Assets Per Student: 2011</h2>';
	}
	
	function table(){
		global $db;
		$aps = 'SELECT id, (asset / enrollment) AS x FROM aps ORDER BY x DESC LIMIT 10';
		echo '<table border="1"; cellpadding="10">';
		echo '<tr><th>University Name</th><th>Net Assets Per Student</th></tr>';
		foreach($db->query($aps) as $row){
		    echo '<tr><td>';
		    echo $row['universityName'];
		    echo '</td><td>';
		    echo $row['x'];
		    echo '</td><tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}

// 8
class q8 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>LIABILITIES PER SEUDENT 2011</h2>';
	}

	
	function table(){
		global $db;
		$lps = 'SELECT id, (liability / enrollment) AS x FROM lps ORDER BY x DESC LIMIT 10';
		echo '<table border="1"; cellpadding="10">';
		echo '<tr><th>Uni ID</th><th>Liabilities/Student</th></tr>';
		foreach($db->query($lps) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['x'];
		    echo '</td><tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}
// 9.
class q9 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>9. Top 5 Colleges Based on Above Statistics: 2011</h2>';
	}
	function table(){
		global $db;
	$revenue = 'SELECT id,liability, asset, revenue, ((asset+revenue)-liability) AS x FROM fin2011 ORDER BY x DESC LIMIT 5;';
			echo '<table border="1"; cellpadding="10">';
			echo '<tr><th>UNI ID</th><th>Liabilities</th><th>Asset</th><th>Revenue</th><th>X-Factor</th></tr>';
		foreach($db->query($revenue) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['liability'];
		    echo '</td><td>';
			echo $row['asset'];
		    echo '</td><td>';
			echo $row['revenue'];
		    echo '</td><td>';
		    echo $row['x'];
		    echo '</td></tr>';
		}
			echo '</table>';
			echo '<br />';
	}
}

// 11.
class q11 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>11. Largest Percent Increase in Total Liabilities 2010-2011</h2>';
	}
	

	function table(){
		global $db;
		$pl = 'SELECT id, (((liab2011 - liab2010) / liab2010)*100) AS x FROM ten ORDER BY x DESC LIMIT 5';
		echo '<table border="1"; cellpadding="10">';
		echo '<tr><th>UNI ID</th><th>Percent Increase</th></tr>';
		foreach($db->query($pl) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['x'];
		    echo '</td><tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}

// 12.
class q12 extends page {	
	function get(){
		
		$this->content.=$this->menu();
		$this->content.=$this->header();
		$this->content.=$this->table();	
	}	
	
	function Header(){
		echo '<h2>12. Largest Percent Increase in Enrollment2010-2011</h2>';
	}
	
	function table(){
		global $db;
		$pi = 'SELECT id, ((enroll2011-enroll2010) / enroll2010) AS x FROM twelve ORDER BY x DESC LIMIT 10';
		echo '<table border="1"; cellpadding="10">';
		echo '<tr><th>University Name</th><th>Percent Increase</th></tr>';
		foreach($db->query($pi) as $row){
		    echo '<tr><td>';
		    echo $row['id'];
		    echo '</td><td>';
		    echo $row['x'];
		    echo '</td><tr>';
		}
		echo '</table>';
		echo '<br />';
	}
}
?>

<?php
require_once("include.class.php");

class isLogged {
	public $User_Details="";
	public $user_currently_loged;
	public $user_current_level;
	public $user_name;
	public $alert_count;
    private $user_designation;
    private $user_profile_picture;
    private $parameters;
	public $Company_Details;
	public $reqlevel;
	    public function __construct($reqlevel)
		{
			$this->reqlevel=$reqlevel;
			$this->log = new Write_Log();
			$this->Checked();
		}
		
		private function Checked()
		{
			

		session_start();
		if(isset($_SESSION['id']))
		{
		$last_login=$_SESSION['lastlog'];
		$test  = new Init_Table();
		$test->set_table("main_signup","username");
		$test->username = $_SESSION['id'];		
		$test->mpass = $_SESSION['pass'];	
		$test->find();

		if($test->variables!="")
		{
		$this->User_Details=$test;
		
		$cdtl  = new Init_Table();
		$cdtl->set_table("main_cname","sl");
		$cdtl->sl = "1";	
		$cdtl->find();	
		$this->Company_Details=$cdtl;
		if ($this->reqlevel == 0 && $test->userlevel > 0){
		die("You need to be an admin for this page");
		}else{
		if ($test->userlevel < $this->reqlevel && $test->userlevel > 0){
			die("Your acces level is not high enough for this page, <BR> Your access level: $test->userlevel <BR>Level required: $reqlevel");
		}
		}
	
		}
		else
		{
			if(isset($_COOKIE["rememberCookieUname"],$_COOKIE["rememberCookiePassword"]))
			{
		$rememberCookieUname = $_COOKIE["rememberCookieUname"];
		$rememberCookiePassword = $_COOKIE["rememberCookiePassword"];
		if ($rememberCookiePassword != "" && $rememberCookieUname != ""){
		$rtest  = new Init_Table();
		$rtest->set_table("main_signup","username");
		$rtest->username = $rememberCookiePassword;		
		$rtest->mpass = $rememberCookieUname;		
		$rtest->find();
		if($rtest->variables!="")
		{
		$this->User_Details=$test;
		$cdtl  = new Init_Table();
		$cdtl->set_table("main_cname","sl");
		$cdtl->sl = "1";	
		$cdtl->find();	
		$this->Company_Details=$cdtl;
		




		if ($this->reqlevel == 0 && $rtest->userlevel > 0){
		die("You need to be an admin for this page");
		}else{
		if ($rtest->userlevel < $reqlevel && $rtest->userlevel > 0){
			die("Your acces level is not high enough for this page, <BR> Your access level: $rtest->userlevel <BR>Level required: $reqlevel");
		}
		}

		}
		else
		{
			die(include("login.php"));
		}
		}
		else
		{
			die(include("login.php"));
		}
		}
		}
		}		
		else
		{
			die(include("login.php"));
		}
		}
		
		
}
 $file_name = basename(parse_url($_SERVER['PHP_SELF'], PHP_URL_PATH));
 $pdo= new MainPDO();

 $_REQUEST['pnm']=base64_encode($brnch_nm=$pdo->get_value('main_menu','mnm',array('page'=>$file_name)));
 if($_REQUEST['pnm']=="")
 {
	$name2 =pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
	$file_name1=str_replace('_edt','',$name2).".php";	

	$_REQUEST['pnm']=base64_encode($brnch_nm=$pdo->get_value('main_menu','mnm',array('page'=>$file_name1))." UPDATE");	 
 }
 date_default_timezone_set('Asia/Kolkata');











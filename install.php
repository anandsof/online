<html>
<head><title>Admin Control Panel</title>
<style type="text/css">
<!--
     A:link {text-decoration: none;}
     A:visited {text-decoration: none;}
-->
</style>
</head>
<body link="#FF0000" vlink="#FF0000" alink="#FF0000">
<center>
<table border="3" cellpadding="2" cellspacing="6" width=600 bgcolor="#FFFFFF">
    <tr>
        <td bgcolor="#004080" align="left"><font
        color="#FFFFFF" size="2" face="Verdana"><strong>Installation</strong></font>
        </td>
    </tr>
    <tr>
        <td align="center"><table border="0" width=550>
            <tr>
                <td valign="top" width=50%><br>
		<font size="2" face="Verdana">
<!-- #### HTML #### -->
<?php

$admin_password = $_POST['admin_password']; 
$host = $_POST['host']; 
$database = $_POST['database'];
$login = $_POST['login'];
$password = $_POST['password'];
$email_required = $_POST['email_required'];
$create_database = $_POST['create_database'];


#- first check for config.php status
print "<font color=red>";

/*
if(!is_writable("config.php")){
	print "Please set \"config.php\" file as writablable(chmod 766), to begin installation!";
	exit;
}

require "config.php"; */

if($host != "" && $login != ""){
        $dbh = @$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_connect($host, $login, $password)
                or $dberr=1;
	if($dberr){
		print("Cannot connect to database with the information provided. Please check your host/login/password entries.");
	}else{

		@$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_select_db($database) or $dberr=1;

		if($dberr){
			if($create_database && $database != ""){
				print "<font color=navy><b>Creating $database:";
				   if ($db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_create_db($database)) {
					print ("Database created successfully\n");
					$dberr = 0;
				    } else {
					printf ("<font color=red>Error creating database: %s\n</font>", $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_error ());
				    }
				 print "</b></font>";
			}else{
				print("Cannot connect to the database. Please check your \"$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); database name\" entry!");
			}
		} else {
				print("The database allready exists. Please select a new \"$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); database name\" !");
		$dberr = 1;
			}

	}
		if($result = @mysqli_query($db_connect,"SELECT NOW()") && !$dberr,$db_connect){
			$connected = 1;
	}

}
print "</font>";


#- ask for $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); installation
?>

<?
print "<p>$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); status: ";
if($connected){
	print "<b><font color=green>connected</font></b>";

	if($admin_password != ""){
	//	write_config();
		if(create_tables() == -1){
			print "<p>Cannot create tables!"; 
		}else{
			print "<p><b>INSTALLATION COMPLETE!</b>";
			$done = 1;
		}
	}

}else{
	print "<b><font color=blue>not connected</font></b>";
}

if(!$done){
?>
<p>

<form action=install.php method=post>
<table border=0>
<tr><td>
<font size="2" face="Verdana">
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); hostname:
</td><td>
<input type=text size=20 name=host value="<? if($host != "") print $host; else print "localhost" ?>">
</td></tr>
<tr><td>
<font size="2" face="Verdana">
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); database name:
</td><td>
<input type=text size=20 name=database value="<? if($database != "") print $database; ?>">
</td><td>
<font size="2" face="Verdana">
<input type=checkbox name=create_database>Create new!
</td></tr>
<tr><td>
<font size="2" face="Verdana">
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); login:
</td><td>
<input type=text size=20 name=login value="<? if($login != "") print $login; ?>">
</td></tr>
<tr><td>
<font size="2" face="Verdana">
$db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base); password:
</td><td>
<input type=password size=20 name=password value="<? if($password != "") print $password; ?>">
</td></tr>
<tr><td>
<font size="2" face="Verdana">
Admin password:
</td><td>
<input type=password size=20 name=admin_password value="<? if($admin_password != "") print $admin_password; ?>">
</td></tr>
</table>

<p>


<input type=submit name=submit value="Install!">
</form>

<?
}

function write_config()
{
/*	global $admin_password, $host, $database, $login, $password, $email_required;

	$out = "<";
	$out .= "?php

	  \$admin_pass = \"$admin_password\";


	  \$db_host = \"$host\";
	  \$db_name = \"$database\";
	  \$db_user = \"$login\";
	  \$db_password = \"$password\";

	  \$tempz[form] = \"templates/quiz_form_template.html\";

	";
	if($email_required == "no")
		$out .= " \$email_not_required = 1; ";
	else
		$out .= " \$email_not_required = 0; ";

	$out .= "
	\n?";
	$out .= ">";


	$fp = fopen("config.php","w"); 
	fwrite($fp, $out); 
	fclose($fp); */
}


function create_tables()
{
	global $database;
	global $dbh;

	$baseconnect = $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

        $query = "
CREATE TABLE question(
   questionid int(11) NOT NULL auto_increment,
   question text,
   choice1 mediumtext,
   choice2 mediumtext,
   choice3 mediumtext,
   choice4 mediumtext,
   choice5 mediumtext,
   choice6 mediumtext,
   answer text,
   date date,
   feedback mediumtext,
   category varchar(50) default \'None\',
   reference varchar(50),
   examid int(11) NOT NULL,
   type mediumtext,
   used tinyint(2) NOT NULL DEFAULT 1,
   weight tinyint(4) NOT NULL DEFAULT 1,
   PRIMARY KEY (questionid)
)
";
        $dbc = mysqli_query($db_connect,$query);


        $query = "
CREATE TABLE exam (
   examid int(11) NOT NULL auto_increment,
   title mediumtext NOT NULL,
   id varchar(50) DEFAULT '0' NOT NULL,
   version varchar(50) DEFAULT '0' NOT NULL,
   instructions text,
   date date,
   questions tinyint(3) DEFAULT '0' NOT NULL,
   startDate date DEFAULT '0' NOT NULL,
   endDate date DEFAULT '0' NOT NULL,
   time tinyint(4) DEFAULT '0' NOT NULL,
   passingScore tinyint(3) DEFAULT '0' NOT NULL,
   active varchar(5) DEFAULT 'No',
   groupid int(11) NOT NULL default '0',
   PRIMARY KEY (examid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE candidate (
 candidateID int(11) DEFAULT '0' NOT NULL auto_increment,
 userName varchar(20),
 userPassword varchar(20),
 firstName tinytext,
 lastName tinytext,
 email varchar(50),
 address tinytext,
 city tinytext,
 state tinytext,
 postCode varchar(20),
 country tinytext,
 homePhone varchar(30),
 workPhone varchar(30),
 mobilePhone varchar(30),
 fax varchar(30),
 company tinytext,
 title tinytext,
 date date,
 admin tinyint(4) DEFAULT '0' NOT NULL,
 editGroup tinyint(4) DEFAULT '0' NOT NULL,
 editExam tinyint(4) DEFAULT '0' NOT NULL,
 PRIMARY KEY (candidateID)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE scores (
 scoreid int(11) DEFAULT '0' NOT NULL auto_increment,
 candidateID int(11) NOT NULL,
 examid int(11) NOT NULL,
 marks int(5) DEFAULT '0' NOT NULL,
 date date,
 time time,
 timetaken time,
 maxMarks int(11) default 0, 
 PRIMARY KEY (scoreid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE test (
 scoreid int(11) NOT NULL,
 questionid int(11) NOT NULL,
 marks int(3) DEFAULT '0',
 answer text,
 markQuestion varchar(5),
 PRIMARY KEY (scoreid,questionid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE temp (
 sno int(11) DEFAULT '0' NOT NULL auto_increment,
 scoreid int(11) NOT NULL,
 questionid int(11) NOT NULL,
 answer text,
 markQuestion varchar(5),
 marks int(2) default 0,
 PRIMARY KEY (sno)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE groups (
 groupid int(11) DEFAULT '0' NOT NULL auto_increment,
 groupName varchar(50) default 'visitor' NOT NULL,
 PRIMARY KEY (groupid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE groupPermissions (
 groupPermissionid int(11) NOT NULL auto_increment,
 candidateID int(11) NOT NULL default '0',
 groupid int(11) NOT NULL default '0',
 PRIMARY KEY (groupPermissionid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE examPermissions (
 examPermissionid int(11) NOT NULL auto_increment,
 candidateID int(11) NOT NULL default '0',
 examid int(11) NOT NULL default '0',
 PRIMARY KEY (examPermissionid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE candidateGroup (
 candidateGroupid int(11) NOT NULL auto_increment,
 candidateID int(11) NOT NULL default '0',
 groupid int(11) NOT NULL default '0',
 PRIMARY KEY (candidateGroupid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE images (
  imageid int(11) NOT NULL auto_increment,
  questionid int(11) NOT NULL default '0',
  description varchar(255) NOT NULL default '',
  filename varchar(255) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  width smallint(6) NOT NULL default '0',
  height smallint(6) NOT NULL default '0',
  filetype varchar(15) NOT NULL default '',
  data blob NOT NULL,
  PRIMARY KEY  (imageid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE imageshow (
  imageid int(11) NOT NULL auto_increment,
  description varchar(255) NOT NULL default '',
  filename varchar(255) NOT NULL default '',
  filesize int(11) NOT NULL default '0',
  width smallint(6) NOT NULL default '0',
  height smallint(6) NOT NULL default '0',
  filetype varchar(15) NOT NULL default '',
  data blob NOT NULL,
  PRIMARY KEY  (imageid)
)
	";

        $dbc = mysqli_query($db_connect,$query);

        $query = "
CREATE TABLE dragdrop (
 scoreid int(11) NOT NULL,
 questionid int(11) NOT NULL,
 choice1 mediumtext,
 choice2 mediumtext,
 choice3 mediumtext,
 choice4 mediumtext,
 choice5 mediumtext,
 choice6 mediumtext,
 PRIMARY KEY (scoreid,questionid)
)
	";

        $dbc = mysqli_query($db_connect,$query);


	$result = $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_list_tables($database);
	if( $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);_num_rows($result) != 12 ){
		return -1;
	}

	return 1;
}


?>

<p><br>
                </td>
            </tr>
        </table>
        </td>
    </tr>
</table>
</center>
</body>
</html>

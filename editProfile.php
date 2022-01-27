<?php
include('logged.php');
?>
<html>
<head>
	<title>Edit Profile</title>
	<link REL=StyleSheet HREF="style.css" TYPE="text/css">

	<script language="JavaScript">	
	function init()
	{
		define('startDate','string','Start Date');
		define('endDate','string','End Date');
		define('time','num','Time Limit',1);
		define('passingScore','num','Passing Score',1);
		define('questions','num','Number of Questions',1);
	}
	</script>
	<script language="javascript">
function validate()
{
 var start = new Date(document.form.startDateselect2.value,document.form.startDateselect1.value-1,document.form.startDateselect0.value);
 var end = new Date(document.form.endDateselect2.value,document.form.endDateselect1.value-1,document.form.endDateselect0.value);
 var diff = end - start;
//alert (diff);
if (diff < 0)
{
 alert ('Start Date should be previous of End Date');
 return false;
}
else 
 return true;
}

function populatedate(dateselect,max, selecteddate){
selecteddate--;
for (m=dateselect.options.length-1;m>0;m--)
	dateselect.options[m]=null;
for (i=0;i<max;i++)
	dateselect.options[i]=new Option(i+1,i+1);
if (selecteddate<max) dateselect.options[selecteddate].selected=true;
else dateselect.options[0].selected=true;
}

function evalleapyear(year){
//	alert(year);
	if ((year % 400)==0) {return true;}
	else if ((year % 100)==0) {return false;}
	else if ((year % 4)==0) {return true;}
	return false;
}

function fulleval(dselect,mselect,yselect,output)
{
	if (mselect.options[mselect.selectedIndex].value ==  1) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  2) {
		if (evalleapyear(yselect.options[yselect.selectedIndex].value)){
		populatedate(dselect,29,dselect.options[dselect.selectedIndex].value);
		}
		else populatedate(dselect,28,dselect.options[dselect.selectedIndex].value);
	}
	if (mselect.options[mselect.selectedIndex].value ==  3) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  4) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  5) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  6) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  7) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  8) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value ==  9) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value == 10) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value == 11) {populatedate(dselect,30,dselect.options[dselect.selectedIndex].value)}
	if (mselect.options[mselect.selectedIndex].value == 12) {populatedate(dselect,31,dselect.options[dselect.selectedIndex].value)}
	output.value = yselect.options[yselect.selectedIndex].value+ "-" + mselect.options[mselect.selectedIndex].value + "-" + dselect.options[dselect.selectedIndex].value;
//	alert(output.value);
}

function nulleval(dselect,mselect,yselect,output)
{
	output.value = yselect.options[yselect.selectedIndex].value + "-" + mselect.options[mselect.selectedIndex].value + "-" + dselect.options[dselect.selectedIndex].value ;
//	alert(output.value);
}

</script>


<script language="JavaScript">
<!--

function validate_form() {
  validity = true; // assume valid
 salutation1 = document.form.salutation;
 selected_one = salutation1.options[salutation1.selectedIndex].value;
 if (!selected_one)
  {
   validity = false; alert('Please select a Salutation'); 
  }
  else if (!check_empty(document.form.firstName.value))
        { validity = false; alert('The First Name is missing.'); }
   else if (!check_empty(document.form.lastName.value))
        { validity = false; alert('The Last name is missing,'); }
  
  else if (!check_email(document.form.email.value) ||
      !check_empty(document.form.email.value))
        { validity = false; alert('The Email address field has either been left empty, or else it is an invalid address. Please correct this before submitting your order.'); }

  else if (!validate())
	{ validity = false; }

  return validity;

}

function check_empty(text) {
  return (text.length > 0); // returns false if empty
}

function check_email(address) {
  if ((address == "")
    || (address.indexOf ('@') == -1)
    || (address.indexOf ('.') == -1))
      return false;
  return true;
}

// -->
  </script>


</head>

<body>

<?php
 include('config.inc');

 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

 $month = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep', 'Oct','Nov','Dec');

 if ($ID = $_GET['ID'])
   ;
 else
   $ID = $_POST['ID'];
 
 $result =  mysqli_query($db_connect,"SELECT admin FROM candidate WHERE candidateID ='$ID'");
 $row = mysqli_fetch_row($result);
   $admin = $row[0];


 if ($candidateID = $_GET['candidateID'])
 {

 $result =  mysqli_query($db_connect,"SELECT * FROM candidate WHERE candidateID ='$candidateID'");
  $row = mysqli_fetch_row($result);

 $resultp = mysqli_query($db_connect,"SELECT lnumber FROM plogins WHERE userName ='$row[1]'");
$rowp = mysqli_fetch_row($resultp);
$pnol = $rowp[0];


 $candidateID = $row[0]; 
 $firstName = $row[3];
 $lastName = $row[4];
 $email = $row[5];
 $address = $row[6];
 $city = $row[7];
 $state = $row[8];
 $postCode = $row[9];
 $country = $row[10];
 $homePhone = $row[11];
 $workPhone = $row[12];
 $mobilePhone = $row[13];
 $fax = $row[14];
 $company = $row[15];
 $title = $row[16];
 $cadmin = $row[18];
 $stDate = $row[21];
 $edDate = $row[22];
 $matchStart = explode("-",$stDate);
 $matchEnd = explode("-",$edDate);
 $salutation = $row[23];
 $certify = $row[24];
 $Inforeceipt = $row[26];
//echo $stDate;
//echo $edDate;
 if($Inforeceipt == "yes")
 {
 $offerbox = "checked" ;
 }
 else
 {
 $offerbox = "" ;
 }
 $certifications = explode(",",$certify);
 $others = "";  foreach($certifications as $value)
 {
  if($value == "MCSE" )
  {
   $mcse = "selected";
  } 
  else if($value == "MCSA" )
  {
   $mcsa = "selected";
  } 
  else if($value == "MCSD" )
  {
   $mcsd = "selected";
  } 
  else if($value == "CCNA" )
  {
   $ccna = "selected";
  } 
  else if($value == "CCDA" )
  {
   $ccda = "selected";
  } 
  else if($value == "CCNP" )
  {
   $ccnp = "selected";
  } 
  else if($value == "CIW" )
  {
   $ciw = "selected";
  } 
  else if($value == "A+" )
  {
   $aplus = "selected";
  } 
  else if($value == "Network+" )
  {
   $nplus = "selected";
  } 
  else if($value == "Server+/Linux+" )
  {
   $lplus = "selected";
  } 
  else if($value == "SCJP/SCJD" )
  {
   $scjp = "selected";
  } 
  else
  {
   if($others == "")
   {
    $others = $value;
   }
   else
   {
    $others = $others.",".$value;
   } 
  }  
  $m = $m + 1;
 }
}
if ($_POST['action'] == "edit")
{
 $candidateID = $_POST['candidateID'];
 $firstName = $_POST['firstName'];
 $lastName = $_POST['lastName'];
 $email = $_POST['email'];
 $address = $_POST['address'];
 $city = $_POST['city'];
 $state = $_POST['state'];
 $postCode = $_POST['postCode'];
 $country = $_POST['country'];
 $homePhone = $_POST['homePhone'];
 $workPhone = $_POST['workPhone'];
 $mobilePhone = $_POST['mobilePhone'];
 $fax = $_POST['fax'];
 $company = $_POST['company'];
 $title = $_POST['title'];
 $sDate = $_POST['startDate'];
 $eDate = $_POST['endDate'];
 $pnol = $_POST['pnol'];
 $offerbox = $_POST['offerbox'];

 if($offerbox)
 {
 $inforeceipt = "yes";
 }
 else
 {
 $inforeceipt = "no";
 }
 #print("$offerbox<br>$inforeceipt");
 #exit;


 $certifications = $_POST['certifications'];
 $salutation = $_POST['salutation'];
 $others = $_POST['others'];
 $certifica = "";
 $i = 0;
 if($certifications)
 {
 foreach($certifications as $value)
   {
   if($i == 0)
   { 
    $certifica = $value;
   }
   else
   {
   $certifica = $certifica.",".$value;
   }  
   $i = $i + 1;
   }
 $certifica = $certifica.",".$others;
 $certify = 1;
 }
 if(!$certify)
 { 
   if($others)
   {
   $certifica = $others;
   }  
 }
 if($admin)
 {
  $admin = $_POST['admin'];
  $result = mysqli_query($db_connect," UPDATE candidate SET admin = '$admin' WHERE candidateID = '$candidateID'");

  $cgroup[] = $_POST['cgroup'];
  $result=mysqli_query($db_connect,"DELETE FROM candidateGroup WHERE candidateID = '$candidateID'");
  if ($cgroup)
  {
	for($count=0; $count < count($cgroup)-1 ; $count++)
	{
  $gp = $cgroup[$count];
    if($gp != 0 && $gp != NULL)
        $query = mysqli_query($db_connect,"INSERT INTO candidateGroup (candidateID, groupid) VALUES ('$candidateID','$gp' )");
        }
  }

// To make a publisher
  $ggroup[] = $_POST['ggroup'];
  $result=mysqli_query($db_connect,"DELETE FROM groupPermissions WHERE candidateID = '$candidateID'");
  $result=mysqli_query($db_connect,"DELETE FROM examPermissions WHERE candidateID = '$candidateID'");
  if ($ggroup)
  {
	for($count=0; $count < count($ggroup)-1 ; $count++)
	{
  $gp = $ggroup[$count];
    if( $gp != 0 && $gp != NULL)
        $query = mysqli_query($db_connect,"INSERT INTO groupPermissions (candidateID, groupid) VALUES ('$candidateID','$gp' )");

    if( $gp != 0 && $gp != NULL)
    {
        $result = mysqli_query($db_connect," UPDATE candidate SET editGroup = 1 WHERE candidateID = '$candidateID'");
        $result = mysqli_query($db_connect," UPDATE candidate SET editExam = 1 WHERE candidateID = '$candidateID'");
    }
	}
    if($count == 0)
    {
        $result = mysqli_query($db_connect," UPDATE candidate SET editGroup = 0 WHERE candidateID = '$candidateID'");
        $result = mysqli_query($db_connect," UPDATE candidate SET editExam = 0 WHERE candidateID = '$candidateID'");
    }
        
    if( $gp != 0 && $gp != NULL)
    {
	$query = mysqli_query($db_connect,"select distinct examid from groupPermissions,exam where candidateID = '$candidateID' and exam.groupid =  groupPermissions.groupid");
	while ($row = mysqli_fetch_row($query))
	        $result = mysqli_query($db_connect,"INSERT INTO examPermissions (candidateID, examid) VALUES ('$candidateID','$row[0]' )");
    }

  }
}
$query = " UPDATE candidate SET 
               firstName = '$firstName',
               lastName = '$lastName', 
		email = '$email',
		address = '$address',
		city = '$city',
		state = '$state',
		postCode = '$postCode',
		country = '$country',
		homePhone = '$homePhone',
		workPhone = '$workPhone',
		mobilePhone = '$mobilePhone',
		fax = '$fax',
		company = '$company',
		title = '$title',
		sdate = '$sDate',
		edate = '$eDate',
            salutation = '$salutation', 
            certifications = '$certifica',
            Inforeceipt = '$inforeceipt'
	WHERE candidateID = '$candidateID'";


$result = mysqli_query($db_connect,$query);

$querynn = "SELECT userName FROM candidate WHERE candidateID = '$candidateID'";
$resultnn = mysqli_query($db_connect,$querynn);
$rown = mysqli_fetch_row($resultnn);
#print("username -- $rown[0]<br>");

$queryl = "SELECT lnumber FROM plogins WHERE userName = '$rown[0]'";
$resultl = mysqli_query($db_connect,$queryl);
$rowl = mysqli_fetch_row($resultl);

if($pnol)
{
if($rowl[0])
{
$queryy = "UPDATE plogins SET lnumber = '$pnol' WHERE userName = '$rown[0]'";
$resulty = mysqli_query($db_connect,$queryy);
}
else
{
$queryy = "INSERT INTO plogins VALUES('','$rown[0]','$pnol')";
$resulty = mysqli_query($db_connect,$queryy);
}
}
print ("<center>
<hr size=\"1\" color=\"#c0c0c0\" width=\"75%\" align=\"center\">
<font face=\"arial\" size=\"2\"><i><strong><font face=\"arial\" color=\"#999999\" size=\"4\"> Profile Updated<br> </font></strong></i></font> 
<hr size=\"1\" color=\"#c0c0c0\" width=\"75%\" align=\"center\"><BR><BR>
Your Profile has been updated sucessfully </center>\n</body>\n</html>");

exit;
}


?>

<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">Edit Candidate Profile<br> </font></strong></i></font> 

<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<form action="editProfile.php" name="form" method="post" onsubmit="return validate_form()">

<?php 
print("<font color=RED>$message</font>\n");
print <<< PROFILE
<table>
<tr>
<tr>
<td class=label  align="right"><font color="#ff0000">*</font>Salutation</td>
<td><select name="salutation">
<option selected value="$salutation">$salutation
<option value="Mr.">Mr.
<option value="Ms.">Ms.
<option value="Dr.">Dr.
<option value="Prof.">Prof.
</td>
</tr>
       <td class=label  align="right"><font color="#ff0000">*</font>First Name </td>
       <td><input name="firstName" type="text" value="$firstName"></td>
</tr>
<tr>
       <td class=label  align="right"><font color="#ff0000">*</font>Last Name </td>
       <td><input name="lastName" type="text" value="$lastName"></td>

</tr>
<tr>
       <td class=label  align="right"><font color="#ff0000">*</font>E-mail </td>
       <td><input name="email" type="text" value="$email" size='35'></td>
</tr>

<tr>
       <td class=label align="right">Address </td>
       <td><input name="address" type="text" value="$address" size="30"></td>
</tr>
<tr>
       <td class=label align="right">City </td>

       <td><input name="city" type="text" value="$city" size="30"></td>
</tr>
<tr>
       <td class=label align="right">State/Province </td>
       <td><input name="state" type="text" value="$state" size="30"></td>
</tr>
<tr>
       <td class=label align="right">Postal Code </td>
       <td><input name="postCode" type="text" value="$postCode" size="15"></td>
</tr>

<tr>
       <td class=label align="right">Country </td>
       <td><select name="country">
PROFILE;
if($country!="")
 print ("<option selected value=\"$country\">$country");
else 
 print ("<option selected value=\"\">Select a country");
print <<< PROFILE
                <option value="Albania">Albania 
                <option value="Algeria">Algeria 
                <option value="Andorra">Andorra 
                <option value="Angola">Angola 
                <option value="Anguilla">Anguilla 
                <option value="Antigua & Barbuda">Antigua & Barbuda 
                <option value="Argentina">Argentina 
                <option value="Armenia">Armenia 
                <option value="Aruba">Aruba 
                <option value="Australia">Australia 
                <option value="Austria">Austria 
                <option value="Azerbaijan">Azerbaijan 
                <option value="Azores">Azores 
                <option value="Bahamas">Bahamas 
                <option value="Bahrain">Bahrain 
                <option value="Bangladesh">Bangladesh 
                <option value="Barbados">Barbados 
                <option value="Barbuda">Barbuda 
                <option value="Belarus">Belarus 
                <option value="Belgium">Belgium 
                <option value="Belize">Belize 
                <option value="Benin">Benin 
                <option value="Bermuda">Bermuda 
                <option value="Bhutan">Bhutan 
                <option value="Bolivia">Bolivia 
                <option value="Bosnia-Herzegovina">Bosnia-Herzegovina 
                <option value="Botswana">Botswana 
                <option value="Brazil">Brazil 
                <option value="British Virgin Islands">British Virgin Islands 
                <option value="Brunei Darussalam">Brunei Darussalam 
                <option value="Bulgaria">Bulgaria 
                <option value="Burkina Faso">Burkina Faso 
                <option value="Burma">Burma 
                <option value="Burundi">Burundi 
                <option value="Cameroon">Cameroon 
                <option value="Canada">Canada 
                <option value="Cape Verde">Cape Verde 
                <option value="Cayman Islands">Cayman Islands 
                <option value="Central African Republic">Central African Republic 
                <option value="Chad">Chad 
                <option value="Chile">Chile 
                <option value="China">China 
                <option value="Colombia">Colombia 
                <option value="Comoros">Comoros 
                <option value="Congo">Congo 
                <option value="Corsica">Corsica 
                <option value="Costa Rica">Costa Rica 
                <option value="Cote D'Ivoire">Cote D Ivoire 
                <option value="Croatia">Croatia 
                <option value="Cyprus">Cyprus 
                <option value="Czech Republic">Czech Republic 
                <option value="Denmark">Denmark 
                <option value="Djibouti">Djibouti 
                <option value="Dominica">Dominica 
                <option value="Dominican Republic">Dominican Republic 
                <option value="Ecuador">Ecuador 
                <option value="Egypt">Egypt 
                <option value="El Salvador">El Salvador 
                <option value="Equatorial Guinea">Equatorial Guinea 
                <option value="Eritrea">Eritrea 
                <option value="Estonia">Estonia 
                <option value="Ethiopia">Ethiopia 
                <option value="Faroe Islands">Faroe Islands 
                <option value="Fiji">Fiji 
                <option value="Finland">Finland 
                <option value="France">France 
                <option value="French Guiana">French Guiana 
                <option value="French Polynesia">French Polynesia 
                <option value="Gabon">Gabon 
                <option value="Gambia">Gambia 
                <option value="Georgia, Republic of">Georgia, Republic of 
                <option value="Germany">Germany 
                <option value="Ghana">Ghana 
                <option value="Gibraltar">Gibraltar 
                <option value="Greece">Greece 
                <option value="Greenland">Greenland 
                <option value="Grenada">Grenada 
                <option value="Guadeloupe">Guadeloupe 
                <option value="Guatemala">Guatemala 
                <option value="Guinea">Guinea 
                <option value="Guinea-Bissau">Guinea-Bissau 
                <option value="Guyana">Guyana 
                <option value="Haiti">Haiti 
                <option value="Honduras">Honduras 
                <option value="Hong Kong">Hong Kong 
                <option value="Hungary">Hungary 
                <option value="Iceland">Iceland 
                <option value="India">India 
                <option value="Indonesia">Indonesia 
                <option value="Iran">Iran 
                <option value="Ireland">Ireland 
                <option value="Israel">Israel 
                <option value="Italy">Italy 
                <option value="Jamaica">Jamaica 
                <option value="Japan">Japan 
                <option value="Jordan">Jordan 
                <option value="Kazakhstan">Kazakhstan 
                <option value="Kenya">Kenya 
                <option value="Kiribati">Kiribati 
                <option value="Korea, Republic of">Korea, Republic of 
                <option value="Kuwait">Kuwait 
                <option value="Kyrgystan">Kyrgystan 
                <option value="Laos">Laos 
                <option value="Latvia">Latvia 
                <option value="Lebanon">Lebanon 
                <option value="Lesotho">Lesotho 
                <option value="Libya">Libya 
                <option value="Liechtenstein">Liechtenstein 
                <option value="Lithuania">Lithuania 
                <option value="Luxembourg">Luxembourg 
                <option value="Macao">Macao 
                <option value="Macedonia">Macedonia 
                <option value="Madagascar">Madagascar 
                <option value="Madeira Islands">Madeira Islands 
                <option value="Malawi">Malawi 
                <option value="Malaysia">Malaysia 
                <option value="Maldives">Maldives 
                <option value="Mali">Mali 
                <option value="Malta">Malta 
                <option value="Martinique">Martinique 
                <option value="Mauritania">Mauritania 
                <option value="Mauritius">Mauritius 
                <option value="Mexico">Mexico 
                <option value="Moldova">Moldova 
                <option value="Monaco">Monaco 
                <option value="Montserrat">Montserrat 
                <option value="Morocco">Morocco 
                <option value="Mozambique">Mozambique 
                <option value="Namibia">Namibia 
                <option value="Nauru">Nauru 
                <option value="Nepal">Nepal 
                <option value="Netherlands">Netherlands 
                <option value="Netherlands Antilles">Netherlands Antilles 
                <option value="Nevis">Nevis 
                <option value="New Caledonia">New Caledonia 
                <option value="New Zealand">New Zealand 
                <option value="Nicaragua">Nicaragua 
                <option value="Niger">Niger 
                <option value="Nigeria">Nigeria 
                <option value="Norway">Norway 
                <option value="Oman">Oman 
                <option value="Pakistan">Pakistan 
                <option value="Panama">Panama 
                <option value="Papua New Guinea">Papua New Guinea 
                <option value="Paraguay">Paraguay 
                <option value="Peru">Peru 
                <option value="Philippines">Philippines 
                <option value="Pitcairn Islands">Pitcairn Islands 
                <option value="Poland">Poland 
                <option value="Portugal">Portugal 
                <option value="Qatar">Qatar 
                <option value="Reunion">Reunion 
                <option value="Romania">Romania 
                <option value="Russia">Russia 
                <option value="Rwanda">Rwanda 
                <option value="Saint Christopher">Saint Christopher 
                <option value="San Marino">San Marino 
                <option value="Saudi Arabia">Saudi Arabia 
                <option value="Senegal">Senegal 
                <option value="Seychelles">Seychelles 
                <option value="Sierra Leone">Sierra Leone 
                <option value="Singapore">Singapore 
                <option value="Slovak Republic">Slovak Republic 
                <option value="Slovenia">Slovenia 
                <option value="Solomon Islands">Solomon Islands 
                <option value="Somalia">Somalia 
                <option value="South Africa">South Africa 
                <option value="South Korea">South Korea 
                <option value="Spain">Spain 
                <option value="Sri Lanka">Sri Lanka 
                <option value="St Christopher & Nevis">St Christopher & Nevis 
                <option value="St Helena">St Helena 
                <option value="St Kitts">St Kitts 
                <option value="St Lucia">St Lucia 
                <option value="St Pierre & Miquelon">St Pierre & Miquelon 
                <option value="St Vincent & Grenadines">St Vincent & Grenadines 
                <option value="Sudan">Sudan 
                <option value="Suriname">Suriname 
                <option value="Swaziland">Swaziland 
                <option value="Sweden">Sweden 
                <option value="Switzerland">Switzerland 
                <option value="Syrian Arab Republic">Syrian Arab Republic 
                <option value="Taiwan">Taiwan 
                <option value="Tajikistan">Tajikistan 
                <option value="Tanzania">Tanzania 
                <option value="Thailand">Thailand 
                <option value="Togo">Togo 
                <option value="Tonga">Tonga 
                <option value="Trinidad & Tobago">Trinidad & Tobago 
                <option value="Tristan De Cunha">Tristan De Cunha 
                <option value="Tunisia">Tunisia 
                <option value="Turkey">Turkey 
                <option value="Turkmenistan">Turkmenistan 
                <option value="Turks and Caicos Is">Turks and Caicos Is 
                <option value="Tuvalu">Tuvalu 
                <option value="Uganda">Uganda 
                <option value="Ukraine">Ukraine 
                <option value="United Arab Emirates">United Arab Emirates 
                <option value="United Kingdom">United Kingdom 
                <option value="Uruguay">Uruguay 
                <option value="USA">USA 
                <option value="Uzbekistan">Uzbekistan 
                <option value="Vanuatu">Vanuatu 
                <option value="Vatican city">Vatican city 
                <option value="Venezuela">Venezuela 
                <option value="Vietnam">Vietnam 
                <option value="Wallis & Futuna Islands">Wallis & Futuna Islands 
                <option value="Western Samoa">Western Samoa 
                <option value="Yemen, Republic of">Yemen, Republic of 
                <option value="Zaire">Zaire 
                <option value="Zambia">Zambia 
                <option value="Zimbabwe">Zimbabwe 
              </select>

       </td>
</tr>
<tr>
       <td class=label align="right">Home Phone </td>
       <td><input name="homePhone" type="text" value="$homePhone" size="20"></td>
</tr>
<tr>
       <td class=label align="right">Work Phone </td>

       <td><input name="workPhone" type="text" value="$workPhone" size="20"></td>
</tr>
<tr>
       <td class=label align="right">Mobile Phone </td>
       <td><input name="mobilePhone" type="text" value="$mobilePhone" size="20"></td>
</tr>
<tr>
       <td class=label align="right">Fax </td>
       <td><input name="fax" type="text" value="$fax" size="20"></td>
</tr>

<tr>
       <td class=label align="right">Company </td>
       <td><input name="company" type="text" value="$company" size="30"></td>
</tr>
<tr>
       <td class=label align="right">Title </td>
       <td><input name="title" type="text" value="$title" size="30"></td>
</tr>
<tr>
<td class=label  align="right">Certification you are preparing for<br>(Hold ctrl key to select multiple certifications)</td>
<td><select name="certifications[]" multiple>
<option>
<option $mcse>MCSE
<option $mcsa>MCSA
<option $mcsd>MCSD
<option $ccna>CCNA
<option $ccda>CCDA
<option $ccnp>CCNP
<option $ciw>CIW
<option $aplus>A+
<option $nplus>Network+
<option $lplus>Server+/Linux+
<option $scjp>SCJP/SCJD
</select>
</td>
</tr>

<tr>
<td class=label align="right">Others</td>
<td><input name="others" type="text" value="$others" size="30">(Please  Specify)</td>
</tr>
PROFILE;

################################

if($admin)
{
$comben = "enabled=\"true\"";
}
else
{
$comben = "disabled=\"true\"";
}
print <<< EDIT
<tr>
       <td align='right' class=label>Start Date: </td>
       <td>
<input type='hidden' name='startDate' value="$stDate">
<select name='startDateselect0' onchange='nulleval(startDateselect0,startDateselect1,startDateselect2,startDate)' $comben>
EDIT;
for ($i = 1 ; $i <= 31 ; $i++)
{
  $select = "";
 if ($i == $matchStart[2])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='startDateselect1' onchange='fulleval(startDateselect0,startDateselect1,startDateselect2,startDate)' $comben>
EDIT;
for ($i = 1 ; $i <= 12 ; $i++)
{
  $select = "";
 if ($i == $matchStart[1])
   $select = 'selected';
  $j = $i - 1;
  print ("<option $select value=$i>$month[$j]</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='startDateselect2' onchange='fulleval(startDateselect0,startDateselect1,startDateselect2,startDate)' $comben>
EDIT;
for ($i = 2000 ; $i <= 3050 ; $i++)
{
  $select = "";
 if ($i == $matchStart[0])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
</td>
</tr>

<tr>
       <td align='right' class=label>End Date: </td>
       <td><input type='hidden' name='endDate' value="$edDate">
<select name='endDateselect0' onchange='nulleval(endDateselect0,endDateselect1,endDateselect2,endDate)' $comben>
EDIT;
for ($i = 1 ; $i <= 31 ; $i++)
{
  $select = "";
 if ($i == $matchEnd[2])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='endDateselect1' onchange='fulleval(endDateselect0,endDateselect1,endDateselect2,endDate)' $comben>
EDIT;
for ($i = 1 ; $i <= 12 ; $i++)
{
  $select = "";
 if ($i == $matchEnd[1])
   $select = 'selected';
  $j = $i - 1;
  print ("<option $select value=$i>$month[$j]</option>\n");
}
print ("</select>\n");
print <<< EDIT
<select name='endDateselect2' onchange='fulleval(endDateselect0,endDateselect1,endDateselect2,endDate)' $comben>
EDIT;
for ($i = 2000 ; $i <= 3050 ; $i++)
{
  $select = "";
 if ($i == $matchEnd[0])
   $select = 'selected';
  print ("<option $select value=$i>$i</option>\n");
}
print ("</select>\n");
print <<< EDIT
</td>
</tr>
<tr><td colspan=2> <br> </td></tr>
EDIT;
############################################################


 if ($admin == 1)
 {
print("\n<TR><TD colspan=2><HR></TD></TR>\n");

if ($cadmin == 1)
  $ach = "checked";

print("\n<tr>\n<td class=label align=\"right\">Permitted number of logins</td>\n<td><input name=\"pnol\" size=\"5\" type=\"text\" value=\"$pnol\"></td>\n</tr>\n");

print("\n<tr>\n<td class=label align=\"right\">Admin</td>\n<td><input name=\"admin\" type=\"checkbox\" value=\"1\" $ach>(Check box for admin privileges)</td>\n</tr>\n");

print("\n<TR><TD colspan=2><BR>Groups this user belongs to:</TD></TR>\n");
  $result =  mysqli_query($db_connect,"SELECT * FROM groups");
  while ($row = mysqli_fetch_row($result))
  {
   $check = "";
   $res=mysqli_query($db_connect,"SELECT * FROM candidateGroup where candidateID= '$candidateID' and groupid = '$row[0]'");
   if($grow = mysqli_fetch_row($res))
     $check = "checked";

   print("\n<tr>\n<td class=label align=\"right\"></td>\n<td><input name=\"cgroup[]\" type=\"checkbox\" value=\"$row[0]\" $check>$row[1]</td>\n</tr>\n");
  }

print("\n<TR><TD colspan=2><BR>Select the groups which this user will have permission to add, edit and delete Exams from:</TD></TR>\n");
  $result =  mysqli_query($db_connect,"SELECT * FROM groups");
  while ($row = mysqli_fetch_row($result))
  {
   $check = "";
   $res=mysqli_query($db_connect,"SELECT * FROM groupPermissions where candidateID= '$candidateID' and groupid = '$row[0]'");
   if($grow = mysqli_fetch_row($res))
     $check = "checked";

   print("\n<tr>\n<td class=label align=\"right\"></td>\n<td><input name=\"ggroup[]\" type=\"checkbox\" value=\"$row[0]\" $check>$row[1]</td>\n</tr>\n");
  }

print("\n<TR><TD colspan=2><HR></TD></TR>\n");
 }

?>

</table><br><br>
<input name="action" type="hidden" value="edit">
<input name="candidateID" type="hidden" value=<?php print("$candidateID") ?>>
<input name="ID" type="hidden" value=<?php print("$ID") ?>>
<input type="reset" name="reset" value="Reset">
<input type="submit" name="submit" value="Save Changes">
<font color="#ff0000">(*required field)</font><br>
<table>
<tr>
<td class=label align="right"><font size="1">Please check the box to receive special offers and other useful information to your email address:</font></td>
<td><input name="offerbox" type="checkbox" <?php echo $offerbox ?>></td>
</tr>
</table>
</form>
</center>
</body>
</html>

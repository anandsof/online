<html>
<head>
	<title>Registration</title>
	<link REL=StyleSheet HREF="style.css" TYPE="text/css">
<script language="JavaScript">
<!--

function validate_form() {
  validity = true; // assume valid

  if (!check_empty(document.form.firstName.value))
        { validity = false; alert('The First Name is missing.'); }

  else if (!check_empty(document.form.lastName.value))
        { validity = false; alert('The Last name is missing,'); }

  else if (!check_empty(document.form.userName.value))
        { validity = false; alert('The User Name field has been left empty. Please correct this before submitting your order.'); }

  else if (!check_empty(document.form.pw.value))
        { validity = false; alert('The Password field has been left empty. Please correct this before submitting your order.'); }

  else if (!check_empty(document.form.vpw.value))
        { validity = false; alert('The Password field has been left empty. Please correct this before submitting your order.'); }

  else if (document.form.pw.value != document.form.vpw.value )
       { validity = false; alert('Both the Passwords should be same'); }
  
  else if (!check_email(document.form.email.value) ||
      !check_empty(document.form.email.value))
        { validity = false; alert('The Email address field has either been left empty, or else it is an invalid address. Please correct this before submitting your order.'); }

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

// TO see weather the user a admin

 if ($ID = $_GET['ID'])
   ;
 else
   $ID = $_POST['ID'];

	 $result =  mysqli_query($db_connect,"SELECT admin FROM candidate WHERE candidateID ='$ID'");
	 $row = mysqli_fetch_row($result);
   $admin = $row[0];

 $userName = "";
 $Pass1 = "";
 $Pass2 = "";
 $firstName = "";
 $lastName = "";
 $email = "";
 $address = "";
 $city = "";
 $state = "";
 $postCode = "";
 $country = "";
 $homePhone = "";
 $workPhone = "";
 $mobilePhone = "";
 $fax = "";
 $company = "";
 $title = "";

 if ($_POST['action'] == "new")
 {
 $userName = $_POST['userName'];
 $Pass1 = $_POST['pw'];
 $Pass2 = $_POST['vpw'];
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

  $result =  mysqli_query($db_connect,"SELECT userName FROM candidate");

  while ($row = mysqli_fetch_row($result))
  {
  if (($userName == $row[0]) || ($Pass1 != $Pass2) || (!$userName) || (!$Pass1) || (!$Pass2)) 
      {
        $flag = 1;
      }
 }

 if($flag == 1)
 {
     if ($Pass1 != $Pass2)
     {
      $message = "<br>The two passwords do not match!";
      $message .= "<br>Please try again...<br>\n";
     }
     else if (!$userName)
     {
      $message = "<br>Please complete all the text boxes<br>";
     }
     else 
     {
     $message = "<br>The User Name already exists, please try another<br>\n";
     }
 }
    
else
{

  $result =  mysqli_query($db_connect,"SELECT CURDATE()");
  $row = mysqli_fetch_row($result);
  $date = $row[0];

 $userPassword = $Pass1;

  $query = "insert into candidate (candidateID,userName,userPassword,firstName,lastName,email,address,city,state,postCode,country,homePhone, workPhone,mobilePhone,fax,company,title,date) VALUES (NULL, '$userName',  
'$userPassword', '$firstName', '$lastName' ,'$email' ,'$address' ,'$city' ,'$state', '$postCode' ,'$country','$homePhone','$workPhone','$mobilePhone' ,'$fax',
'$company','$title','$date')";

  $result = mysqli_query($db_connect,$query);

     $query = mysqli_query($db_connect,"SELECT LAST_INSERT_ID()");
     $row = mysqli_fetch_row($query);
     $candidateID = $row[0]; 

// Here for the Publisher or admin or Normal User or Power user

 if($admin)
 {
  $admin = $_POST['admin'];
  $result = mysqli_query($db_connect," UPDATE candidate SET admin = '$admin' WHERE candidateID = '$candidateID'");

  $cgroup[] = $_POST['cgroup'];
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
    else
    {
        $result = mysqli_query($db_connect," UPDATE candidate SET editGroup = 0 WHERE candidateID = '$candidateID'");
        $result = mysqli_query($db_connect," UPDATE candidate SET editExam = 0 WHERE candidateID = '$candidateID'");
    }
        }

    if( $gp != 0 && $gp != NULL)
    {
	$query = mysqli_query($db_connect,"select distinct examid from groupPermissions,exam where candidateID = '$candidateID' and exam.groupid =  groupPermissions.groupid");
	while ($row = mysqli_fetch_row($query))
	        $result = mysqli_query($db_connect,"INSERT INTO examPermissions (candidateID, examid) VALUES ('$candidateID','$row[0]' )");
    }

  }

print ("<center>
<hr size=\"1\" color=\"#c0c0c0\" width=\"75%\" align=\"center\">
<font face=\"arial\" size=\"2\"><i><strong><font face=\"arial\" color=\"#999999\" size=\"4\"> Profile Added<br> </font></strong></i></font> 
<hr size=\"1\" color=\"#c0c0c0\" width=\"75%\" align=\"center\"><BR><BR>
Your Profile has been Added sucessfully </center>\n</body>\n</html>");

exit;

}

 }
}

?>


<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">New Candidate Registration<br> </font></strong></i></font> 

<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<form action="addUser.php" name="form" method="post" onsubmit="return validate_form()">

<?php 
print("<font color=RED>$message</font>\n");
print <<< PROFILE
<table>
<tr>
       <td class=label  align="right"><font color="#ff0000">*</font>First Name </td>
       <td><input name="firstName" type="text" value="$firstName"></td>
</tr>
<tr>
       <td class=label  align="right"><font color="#ff0000">*</font>Last Name </td>
       <td><input name="lastName" type="text" value="$lastName"></td>

</tr>
<tr>
     <td class=label  align="right"><font color="#ff0000">*</font>User Name </td>
       <td><input name="userName" type="text" value="$userName"><small> 4-15 characters</small></td>
</tr>
<tr>
       <td class=label  align="right"><font color="#ff0000">*</font>Password </td>
       <td><input name="pw" type="password" value="$Pass1"><small> 4-15 characters</small></td>

</tr>
<tr>
       <td class=label  align="right"><font color="#ff0000">*</font>Verify Password </td>
       <td><input name="vpw" type="password" value="$Pass2"></td>
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
       <td>
	  <select name="country">
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
                <option value="Cote D'Ivoire">Cote D'Ivoire 
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

PROFILE;
 if ($admin == 1)
 {
print("\n<TR><TD colspan=2><HR></TD></TR>\n");

if ($cadmin == 1)
  $ach = "checked";

print("\n<tr>\n<td class=label align=\"right\">Admin</td>\n<td><input name=\"admin\" type=\"checkbox\" value=\"1\" $ach>(Check box for admin privileges)</td>\n</tr>\n");

print("\n<TR><TD colspan=2><BR>Groups this user belongs to:</TD></TR>\n");
  $result =  mysqli_query($db_connect,"SELECT * FROM groups");
  while ($row = mysqli_fetch_row($result))
  {
   $check = "";
	
   print("\n<tr>\n<td class=label align=\"right\"></td>\n<td><input name=\"cgroup[]\" type=\"checkbox\" value=\"$row[0]\" $check>$row[1]</td>\n</tr>\n");
  }

print("\n<TR><TD colspan=2><BR>Select the groups which this user will have permission to add, edit and delete Exams from:</TD></TR>\n");
  $result =  mysqli_query($db_connect,"SELECT * FROM groups");
  while ($row = mysqli_fetch_row($result))
  {
   $check = "";

   print("\n<tr>\n<td class=label align=\"right\"></td>\n<td><input name=\"ggroup[]\" type=\"checkbox\" value=\"$row[0]\" $check>$row[1]</td>\n</tr>\n");
  }

print("\n<TR><TD colspan=2><HR></TD></TR>\n");
 }

mysqli_close($db_connect);
?>

</table><br><br>
<input name="action" type="hidden" value="new">
<input name="ID" type="hidden" value=<?php print("$ID") ?>>
<input type="reset" name="reset" value="Reset">
<input type="submit" name="submit" value="Submit">
</form>
<font color="#ff0000">(*required field)</font><br>


</center>
</body>
</html>

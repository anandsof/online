<html>
<head>
	<title>Registration</title>
	<link REL=StyleSheet HREF="style.css" TYPE="text/css">
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
 $salutation = "";
 $others = "";
 $certifications = "";
 $offerbox = "";
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
 $certifications = $_POST['certifications'];
 $salutation = $_POST['salutation'];
 $others = $_POST['others'];
 $offerbox = $_POST['offerbox'];
 #print("$offerbox<br>");
 #exit;
 if($offerbox)
 {
 $offerbox = "yes";
 }
 else
 {
 $offerbox = "no";
 }
 $certifica = "";
 $i = 0;
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

  $e_date = explode("-",$date);
  $e_date[0] = $e_date[0] + 1;
  $edate = "$e_date[0]-$e_date[1]-$e_date[2]";
 $query = "insert into candidate (candidateID,userName,userPassword,firstName,lastName,email,address,city,state,postCode,country,homePhone, workPhone,mobilePhone,fax,company,title,date,sdate,edate,salutation,certifications,Inforeceipt) VALUES (NULL, '$userName',  
'$userPassword', '$firstName', '$lastName' ,'$email' ,'$address' ,'$city' ,'$state', '$postCode' ,'$country','$homePhone','$workPhone','$mobilePhone' ,'$fax',
'$company','$title','$date','$date','$edate','$salutation','$certifica','$offerbox')";

  $result = mysqli_query($db_connect,$query);

     $query = mysqli_query($db_connect,"SELECT LAST_INSERT_ID()");
     $row = mysqli_fetch_row($query);
     $ID = $row[0]; 

    $query = mysqli_query($db_connect,"SELECT * FROM groups where groupName = 'visitor'");
     if ($row = mysqli_fetch_row($query))
        $groupid = $row[0]; 
     else
        $groupid = 1; 

  $query = mysqli_query($db_connect,"INSERT INTO candidateGroup (candidateID, groupid) VALUES ('$ID','$groupid' )");

 #naresh code here
$extra_header  = "MIME-Version: 1.0\r\n";
$extra_header .= "Content-type: text/html; charset=iso-8859-1\r\n";
$extra_header .= "From:support@certexams.com\r\nReply-to:support@certexams.com\r\nBounce-to:support@certexams.com\r\n";
$subject = "CertExams - User Registration";
$mailto = $email;
$mbody = "<font color=\"#203C70\" size=\"2\">Dear </font><font color=\"RED\" size=\"2\"><b>$firstName $lastName,</b></font><br><br><font color=\"#203C70\" size=\"2\">Your Login details are as here under:<br><br>LoginName:<font color=\"RED\" size=\"2\"><b>$userName</b></font><br>Password:<font color=\"RED\" size=\"2\"><b>$userPassword</b></font><br><br>Please activate your account by clicking on the link provided below.<br><a href=\"https://online.certexams.com/logactivate.php?id=$ID\" onClick=\"window.open('https://online.certexams.com/logactivate.php?id=$ID','RIC','width=566,height=240 resizable=yes scrollbars=no'); return false;\">https://online.certexams.com/logactivate.php?id=$ID</a><br>if the hyperlink is not shown here please copy the url, paste it in the browser location bar and press enter.<br><br><br>Regards,<br>Support team - CertExams.com</font>";  
#print("$mbody<br>");
$mailsend = mail($mailto, $subject, $mbody ,$extra_header);
#print("$extra_header<br>$subject<br>$mailto<br>$mbody<br>$mailsend<br>");

print<<<AAA
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4"><center>Thanks For Registration</center><br> </font></strong></i></font>  
<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br> 
<center><font face="arial" color="#203C70" size="2">Dear </font>
AAA;
print("<font face=\"arial\" color=\"RED\" size=\"2\"><b>$firstName $lastName,</b></font>");
print<<<GGG
<br><font face="arial" color="#203C70" size="2">
Your </font><font face="arial" color="RED" size="2"><b>Login details </b></font><font face="arial" color="#203C70" size="2">have been sent to <b>
GGG;
print("<font face=\"arial\" color=\"RED\" size=\"2\"><b>$email</b></font>");
print<<<LLL
</b>.<br><font face="arial" color="#203C70" size="2">Please activate your account by logging in to your mailbox.</font>
</center>
LLL;
            
exit;
 $message =" <script language=\"JavaScript\">
    <!--
       location.href=\"admin_index.php?ID=$ID\";
     // -->
  </script>";
 }
}

?>


<center>
<font face="arial" size="2"><i><strong><font face="arial" color="#999999" size="4">New Candidate Registration<br> </font></strong></i></font> 

<hr size="1" color="#c0c0c0" width="75%" align="center">
<hr size="1" width="60%" noshade>
<br>
<form action="profile.php" name="form" method="post" onsubmit="return validate_form()">

<?php 
print("<font color=RED>$message</font>\n");
print <<< PROFILE
<table>
<tr>
<td class=label  align="right"><font color="#ff0000">*</font>Salutation</td>
<td><select name="salutation">
<option selected value="$salutation">$salutation
<option value="Mr.">Mr.
<option value="Ms.">Ms.
<option value="Dr.">Dr.
<option value="Prof.">Prof.
</select>
</td>
</tr>
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
       <td class=label  valign="top" align="right"><font color="#ff0000">*</font>E-mail </td>
       <td><p align="justify"><input name="email" type="text" value="" size='35'><font size="1"><font color="RED"><br>
       Attention: </font>Please ensure the email address you have entered is<br>
       correct,  as you need to activate your account.To activate
your<br> account, please log-in to your email-address and click on the&nbsp;<br>
       hyperlink provided. You will not be able to
       login if you&nbsp;enter&nbsp;<br>
 an invalid email address.</font></p></td>
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
<td class=label  align="right">Certifications you are preparing for<br>(Hold ctrl key to select multiple certifications)</td>
<td><select name="certifications[]" multiple>
<option selected>$certifications
<option>A+ Core 1
<option>A+ Core 2
<option>Network+
<option>Security+
<option>Server+
<option>CCNA
<option>JNCIA-Junos
<option>PMP
</select>
</td>
</tr>
<tr>
<td class=label align="right">Others</td>
<td><input name="others" type="text" value="$others" size="30">(Please  Specify)</td>
</tr>

</table><br><br>
PROFILE;
mysqli_close($db_connect);
?>

<input name="action" type="hidden" value="new">
<input type="submit" name="submit" value="Submit">
<font color="#ff0000">(*required field)</font><br>
<table>
<tr>
<td class=label align="right"><font size="1">Please check the box to receive special offers and other useful information to your email address:</font></td>
<td><input name="offerbox" type="checkbox" checked></td>
</tr>
</table>
</form>
</center>
</body>
</html>

<?php
 include('cookie.php');
?>
<html>
<head>
<title>brains@work.com</title>
<script language="JavaScript">
<!--
function validate_Search_form() {
  validity = true;
  var count = 0;
  if ((navigator.appName =="Netscape")) {
    if (document.Search.exam.selectedIndex == 0) { count++;}
    if (document.Search.country.selectedIndex == 0) { count++;}
  }
  for( var k = 0; k < document.Search.elements.length; k++) {
     if (document.Search.elements[k].value == "") { count++; }
  }
  if (count > 18) { 
    validity = false; alert('All search fields are empty!');
  }
  return validity;
}
// -->
</script>
<link REL=StyleSheet HREF="style.css" TYPE="text/css">
</head>
<body bgcolor="#FFFFFF">
<center>
<H3>Search For Exam Results</H3>
<HR>
</center>
<form name="Search"  onSubmit="return validate_Search_form()"          method=POST ACTION="search.php">

<?php

 include('config.inc');
 $db_connect = mysqli_connect($datahost, $datauser, $datapasswd, $base);

  $ID = $_GET['ID'];
  print ("\n<input type=\"hidden\" name=\"ID\" value=\"$ID\">\n");
?>

  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr align="center"> 
    <td> 
        <table width=100%>
          <tr> 
            <td class=label align=right>Exam Title</td>
            <td nowrap> 
              <select name="exam">
                <option selected value="All">Show All
<?php 
  $result =  mysqli_query($db_connect,"SELECT examid,title FROM exam ORDER BY examid");
  while($row = mysqli_fetch_row($result))
   print ("<option value=$row[0]>$row[1]\n");
?>
              </select>
	  </tr>
          <tr> 
            <td class=label align=right>Date</td>
            <td nowrap> 
              <input type=text name="date" size=10 maxlength=10>(YYYY-MM-DD Format eg. 2004-12-01)
	    </td>
        </tr>
        <tr> 
            <td class=label align=right>User Name </td>
            <td> 
              <input type=text name="userName" size=10>
              <input type="submit" value="search" name="submit">
            </td>
          </tr>
          <tr> 
            <td colspan=3> 
              <hr>
            </td>
          </tr>
          <tr> 
            <td colspan=2>
<table>
<tr>
       <td class=label  align="right">First Name </td>
       <td><input name="firstName" type="text" value=""></td>

</tr>
<tr>
       <td class=label  align="right">Last Name </td>
       <td><input name="lastName" type="text" value=""></td>

</tr>
<tr>
       <td class=label  align="right">E-mail </td>
       <td><input name="email" type="text" value="" size='35'></td>

</tr>

<tr>
       <td class=label align="right">Address </td>
       <td><input name="address" type="text" value="" size="30"></td>
</tr>
<tr>
       <td class=label align="right">City </td>

       <td><input name="city" type="text" value="" size="30"></td>
</tr>

<tr>
       <td class=label align="right">State/Province </td>
       <td><input name="state" type="text" value="" size="30"></td>
</tr>
<tr>
       <td class=label align="right">Postal Code </td>
       <td><input name="postCode" type="text" value="" size="15"></td>
</tr>

<tr>
       <td class=label align="right">Country </td>

       <td><select name="country">
    <option selected value="">Select a country                
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
       <td><input name="homePhone" type="text" value="" size="20"></td>
</tr>
<tr>
       <td class=label align="right">Work Phone </td>

       <td><input name="workPhone" type="text" value="" size="20"></td>

</tr>
<tr>
       <td class=label align="right">Mobile Phone </td>
       <td><input name="mobilePhone" type="text" value="" size="20"></td>
</tr>
<tr>
       <td class=label align="right">Fax </td>
       <td><input name="fax" type="text" value="" size="20"></td>
</tr>

<tr>

       <td class=label align="right">Company </td>
       <td><input name="company" type="text" value="" size="30"></td>
</tr>
<tr>
       <td class=label align="right">Title </td>
       <td><input name="title" type="text" value="" size="30"></td>
</tr>
</table>
            </td>
          </tr>
        </table>
    </td>
  </tr>
</table>
</form>
<hr>
</body>
</html>

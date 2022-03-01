<!-- Project Title -->
# Web Based Online Exams

The intention is to make online exam available using PHP/MySQL Apache web server. The scripts are commented as necessary, but feel free to update the same. One can install the scripts, and configure the same appropriately, after which, it is possible to create, populate, and deliver the exams over the Internet. The user just needs to login to take the exam(s)

# Table of contents


# Features
<!-- This is where you write what all extra features have been done in your project. Basically this is where you try to make your project stand out from the rest. -->

- Simple interface which is intuitive to the user
- Very widely used LAMP environment, where one need not buy any software for making changes or improving the features.
- Learn and exam modes so that users can change between these modes depending on the need
- Scope for improvement
- there is scope for improving the statistics reporting.

# Requirements

The server is preferably a web server accessible over the Internet in LAMP (Linux, Apache, MySQL, and PHP) environment. Before going ahead make sure that PHP script on the web server is working properly, and MySQL is installed and accessible using PHP. 

### Web Server requirements:
- LAMP server environment (Linux, Apache,
- PHP 7.4 or greater
- MySQL 5.6 or MariaDB 10.1 or greater
- Accessibility over the public Internet or Intranet (for use within org network)

### Client Side Requirements

Local system (Client computer) requirements: Any Windows 7, 8, 10 or 11 computer may be used to access the web server remotely and install downloaded CBT server side scripts. You need an FTP software such as FileZilla to upload the files to the web server from your client computer. You also need to have login and password handy to login to the web server using FTP. Web server control panel such as C-panel/PHPMyAdmin will be useful in configuring the web server database, but not essential. 

# Installation
The installation is manual. Follow the steps given below to install project on your server.<br>

**Step 1 : Creating MySQL database**

Online Exam project uses MySQL database to save exam information. Login into your phpMyAdmin using login credential provided by your server host and then create a new database with name say "Online". <br>

**Setp 2: Create MySQL user**

Next you need to create a MySQL user and give all privileges to the user for accessing and modifying database.<br>

**Step 3 : Assign user to database**

Next step is to assign the created user to created database and give full permissions to the user.

**Step 4 : Get the code**

The code can be downloaded as a zip file from the repository. Unzip the downloaded file to make few required changes described below.

**Step 5 : Create tables in database**

In the unziped folder of the downloaded code you will find a file "sql-statements-online.sql". To create the tables you can import the sql file directly in to your database using phpMyAdmin cpanel it will create all of the necessary tables, or you can open the file in any editor and copy individual create table statements into cpanel.

**Step 6 : Update configuration file**

In the unziped folder of the downloaded code you will find a file config.inc. Open the file in any text editor and add the database name, database user, and password that were generated earlier. Sample values are given below: <br>

***********
$datahost = "localhost"; <br>
$datauser = "database_user"; <br>
$datapasswd = "database_pwd";<br>
$base = "database_name";<br>
***********<br>

**Step 7 : Upload files to server**

Next step is to upload the files to the server. You can use FTP Client (like filezilla) to upload "Online" folder to your server. Before, upload, create a folder by name say "OnlineExams" in the home folder (Usually, public_html or html), and change the destination folder to "public_html/OnlineExams".

**Step 8 : Open the url in browser**

Next open the index page in any browser. URL for the index page will be "https://yourdomain.com/upload-folder-name/index.htm"



## Screenshots

**Given below is the login screen (the login is same for user as well as the exam admin. However, admins will have more privileges like creating authors.**<br>
<img width="608" alt="login" src="https://user-images.githubusercontent.com/33366524/151390671-052bdd53-92aa-4414-8f6e-1548f7fe516d.png"><br>
**Given below is the User dashboard that displays a left pane and a right pane. The left pane enables users to change password, view profile, etc.**<br>

<img width="926" alt="dashboard" src="https://user-images.githubusercontent.com/33366524/151390638-2d5ae65b-1e71-41f7-8a61-4b3b73bcba3f.png"><br>

**There are two modes of exam, one is Learn mode and the other is Exam mode.**<br>
<img width="616" alt="exam-modes" src="https://user-images.githubusercontent.com/33366524/151390658-1f917031-b49e-45e2-8bcf-f84c27e73c4d.png"><br>

**Given below shows a typical exhibit based question:**<br>

<img width="769" alt="exhibit-based-question" src="https://user-images.githubusercontent.com/33366524/151390662-e5d8bad3-f900-47f8-84d2-6ab0425cc28a.png"><br>

**This screenshot shows "Question Review":**<br>

<img width="611" alt="review-questions" src="https://user-images.githubusercontent.com/33366524/151390679-f2698d3a-39ae-4841-9f2a-5546dd522669.png"><br>

**This following screen shot shows Review Screen of the exam being taken by the user:**<br>
<img width="524" alt="review-screen" src="https://user-images.githubusercontent.com/33366524/151390681-a779aedd-d5f0-49eb-aaf2-bea03360c0f7.png"><br>

**This shows the Review Summary after completion of exam by the user:**<br>
<img width="384" alt="review-summary" src="https://user-images.githubusercontent.com/33366524/151390684-069e34cf-da3b-4383-a52e-ede6d549363c.png"><br>

**Score report screen is shown below for a typical exam taken by a user:**<br>

<img width="439" alt="score-repo" src="https://user-images.githubusercontent.com/33366524/151390690-937f2a66-5a0d-4c30-8241-ce0bac090eff.png"><br>

**Test screen is shown below where the question being answered by a user is shown:**<br>
<img width="605" alt="test-screen" src="https://user-images.githubusercontent.com/33366524/151390694-7c8f6799-a4c8-40b4-8657-ed89bfe44df6.png"><br>

**The following picture shows the User Profile:**<br>
<img width="539" alt="user-profile" src="https://user-images.githubusercontent.com/33366524/151390697-52e51d8c-59fc-43dd-ab14-7f5934ad74d0.png"><br>


# How to Use
<!-- As I have mentioned before, you never know who is going to read your readme. So it is better to provide information on how to use your project. A step-by-step guide is best suited for this purpose. It is better to explain steps as detailed as possible because it might be a beginner who is reading it. -->
** There are 3 categories of users:**
 - Administrators
 - Authors
 - Registered Users


# License
<!-- A short description of the license. (MIT, Apache, etc.) -->
The code is under Open Source software license. Individuals may use the code without any permission. Organizational users need to take the permission to use the software.

- Source website: [Certexams.com](https://www.certexams.com)
- View the demo site by logging on to [online.certexams.com](https://online.certexams.com/index.html)
- Help with editing, check this resource: #### https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax
<!-- - Provides scrips for conducting online exams. -->

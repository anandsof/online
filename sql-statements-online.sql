SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE active (
  activeid int(11) NOT NULL,
  userName varchar(20) DEFAULT NULL,
  value varchar(50) DEFAULT NULL,
  stime time DEFAULT NULL,
  ipaddress text,
  logno int(11) DEFAULT NULL,
  sdata date DEFAULT NULL,
  ndate date DEFAULT NULL,
  status text,
  ntime time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE active_old (
  activeid int(11) NOT NULL,
  userName varchar(20) DEFAULT NULL,
  value varchar(50) DEFAULT NULL,
  stime time DEFAULT NULL,
  ipaddress text,
  logno int(11) DEFAULT NULL,
  sdata date DEFAULT NULL,
  ndate date DEFAULT NULL,
  status text,
  ntime time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE candidate (
  candidateID int(11) NOT NULL,
  userName varchar(20) DEFAULT NULL,
  userPassword varchar(20) DEFAULT NULL,
  firstName tinytext,
  lastName tinytext,
  email varchar(50) DEFAULT NULL,
  address tinytext,
  city tinytext,
  state tinytext,
  postCode varchar(20) DEFAULT NULL,
  country tinytext,
  homePhone varchar(30) DEFAULT NULL,
  workPhone varchar(30) DEFAULT NULL,
  mobilePhone varchar(30) DEFAULT NULL,
  fax varchar(30) DEFAULT NULL,
  company tinytext,
  title tinytext,
  date date DEFAULT NULL,
  admin tinyint(4) NOT NULL DEFAULT '0',
  editGroup tinyint(4) NOT NULL DEFAULT '0',
  editExam tinyint(4) NOT NULL DEFAULT '0',
  sdate date DEFAULT NULL,
  edate date DEFAULT NULL,
  salutation text,
  certifications text,
  Userstat tinytext,
  Inforeceipt tinytext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE candidateGroup (
  candidateGroupid int(11) NOT NULL,
  candidateID int(11) NOT NULL DEFAULT '0',
  groupid int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE checklist (
  id tinyint(4) NOT NULL DEFAULT '0',
  currentstatus bigint(20) NOT NULL DEFAULT '0',
  increment int(11) NOT NULL DEFAULT '0',
  subject varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE dragdrop (
  scoreid int(11) NOT NULL DEFAULT '0',
  questionid int(11) NOT NULL DEFAULT '0',
  choice1 mediumtext,
  choice2 mediumtext,
  choice3 mediumtext,
  choice4 mediumtext,
  choice5 mediumtext,
  choice6 mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE EmailTemp (
  id int(11) NOT NULL,
  candidateID text,
  userName text,
  status text,
  subject text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE exam (
  examid int(11) NOT NULL,
  title mediumtext NOT NULL,
  id varchar(50) NOT NULL DEFAULT '0',
  version varchar(50) NOT NULL DEFAULT '0',
  instructions text,
  date date DEFAULT NULL,
  questions int(11) NOT NULL DEFAULT '0',
  startDate date NOT NULL DEFAULT '0000-00-00',
  endDate date NOT NULL DEFAULT '0000-00-00',
  time tinyint(4) NOT NULL DEFAULT '0',
  passingScore tinyint(3) NOT NULL DEFAULT '0',
  active varchar(5) DEFAULT 'No',
  groupid int(11) NOT NULL DEFAULT '0',
  examtitlequestionpage text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE examPermissions (
  examPermissionid int(11) NOT NULL,
  candidateID int(11) NOT NULL DEFAULT '0',
  examid int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE exam_old (
  examid int(11) NOT NULL,
  title mediumtext NOT NULL,
  id varchar(50) NOT NULL DEFAULT '0',
  version varchar(50) NOT NULL DEFAULT '0',
  instructions text,
  date date DEFAULT NULL,
  questions tinyint(3) NOT NULL DEFAULT '0',
  startDate date NOT NULL DEFAULT '0000-00-00',
  endDate date NOT NULL DEFAULT '0000-00-00',
  time tinyint(4) NOT NULL DEFAULT '0',
  passingScore tinyint(3) NOT NULL DEFAULT '0',
  active varchar(5) DEFAULT 'No',
  groupid int(11) NOT NULL DEFAULT '0',
  examtitlequestionpage text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE groupPermissions (
  groupPermissionid int(11) NOT NULL,
  candidateID int(11) NOT NULL DEFAULT '0',
  groupid int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE groups (
  groupid int(11) NOT NULL,
  groupName varchar(50) NOT NULL DEFAULT 'visitor'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE Guests (
  sno int(11) NOT NULL,
  ipaddress text,
  logintime time DEFAULT NULL,
  logindate date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE images (
  imageid int(11) NOT NULL,
  questionid int(11) NOT NULL DEFAULT '0',
  description varchar(255) NOT NULL DEFAULT '',
  filename varchar(255) NOT NULL DEFAULT '',
  filesize int(11) NOT NULL DEFAULT '0',
  width smallint(6) NOT NULL DEFAULT '0',
  height smallint(6) NOT NULL DEFAULT '0',
  filetype varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE images_old (
  imageid int(11) NOT NULL,
  questionid int(11) NOT NULL DEFAULT '0',
  description varchar(255) NOT NULL DEFAULT '',
  filename varchar(255) NOT NULL DEFAULT '',
  filesize int(11) NOT NULL DEFAULT '0',
  width smallint(6) NOT NULL DEFAULT '0',
  height smallint(6) NOT NULL DEFAULT '0',
  filetype varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE plogins (
  id int(11) NOT NULL,
  userName text,
  lnumber int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE question (
  questionid int(11) NOT NULL,
  question text,
  choice1 mediumtext,
  choice2 mediumtext,
  choice3 mediumtext,
  choice4 mediumtext,
  choice5 mediumtext,
  choice6 mediumtext,
  answer text,
  date date DEFAULT NULL,
  feedback mediumtext,
  category varchar(50) DEFAULT 'None',
  reference varchar(50) DEFAULT NULL,
  examid int(11) NOT NULL DEFAULT '0',
  type mediumtext,
  used tinyint(2) NOT NULL DEFAULT '1',
  weight tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE question_old (
  questionid int(11) NOT NULL,
  question text,
  choice1 mediumtext,
  choice2 mediumtext,
  choice3 mediumtext,
  choice4 mediumtext,
  choice5 mediumtext,
  choice6 mediumtext,
  answer text,
  date date DEFAULT NULL,
  feedback mediumtext,
  category varchar(50) DEFAULT 'None',
  reference varchar(50) DEFAULT NULL,
  examid int(11) NOT NULL DEFAULT '0',
  type mediumtext,
  used tinyint(2) NOT NULL DEFAULT '1',
  weight tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE scores (
  scoreid int(11) NOT NULL,
  candidateID int(11) NOT NULL DEFAULT '0',
  examid int(11) NOT NULL DEFAULT '0',
  marks int(5) NOT NULL DEFAULT '0',
  date date DEFAULT NULL,
  time time DEFAULT NULL,
  timetaken time DEFAULT NULL,
  maxMarks int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE serial_prefixes (
  id int(11) NOT NULL,
  examid int(11) DEFAULT NULL,
  prefix text,
  groupid int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE serial_prefixes_old (
  id int(11) NOT NULL,
  examid int(11) DEFAULT NULL,
  prefix text,
  groupid int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE subscription (
  Id bigint(20) NOT NULL,
  Name varchar(25) NOT NULL DEFAULT '',
  Email varchar(25) NOT NULL DEFAULT '',
  Interest varchar(25) NOT NULL DEFAULT '',
  Subscription tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE temp (
  sno int(11) NOT NULL,
  scoreid int(11) NOT NULL DEFAULT '0',
  questionid int(11) NOT NULL DEFAULT '0',
  answer text,
  markQuestion varchar(5) DEFAULT NULL,
  marks int(2) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE test (
  scoreid int(11) NOT NULL DEFAULT '0',
  questionid int(11) NOT NULL DEFAULT '0',
  marks int(3) DEFAULT '0',
  answer text,
  markQuestion varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE active
  ADD PRIMARY KEY (activeid);

ALTER TABLE active_old
  ADD PRIMARY KEY (activeid);

ALTER TABLE candidate
  ADD PRIMARY KEY (candidateID);

ALTER TABLE candidateGroup
  ADD PRIMARY KEY (candidateGroupid);

ALTER TABLE dragdrop
  ADD PRIMARY KEY (scoreid,questionid);

ALTER TABLE EmailTemp
  ADD PRIMARY KEY (id);

ALTER TABLE exam
  ADD PRIMARY KEY (examid);

ALTER TABLE examPermissions
  ADD PRIMARY KEY (examPermissionid);

ALTER TABLE exam_old
  ADD PRIMARY KEY (examid);

ALTER TABLE groupPermissions
  ADD PRIMARY KEY (groupPermissionid);

ALTER TABLE groups
  ADD PRIMARY KEY (groupid);

ALTER TABLE Guests
  ADD PRIMARY KEY (sno);

ALTER TABLE images
  ADD PRIMARY KEY (imageid);

ALTER TABLE images_old
  ADD PRIMARY KEY (imageid);

ALTER TABLE plogins
  ADD PRIMARY KEY (id);

ALTER TABLE question
  ADD PRIMARY KEY (questionid);

ALTER TABLE question_old
  ADD PRIMARY KEY (questionid);

ALTER TABLE scores
  ADD PRIMARY KEY (scoreid);

ALTER TABLE serial_prefixes
  ADD PRIMARY KEY (id);

ALTER TABLE serial_prefixes_old
  ADD PRIMARY KEY (id);

ALTER TABLE subscription
  ADD PRIMARY KEY (Id,Email);

ALTER TABLE temp
  ADD PRIMARY KEY (sno);

ALTER TABLE test
  ADD PRIMARY KEY (scoreid,questionid);


ALTER TABLE active
  MODIFY activeid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE active_old
  MODIFY activeid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE candidate
  MODIFY candidateID int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE candidateGroup
  MODIFY candidateGroupid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE EmailTemp
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE exam
  MODIFY examid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE examPermissions
  MODIFY examPermissionid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE exam_old
  MODIFY examid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE groupPermissions
  MODIFY groupPermissionid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE groups
  MODIFY groupid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE Guests
  MODIFY sno int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE images
  MODIFY imageid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE images_old
  MODIFY imageid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE plogins
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE question
  MODIFY questionid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE question_old
  MODIFY questionid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE scores
  MODIFY scoreid int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE serial_prefixes
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE serial_prefixes_old
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE subscription
  MODIFY Id bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE temp
  MODIFY sno int(11) NOT NULL AUTO_INCREMENT;

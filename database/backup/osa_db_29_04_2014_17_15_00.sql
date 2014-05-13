-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2014 at 10:15 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `osa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET utf8 NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('049980b90f97ed149d4cc7be8baaf04f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1398758219, 'a:2:{s:9:"user_data";s:0:"";s:12:"TX_USEREMAIL";s:14:"gẻgergergreg";}'),
('081fd5b6b86376026a300bd7a8b6644a', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1398754143, 'a:4:{s:9:"user_data";s:0:"";s:8:"ID_LOGIN";s:13:"administrator";s:16:"TX_SECURITY_CODE";s:9:"9DE62C93A";s:3:"uid";a:11:{s:7:"ID_USER";s:2:"13";s:8:"ID_LOGIN";s:13:"administrator";s:8:"IN_ADMIN";s:1:"1";s:13:"IN_CONSULTANT";s:1:"0";s:7:"IN_USER";s:1:"0";s:15:"NM_ORGANISATION";s:6:"123123";s:7:"NM_USER";s:6:"123123";s:12:"TX_USEREMAIL";s:22:"phanquocgiam@gmail.com";s:13:"DT_LAST_LOGIN";s:19:"2014-04-29 11:32:49";s:9:"IN_ACTIVE";s:1:"1";s:5:"token";s:38:"{801F1603-D632-91E0-D7F1-F7CADE89C7B6}";}}'),
('618b7d28372f1a0bc2b8c1b55fbd41fc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1398746028, 'a:1:{s:9:"user_data";s:0:"";}'),
('86510820b235614d811a6797752a0d44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1398754070, 'a:1:{s:9:"user_data";s:0:"";}'),
('b4283d272480810cb1df82fbbc819058', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0', 1398758670, 'a:3:{s:9:"user_data";s:0:"";s:8:"ID_LOGIN";s:13:"administrator";s:16:"TX_SECURITY_CODE";s:9:"AFD7D5F69";}');

-- --------------------------------------------------------

--
-- Table structure for table `complimentaryattraction`
--

CREATE TABLE IF NOT EXISTS `complimentaryattraction` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `RequestReference` varchar(50) NOT NULL,
  `ItemCode` int(11) NOT NULL,
  `ValidEntry` int(11) NOT NULL,
  `EntryUsed` int(11) DEFAULT NULL,
  `DateRedeemed` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `complimentarypin`
--

CREATE TABLE IF NOT EXISTS `complimentarypin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Request_Reference` varchar(10) NOT NULL,
  `DateOfEntry` datetime NOT NULL,
  `ValidPeriod` int(11) NOT NULL,
  `ValidEntry` int(11) NOT NULL,
  `CodeNo` varchar(10) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(100) NOT NULL,
  `TEMPLATE_KEY` varchar(100) NOT NULL,
  `TEMPLATE_SUBJECT` varchar(100) DEFAULT NULL,
  `TEMPLATE_BODY` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Email templae using active accout, forgot password/id , report....' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(1, 'EMAIL', 'ACTIVE_ACCOUNT', 'ACTIVE ACCOUNT', '<!DOCTYPE html>\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">\r\n  <head profile="http://www.w3.org/2000/08/w3c-synd/#">\r\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n    <style>\r\ntd {\r\n  font-family: arial;\r\n  font-size: small;\r\n}\r\n</style>\r\n    <title>Survey Online</title>\r\n    </head>\r\n    <body bgcolor="#ffffff" topmargin="20" marginwidth="0" marginheight="0">\r\n        \r\n        \r\n          <h3 align="center"><strong>Welcome Survey Online</strong>\r\n          </h3>\r\n          \r\n        <center>\r\n          <table width="609" height="51" style="border-width : 1px; border-style : solid; border-color: DarkGray;" cellpadding="0" cellspacing="0" bgcolor="#ffffff">\r\n    <tr>\r\n              <td bgcolor="#f4f7f9"><table width="100%%" cellpadding="5" cellspacing="5" bgcolor="#ffffff" border="0" align="center">\r\n                  <tr bgcolor="#cbd8de">\r\n                  <td align="center"><div align="center"><b> Request  Active Account </b></div></td>\r\n                </tr>\r\n                  <tr bgcolor="#f4f7f9">\r\n                  <td height="120" valign="top"><table width="100%%" cellpadding="0" cellspacing="0" border="0">\r\n                      <tr>\r\n                      <td align="center"><p>You have created an account on the website  Survey Online</p>\r\n                        <p>To use the features of Survey Online please activate your account with the activation code </p>\r\n                        <p>Active Code : <strong>{RAN_ACTIVECODE} </strong></p>\r\n                        <p>&nbsp;</p>\r\n                        <p>Click<a href="{LINK_ACTIVE}"><em> Here </em></a> to auto active your account</p><br>\r\n                        <p>Or paste link to address bar :</p><em>{LINK_ACTIVE}</em></td>\r\n                    </tr>\r\n                      <tr>\r\n                      <td></td>\r\n                    </tr>\r\n                      <tr>\r\n                      <td><table width="588" height="40">\r\n                          <tr>\r\n                          <td height="34"><div align="center">\r\n                            <p>\r\n                            <em>Thank you used services of Online Survey</em></p>\r\n                          </div></td>\r\n                        </tr>\r\n                        </table></td>\r\n                    </tr>\r\n                    </table></td>\r\n                </tr>\r\n                </table></td>\r\n            </tr>\r\n          </table>\r\n        </center>\r\n</body>\r\n</html>\r\n'),
(2, 'EMAIL', 'FORGOT_ID', 'SUBJECT : GET ID', '<!DOCTYPE html>\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">\n  <head profile="http://www.w3.org/2000/08/w3c-synd/#">\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\n    <style>\ntd {\n  font-family: arial;\n  font-size: small;\n}\n</style>\n    <title>Survey Online</title>\n    </head>\n    <body bgcolor="#ffffff" topmargin="20" marginwidth="0" marginheight="0">\n        \n        \n          <h3 align="center"><strong>Welcome Survey Online</strong>\n          </h3>\n          \n        <center>\n          <table width="609" height="51" style="border-width : 1px; border-style : solid; border-color: DarkGray;" cellpadding="0" cellspacing="0" bgcolor="#ffffff">\n    <tr>\n              <td bgcolor="#f4f7f9"><table width="100%%" cellpadding="5" cellspacing="5" bgcolor="#ffffff" border="0" align="center">\n                  <tr bgcolor="#cbd8de">\n                  <td align="center"><div align="center"><b> Request  Retrieve Username</b></div></td>\n                </tr>\n                  <tr bgcolor="#f4f7f9">\n                  <td height="120" valign="top"><table width="100%%" cellpadding="0" cellspacing="0" border="0">\n                      <tr>\n                      <td align="center"><p>You have requested for the your Username. Please take note of your account details below:</p>\n                        <p>Username : <strong>{ID_LOGIN} </strong></p>\n                        <p>&nbsp;</p>\n                        <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p></td>\n                    </tr>\n                      <tr>\n                      <td><table width="588" height="40">\n                          <tr>\n                          <td height="34"><div align="center">\n                            <p>\n                            <em>Thank you used services of Online Survey</em></p>\n                          </div></td>\n                        </tr>\n                        </table></td>\n                    </tr>\n                    </table></td>\n                </tr>\n                </table></td>\n            </tr>\n          </table>\n        </center>\n</body>\n</html>\n'),
(3, 'EMAIL', 'FORGOT_PASSWORD', 'SUBJECT : GET PASSWORD', '<!DOCTYPE html>\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">\n  <head profile="http://www.w3.org/2000/08/w3c-synd/#">\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\n    <style>\ntd {\n  font-family: arial;\n  font-size: small;\n}\n</style>\n    <title>Survey Online</title>\n    </head>\n    <body bgcolor="#ffffff" topmargin="20" marginwidth="0" marginheight="0">\n        \n        \n          <h3 align="center"><strong>Welcome Survey Online</strong>\n          </h3>\n          \n        <center>\n          <table width="609" height="51" style="border-width : 1px; border-style : solid; border-color: DarkGray;" cellpadding="0" cellspacing="0" bgcolor="#ffffff">\n    <tr>\n              <td bgcolor="#f4f7f9"><table width="100%%" cellpadding="5" cellspacing="5" bgcolor="#ffffff" border="0" align="center">\n                  <tr bgcolor="#cbd8de">\n                  <td align="center"><div align="center"><b> Request  Retrieve Password</b></div></td>\n                </tr>\n                  <tr bgcolor="#f4f7f9">\n                  <td height="120" valign="top"><table width="100%%" cellpadding="0" cellspacing="0" border="0">\n                      <tr>\n                      <td align="center"><p>Hi, {TX_USERNAME},</p></br><p>You have requested to reset the password for the following account:</p>\n                        <p>Username : <strong>{TX_USERNAME}</strong> </p>\n                        <p>Generated Password : <strong>{TX_SECURITY_CODE}</strong> </p>\n                        <p>&nbsp;</p>\n                        <p>To reset the password, please go to the <a href="{LINK_CHANGEPASSWORD}"><em>login page</em></a> and login with the given password. Upon login, you will be prompted to reset your password. Thank you.</p>\n                        </td><br>\n                        <p>Or paste link to address bar :</p><em>{LINK_CHANGEPASSWORD}</em></td>\n                    </tr>\n                      <tr>\n                      <td></td>\n                    </tr>\n                      <tr>\n                      <td><table width="588" height="40">\n                          <tr>\n                          <td height="34"><div align="center">\n                            <p>\n                            <em>Thank you used services of Online Survey</em></p>\n                          </div></td>\n                        </tr>\n                        </table></td>\n                    </tr>\n                    </table></td>\n                </tr>\n                </table></td>\n            </tr>\n          </table>\n        </center>\n</body>\n</html>\n');

-- --------------------------------------------------------

--
-- Table structure for table `t_attractions_update`
--

CREATE TABLE IF NOT EXISTS `t_attractions_update` (
  `ID_NUM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SEQ` int(11) NOT NULL,
  `ID_ItemCode` int(11) NOT NULL,
  `ID_AccessCode` int(11) NOT NULL,
  `DT_ENTRY_START` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `DT_ENTRY_END` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `X_PIN_CODE` smallint(5) NOT NULL DEFAULT '0',
  `NM_COMPANY` varchar(50) NOT NULL,
  `NM_VISITOR` varchar(50) NOT NULL,
  `ID_REQUESTER` varchar(50) NOT NULL,
  `NM_Email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_NUM`),
  UNIQUE KEY `ID_NUM` (`ID_NUM`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_company_info`
--

CREATE TABLE IF NOT EXISTS `t_company_info` (
  `ID_COMPANY` int(11) NOT NULL AUTO_INCREMENT,
  `NM_COMPANY` varchar(250) NOT NULL,
  `NM_RESPONDENT` varchar(250) NOT NULL,
  `NM_DESIGNATION` varchar(250) NOT NULL,
  `ID_FAMILY_OWNED` int(11) NOT NULL,
  `N_REVENUE` int(11) NOT NULL,
  `N_STAFF_SIZE` int(11) NOT NULL,
  `N_HR_SIZE` int(11) NOT NULL,
  `NM_INDUSTRY` varchar(250) NOT NULL,
  `NM_TYPE` varchar(250) NOT NULL,
  `TX_REMARKS` varchar(350) NOT NULL,
  `ID_CONSULTANT` varchar(30) NOT NULL,
  `ID_CONSULTANT_ORG` varchar(50) NOT NULL,
  `ID_GS1` smallint(6) NOT NULL,
  `ID_GS2` smallint(6) NOT NULL,
  PRIMARY KEY (`ID_COMPANY`),
  UNIQUE KEY `ID_COMPANY` (`ID_COMPANY`),
  UNIQUE KEY `ID_COMPANY_2` (`ID_COMPANY`),
  UNIQUE KEY `NM_COMPANY` (`NM_COMPANY`),
  KEY `ID_COMPANY_3` (`ID_COMPANY`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_complimentaryitems`
--

CREATE TABLE IF NOT EXISTS `t_complimentaryitems` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_AttractionID` int(11) NOT NULL,
  `ID_ItemCode` int(11) NOT NULL,
  `NM_ItemDescription` varchar(100) NOT NULL,
  `DC_AttractionName` varchar(50) NOT NULL,
  `IN_AccessIndicator` char(50) NOT NULL,
  `ID_AttractionOrg` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t_complimentaryitems`
--

INSERT INTO `t_complimentaryitems` (`Id`, `ID_AttractionID`, `ID_ItemCode`, `NM_ItemDescription`, `DC_AttractionName`, `IN_AccessIndicator`, `ID_AttractionOrg`) VALUES
(1, 1, 1234, 'PlayPass', 'PlayPass', 'P', 0),
(2, 2, 1235, 'FortSiloso', 'FortSiloso', 'S', 0),
(3, 3, 1236, 'Merlion', 'Merlion', 'S', 0),
(4, 4, 1237, 'RiderPackage', 'RiderPackage', 'P', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t_dropdown`
--

CREATE TABLE IF NOT EXISTS `t_dropdown` (
  `ID_DROPDOWN` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TYPE` varchar(100) NOT NULL,
  `VALUE` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_DROPDOWN`),
  UNIQUE KEY `ID_DROPDOWN` (`ID_DROPDOWN`),
  UNIQUE KEY `ID_DROPDOWN_2` (`ID_DROPDOWN`),
  KEY `ID_DROPDOWN_3` (`ID_DROPDOWN`),
  KEY `ID_DROPDOWN_4` (`ID_DROPDOWN`),
  KEY `ID_DROPDOWN_5` (`ID_DROPDOWN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `t_dropdown`
--

INSERT INTO `t_dropdown` (`ID_DROPDOWN`, `NM_TYPE`, `VALUE`) VALUES
(1, 'Company_Industry', 'Biomedical & Healthcare Services'),
(2, 'Company_Industry', 'Education'),
(3, 'Company_Industry', 'Electronics'),
(4, 'Company_Industry', 'Environmental, Chemical & Engineering Services'),
(5, 'Company_Industry', 'Food and Beverage Services'),
(6, 'Company_Industry', 'Food Manufacturing'),
(7, 'Company_Industry', 'Furniture'),
(8, 'Company_Industry', 'Logistics'),
(9, 'Company_Industry', 'Marine & Offshore Engineering'),
(10, 'Company_Industry', 'Precision Engineering'),
(11, 'Company_Industry', 'Printing'),
(12, 'Company_Industry', 'Retail'),
(13, 'Company_Industry', 'Textile & Apparel'),
(14, 'Company_Industry', 'Other'),
(15, 'Company_Type', 'Corporation'),
(16, 'Company_Type', 'Partnership'),
(17, 'Company_Type', 'Limited Partnership'),
(18, 'Company_Type', 'Limited Liability Partnership'),
(19, 'Company_Type', 'Private Limited Company'),
(20, 'Company_Type', 'Exempt Private Limited Company'),
(21, 'Company_Type', 'Gazetted Private Limited Company'),
(22, 'Company_Type', 'Company Limited by Share'),
(23, 'Company_Type', 'Company Limited by Guarantee'),
(24, 'Company_Type', 'Foreign Companies (Singapore Branch Office)'),
(25, 'Company_Type', 'Representative Office'),
(26, 'Revenue', 'More than $200m'),
(27, 'Revenue', '$150m - $200m'),
(28, 'Revenue', '$100m - $150m'),
(29, 'Revenue', '$50m - $100m'),
(30, 'Revenue', '$25m - $50m'),
(31, 'Revenue', '$10m - $25m'),
(32, 'Revenue', '$5m - $10m'),
(33, 'Revenue', '$1m - $5m'),
(34, 'Revenue', 'Less than $1m'),
(35, 'Total_Staff', 'More than 1300'),
(36, 'Total_Staff', '800 – 1300'),
(37, 'Total_Staff', '400 – 800'),
(38, 'Total_Staff', '201 – 400'),
(39, 'Total_Staff', '101 – 200'),
(40, 'Total_Staff', '51 – 100'),
(41, 'Total_Staff', 'Less than 50'),
(42, 'HR_Staff', 'More than 10'),
(43, 'HR_Staff', '6 – 10'),
(44, 'HR_Staff', '3 – 5'),
(45, 'HR_Staff', '1 – 2'),
(46, 'HR_Staff', 'No dedicated HR team'),
(47, 'HR_Staff', 'HR function is outsourced');

-- --------------------------------------------------------

--
-- Table structure for table `t_growth_stage`
--

CREATE TABLE IF NOT EXISTS `t_growth_stage` (
  `ID_GS` int(11) NOT NULL AUTO_INCREMENT,
  `NM_TYPE` varchar(100) NOT NULL,
  `VALUE` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_GS`),
  UNIQUE KEY `ID_GS` (`ID_GS`),
  KEY `ID_GS_2` (`ID_GS`),
  KEY `ID_GS_3` (`ID_GS`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `t_growth_stage`
--

INSERT INTO `t_growth_stage` (`ID_GS`, `NM_TYPE`, `VALUE`) VALUES
(1, 'QUESTION_1', 'The company has demonstrated a workable business model but is concerned with the ability to generate enough cash to break even (or finance growth to a size that is sufficiently large) and to cover repair/replacement of capital assets as they wear out'),
(2, 'QUESTION_1', 'Company has healthy profits and the objective is to keep it stable without additional risks or investments'),
(3, 'QUESTION_1', 'Company has healthy profits and the objective is to consolidate, shore up financial resources so as to expand'),
(4, 'QUESTION_1', 'Company is investing and trying to satify the great strains on cash and operations that rapid growth brings'),
(5, 'QUESTION_1', 'Company has the advantages of size and financial resources but it trying to consolidate and control the financial gains while preserving its invovation and entrepreneurial spirit'),
(6, 'QUESTION_2', 'Owner does everything himsefl  including directly supervising subordinates'),
(7, 'QUESTION_2', 'Company has a GM and/or Sales Manager who does not make decisions independently but carries out well-defined orders by the owner'),
(8, 'QUESTION_2', 'Company has several functions managers in place to take over certain duties of the owner and professionals like a Financial Controller or Production Scheduler are brought in'),
(9, 'QUESTION_2', 'Professional managers ane in place and the owner can fully delegate responsibility to; owner showing willingness to tolerate mistakes and resists the urge to take back direct control when something goes wrong');

-- --------------------------------------------------------

--
-- Table structure for table `t_itemaccesscode`
--

CREATE TABLE IF NOT EXISTS `t_itemaccesscode` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ItemCode` int(11) NOT NULL,
  `ID_AccessCode` int(11) NOT NULL,
  `NM_Description` varchar(100) NOT NULL,
  `NM_Email` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `t_itemaccesscode`
--

INSERT INTO `t_itemaccesscode` (`Id`, `ID_ItemCode`, `ID_AccessCode`, `NM_Description`, `NM_Email`) VALUES
(1, 1234, 1000, 'ImageOfSingapore', 'xxx@ios.com.sg'),
(2, 1234, 1001, 'NatureDiscovery', 'xxx@nd.com.sg'),
(3, 1234, 1002, 'SkyTower', 'xxx@st.com.sg'),
(4, 1235, 1003, 'FortSiloso', 'xxx@fs.com.sg'),
(5, 1236, 1004, 'Merlion', 'xxx@merlion.com.sg'),
(6, 1237, 1005, 'Cineblast', 'xxx@cb.com.sg'),
(7, 1237, 1006, 'Desperados', 'xxx@des.com.sg');

-- --------------------------------------------------------

--
-- Table structure for table `t_pin`
--

CREATE TABLE IF NOT EXISTS `t_pin` (
  `ID_PIN` smallint(6) NOT NULL AUTO_INCREMENT,
  `X_PIN` smallint(5) NOT NULL,
  `IN_VALIDITY` char(1) NOT NULL,
  PRIMARY KEY (`ID_PIN`),
  UNIQUE KEY `ID_PIN` (`ID_PIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_purpose`
--

CREATE TABLE IF NOT EXISTS `t_purpose` (
  `CD_PURPOSE` smallint(6) NOT NULL AUTO_INCREMENT,
  `DC_PURPOSE` varchar(30) NOT NULL,
  PRIMARY KEY (`CD_PURPOSE`),
  UNIQUE KEY `CD_PURPOSE` (`CD_PURPOSE`),
  UNIQUE KEY `DC_PURPOSE` (`DC_PURPOSE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_benchmark_dtl`
--

CREATE TABLE IF NOT EXISTS `t_survey_benchmark_dtl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_MATURITY` int(11) NOT NULL,
  `NM_CATEGORY` varchar(250) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=205 ;

--
-- Dumping data for table `t_survey_benchmark_dtl`
--

INSERT INTO `t_survey_benchmark_dtl` (`ID`, `ID_MATURITY`, `NM_CATEGORY`, `ID_QUESTION`, `ID_ANSWER`) VALUES
(1, 1, 'Recruitment', 1, 1),
(2, 1, 'Recruitment', 2, 5),
(3, 1, 'Recruitment', 3, 9),
(4, 1, 'HR Management', 4, 13),
(5, 1, 'HR Management', 5, 17),
(6, 1, 'HR Management', 6, 21),
(7, 1, 'Manpower Planning', 7, 26),
(8, 1, 'Manpower Planning', 8, 29),
(9, 1, 'Manpower Planning', 9, 33),
(10, 1, 'Training & Development', 10, 37),
(11, 1, 'Training & Development', 11, 41),
(12, 1, 'Training & Development', 12, 45),
(13, 1, 'Training & Development', 13, 49),
(14, 1, 'Performance Management', 14, 53),
(15, 1, 'Performance Management', 15, 57),
(16, 1, 'Performance Management', 16, 61),
(17, 1, 'Performance Management', 17, 65),
(18, 1, 'Compensation & Benefits', 18, 69),
(19, 1, 'Compensation & Benefits', 19, 73),
(20, 1, 'Compensation & Benefits', 20, 77),
(21, 1, 'Talent Management & Succession Planning', 21, 81),
(22, 1, 'Talent Management & Succession Planning', 22, 85),
(23, 1, 'Talent Management & Succession Planning', 23, 89),
(24, 1, 'Organization Culture & Core Values', 24, 93),
(25, 1, 'Organization Culture & Core Values', 25, 97),
(26, 1, 'Organization Culture & Core Values', 26, 101),
(27, 1, 'Employee Engagement & Communications', 27, 105),
(28, 1, 'Employee Engagement & Communications', 28, 109),
(29, 1, 'Employee Value Proposition (EVP)', 29, 113),
(30, 1, 'Employee Value Proposition (EVP)', 30, 117),
(31, 1, 'Employee Value Proposition (EVP)', 31, 121),
(32, 1, 'International Mobility', 32, 125),
(33, 1, 'International Mobility', 33, 129),
(34, 1, 'International Mobility', 34, 133),
(35, 2, 'Recruitment', 1, 2),
(36, 2, 'Recruitment', 2, 6),
(37, 2, 'Recruitment', 3, 10),
(38, 2, 'HR Management', 4, 14),
(39, 2, 'HR Management', 5, 17),
(40, 2, 'HR Management', 6, 21),
(41, 2, 'Manpower Planning', 7, 26),
(42, 2, 'Manpower Planning', 8, 29),
(43, 2, 'Manpower Planning', 9, 33),
(44, 2, 'Training & Development', 10, 37),
(45, 2, 'Training & Development', 11, 41),
(46, 2, 'Training & Development', 12, 46),
(47, 2, 'Training & Development', 13, 49),
(48, 2, 'Performance Management', 14, 54),
(49, 2, 'Performance Management', 15, 58),
(50, 2, 'Performance Management', 16, 61),
(51, 2, 'Performance Management', 17, 66),
(52, 2, 'Compensation & Benefits', 18, 70),
(53, 2, 'Compensation & Benefits', 19, 74),
(54, 2, 'Compensation & Benefits', 20, 78),
(55, 2, 'Talent Management & Succession Planning', 21, 81),
(56, 2, 'Talent Management & Succession Planning', 22, 85),
(57, 2, 'Talent Management & Succession Planning', 23, 89),
(58, 2, 'Organization Culture & Core Values', 24, 93),
(59, 2, 'Organization Culture & Core Values', 25, 97),
(60, 2, 'Organization Culture & Core Values', 26, 101),
(61, 2, 'Employee Engagement & Communications', 27, 105),
(62, 2, 'Employee Engagement & Communications', 28, 109),
(63, 2, 'Employee Value Proposition (EVP)', 29, 113),
(64, 2, 'Employee Value Proposition (EVP)', 30, 117),
(65, 2, 'Employee Value Proposition (EVP)', 31, 121),
(66, 2, 'International Mobility', 32, 125),
(67, 2, 'International Mobility', 33, 129),
(68, 2, 'International Mobility', 34, 133),
(69, 3, 'Recruitment', 1, 3),
(70, 3, 'Recruitment', 2, 7),
(71, 3, 'Recruitment', 3, 11),
(72, 3, 'HR Management', 4, 14),
(73, 3, 'HR Management', 5, 18),
(74, 3, 'HR Management', 6, 22),
(75, 3, 'Manpower Planning', 7, 27),
(76, 3, 'Manpower Planning', 8, 30),
(77, 3, 'Manpower Planning', 9, 34),
(78, 3, 'Training & Development', 10, 38),
(79, 3, 'Training & Development', 11, 42),
(80, 3, 'Training & Development', 12, 46),
(81, 3, 'Training & Development', 13, 50),
(82, 3, 'Performance Management', 14, 54),
(83, 3, 'Performance Management', 15, 58),
(84, 3, 'Performance Management', 16, 62),
(85, 3, 'Performance Management', 17, 67),
(86, 3, 'Compensation & Benefits', 18, 70),
(87, 3, 'Compensation & Benefits', 19, 74),
(88, 3, 'Compensation & Benefits', 20, 78),
(89, 3, 'Talent Management & Succession Planning', 21, 81),
(90, 3, 'Talent Management & Succession Planning', 22, 86),
(91, 3, 'Talent Management & Succession Planning', 23, 90),
(92, 3, 'Organization Culture & Core Values', 24, 94),
(93, 3, 'Organization Culture & Core Values', 25, 98),
(94, 3, 'Organization Culture & Core Values', 26, 102),
(95, 3, 'Employee Engagement & Communications', 27, 106),
(96, 3, 'Employee Engagement & Communications', 28, 110),
(97, 3, 'Employee Value Proposition (EVP)', 29, 114),
(98, 3, 'Employee Value Proposition (EVP)', 30, 118),
(99, 3, 'Employee Value Proposition (EVP)', 31, 122),
(100, 3, 'International Mobility', 32, 126),
(101, 3, 'International Mobility', 33, 130),
(102, 3, 'International Mobility', 34, 134),
(103, 4, 'Recruitment', 1, 3),
(104, 4, 'Recruitment', 2, 7),
(105, 4, 'Recruitment', 3, 11),
(106, 4, 'HR Management', 4, 14),
(107, 4, 'HR Management', 5, 18),
(108, 4, 'HR Management', 6, 22),
(109, 4, 'Manpower Planning', 7, 27),
(110, 4, 'Manpower Planning', 8, 31),
(111, 4, 'Manpower Planning', 9, 35),
(112, 4, 'Training & Development', 10, 38),
(113, 4, 'Training & Development', 11, 42),
(114, 4, 'Training & Development', 12, 46),
(115, 4, 'Training & Development', 13, 50),
(116, 4, 'Performance Management', 14, 55),
(117, 4, 'Performance Management', 15, 59),
(118, 4, 'Performance Management', 16, 63),
(119, 4, 'Performance Management', 17, 67),
(120, 4, 'Compensation & Benefits', 18, 71),
(121, 4, 'Compensation & Benefits', 19, 75),
(122, 4, 'Compensation & Benefits', 20, 79),
(123, 4, 'Talent Management & Succession Planning', 21, 82),
(124, 4, 'Talent Management & Succession Planning', 22, 87),
(125, 4, 'Talent Management & Succession Planning', 23, 91),
(126, 4, 'Organization Culture & Core Values', 24, 94),
(127, 4, 'Organization Culture & Core Values', 25, 98),
(128, 4, 'Organization Culture & Core Values', 26, 102),
(129, 4, 'Employee Engagement & Communications', 27, 106),
(130, 4, 'Employee Engagement & Communications', 28, 110),
(131, 4, 'Employee Value Proposition (EVP)', 29, 115),
(132, 4, 'Employee Value Proposition (EVP)', 30, 119),
(133, 4, 'Employee Value Proposition (EVP)', 31, 123),
(134, 4, 'International Mobility', 32, 127),
(135, 4, 'International Mobility', 33, 131),
(136, 4, 'International Mobility', 34, 135),
(137, 5, 'Recruitment', 1, 3),
(138, 5, 'Recruitment', 2, 7),
(139, 5, 'Recruitment', 3, 11),
(140, 5, 'HR Management', 4, 15),
(141, 5, 'HR Management', 5, 19),
(142, 5, 'HR Management', 6, 23),
(143, 5, 'Manpower Planning', 7, 27),
(144, 5, 'Manpower Planning', 8, 31),
(145, 5, 'Manpower Planning', 9, 35),
(146, 5, 'Training & Development', 10, 39),
(147, 5, 'Training & Development', 11, 43),
(148, 5, 'Training & Development', 12, 47),
(149, 5, 'Training & Development', 13, 51),
(150, 5, 'Performance Management', 14, 55),
(151, 5, 'Performance Management', 15, 59),
(152, 5, 'Performance Management', 16, 63),
(153, 5, 'Performance Management', 17, 67),
(154, 5, 'Compensation & Benefits', 18, 71),
(155, 5, 'Compensation & Benefits', 19, 75),
(156, 5, 'Compensation & Benefits', 20, 79),
(157, 5, 'Talent Management & Succession Planning', 21, 83),
(158, 5, 'Talent Management & Succession Planning', 22, 87),
(159, 5, 'Talent Management & Succession Planning', 23, 91),
(160, 5, 'Organization Culture & Core Values', 24, 95),
(161, 5, 'Organization Culture & Core Values', 25, 99),
(162, 5, 'Organization Culture & Core Values', 26, 103),
(163, 5, 'Employee Engagement & Communications', 27, 107),
(164, 5, 'Employee Engagement & Communications', 28, 111),
(165, 5, 'Employee Value Proposition (EVP)', 29, 115),
(166, 5, 'Employee Value Proposition (EVP)', 30, 119),
(167, 5, 'Employee Value Proposition (EVP)', 31, 123),
(168, 5, 'International Mobility', 32, 127),
(169, 5, 'International Mobility', 33, 131),
(170, 5, 'International Mobility', 34, 135),
(171, 6, 'Recruitment', 1, 4),
(172, 6, 'Recruitment', 2, 8),
(173, 6, 'Recruitment', 3, 12),
(174, 6, 'HR Management', 4, 16),
(175, 6, 'HR Management', 5, 20),
(176, 6, 'HR Management', 6, 24),
(177, 6, 'Manpower Planning', 7, 28),
(178, 6, 'Manpower Planning', 8, 32),
(179, 6, 'Manpower Planning', 9, 36),
(180, 6, 'Training & Development', 10, 40),
(181, 6, 'Training & Development', 11, 44),
(182, 6, 'Training & Development', 12, 48),
(183, 6, 'Training & Development', 13, 52),
(184, 6, 'Performance Management', 14, 56),
(185, 6, 'Performance Management', 15, 60),
(186, 6, 'Performance Management', 16, 64),
(187, 6, 'Performance Management', 17, 68),
(188, 6, 'Compensation & Benefits', 18, 72),
(189, 6, 'Compensation & Benefits', 19, 76),
(190, 6, 'Compensation & Benefits', 20, 80),
(191, 6, 'Talent Management & Succession Planning', 21, 84),
(192, 6, 'Talent Management & Succession Planning', 22, 88),
(193, 6, 'Talent Management & Succession Planning', 23, 92),
(194, 6, 'Organization Culture & Core Values', 24, 96),
(195, 6, 'Organization Culture & Core Values', 25, 100),
(196, 6, 'Organization Culture & Core Values', 26, 104),
(197, 6, 'Employee Engagement & Communications', 27, 108),
(198, 6, 'Employee Engagement & Communications', 28, 112),
(199, 6, 'Employee Value Proposition (EVP)', 29, 116),
(200, 6, 'Employee Value Proposition (EVP)', 30, 120),
(201, 6, 'Employee Value Proposition (EVP)', 31, 124),
(202, 6, 'International Mobility', 32, 128),
(203, 6, 'International Mobility', 33, 132),
(204, 6, 'International Mobility', 34, 136);

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_benchmark_hdr`
--

CREATE TABLE IF NOT EXISTS `t_survey_benchmark_hdr` (
  `ID_MATURITY` int(11) NOT NULL AUTO_INCREMENT,
  `NM_CATEGORY` varchar(250) CHARACTER SET utf8 NOT NULL,
  `INT_CAT` int(11) NOT NULL,
  PRIMARY KEY (`ID_MATURITY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `t_survey_benchmark_hdr`
--

INSERT INTO `t_survey_benchmark_hdr` (`ID_MATURITY`, `NM_CATEGORY`, `INT_CAT`) VALUES
(1, 'Stage I', 1),
(2, 'Stage II', 1),
(3, 'Stage IIID', 2),
(4, 'Stage IIIG', 2),
(5, 'Stage IV', 3),
(6, 'Stage V', 4);

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_option`
--

CREATE TABLE IF NOT EXISTS `t_survey_option` (
  `ID_ANSWER` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUESTION` int(11) NOT NULL,
  `NM_ANSWER` varchar(250) NOT NULL,
  `IN_POINT` int(1) NOT NULL,
  PRIMARY KEY (`ID_ANSWER`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=137 ;

--
-- Dumping data for table `t_survey_option`
--

INSERT INTO `t_survey_option` (`ID_ANSWER`, `ID_QUESTION`, `NM_ANSWER`, `IN_POINT`) VALUES
(1, 1, 'answer 1', 1),
(2, 1, 'answer 2', 2),
(3, 1, 'answer 3', 3),
(4, 1, 'answer 4', 4),
(5, 2, 'answer 1', 1),
(6, 2, 'answer 2', 2),
(7, 2, 'answer 3', 3),
(8, 2, 'answer 4', 4),
(9, 3, 'answer 1', 1),
(10, 3, 'answer 2', 2),
(11, 3, 'answer 3', 3),
(12, 3, 'answer 4', 4),
(13, 4, 'answer 1', 1),
(14, 4, 'answer 2', 2),
(15, 4, 'answer 3', 3),
(16, 4, 'answer 4', 4),
(17, 5, 'answer 1', 1),
(18, 5, 'answer 2', 2),
(19, 5, 'answer 3', 3),
(20, 5, 'answer 4', 4),
(21, 6, 'answer 1', 1),
(22, 6, 'answer 2', 2),
(23, 6, 'answer 3', 3),
(24, 6, 'answer 4', 4),
(25, 7, 'answer 1', 1),
(26, 7, 'answer 2', 2),
(27, 7, 'answer 3', 3),
(28, 7, 'answer 4', 4),
(29, 8, 'answer 1', 1),
(30, 8, 'answer 2', 2),
(31, 8, 'answer 3', 3),
(32, 8, 'answer 4', 4),
(33, 9, 'answer 1', 1),
(34, 9, 'answer 2', 2),
(35, 9, 'answer 3', 3),
(36, 9, 'answer 4', 4),
(37, 10, 'answer 1', 1),
(38, 10, 'answer 2', 2),
(39, 10, 'answer 3', 3),
(40, 10, 'answer 4', 4),
(41, 11, 'answer 1', 1),
(42, 11, 'answer 2', 2),
(43, 11, 'answer 3', 3),
(44, 11, 'answer 4', 4),
(45, 12, 'answer 1', 1),
(46, 12, 'answer 2', 2),
(47, 12, 'answer 3', 3),
(48, 12, 'answer 4', 4),
(49, 13, 'answer 1', 1),
(50, 13, 'answer 2', 2),
(51, 13, 'answer 3', 3),
(52, 13, 'answer 4', 4),
(53, 14, 'answer 1', 1),
(54, 14, 'answer 2', 2),
(55, 14, 'answer 3', 3),
(56, 14, 'answer 4', 4),
(57, 15, 'answer 1', 1),
(58, 15, 'answer 2', 2),
(59, 15, 'answer 3', 3),
(60, 15, 'answer 4', 4),
(61, 16, 'answer 1', 1),
(62, 16, 'answer 2', 2),
(63, 16, 'answer 3', 3),
(64, 16, 'answer 4', 4),
(65, 17, 'answer 1', 1),
(66, 17, 'answer 2', 2),
(67, 17, 'answer 3', 3),
(68, 17, 'answer 4', 4),
(69, 18, 'answer 1', 1),
(70, 18, 'answer 2', 2),
(71, 18, 'answer 3', 3),
(72, 18, 'answer 4', 4),
(73, 19, 'answer 1', 1),
(74, 19, 'answer 2', 2),
(75, 19, 'answer 3', 3),
(76, 19, 'answer 4', 4),
(77, 20, 'answer 1', 1),
(78, 20, 'answer 2', 2),
(79, 20, 'answer 3', 3),
(80, 20, 'answer 4', 4),
(81, 21, 'answer 1', 1),
(82, 21, 'answer 2', 2),
(83, 21, 'answer 3', 3),
(84, 21, 'answer 4', 4),
(85, 22, 'answer 1', 1),
(86, 22, 'answer 2', 2),
(87, 22, 'answer 3', 3),
(88, 22, 'answer 4', 4),
(89, 23, 'answer 1', 1),
(90, 23, 'answer 2', 2),
(91, 23, 'answer 3', 3),
(92, 23, 'answer 4', 4),
(93, 24, 'answer 1', 1),
(94, 24, 'answer 2', 2),
(95, 24, 'answer 3', 3),
(96, 24, 'answer 4', 4),
(97, 25, 'answer 1', 1),
(98, 25, 'answer 2', 2),
(99, 25, 'answer 3', 3),
(100, 25, 'answer 4', 4),
(101, 26, 'answer 1', 1),
(102, 26, 'answer 2', 2),
(103, 26, 'answer 3', 3),
(104, 26, 'answer 4', 4),
(105, 27, 'answer 1', 1),
(106, 27, 'answer 2', 2),
(107, 27, 'answer 3', 3),
(108, 27, 'answer 4', 4),
(109, 28, 'answer 1', 1),
(110, 28, 'answer 2', 2),
(111, 28, 'answer 3', 3),
(112, 28, 'answer 4', 4),
(113, 29, 'answer 1', 1),
(114, 29, 'answer 2', 2),
(115, 29, 'answer 3', 3),
(116, 29, 'answer 4', 4),
(117, 30, 'answer 1', 1),
(118, 30, 'answer 2', 2),
(119, 30, 'answer 3', 3),
(120, 30, 'answer 4', 4),
(121, 31, 'answer 1', 1),
(122, 31, 'answer 2', 2),
(123, 31, 'answer 3', 3),
(124, 31, 'answer 4', 4),
(125, 32, 'answer 1', 1),
(126, 32, 'answer 2', 2),
(127, 32, 'answer 3', 3),
(128, 32, 'answer 4', 4),
(129, 33, 'answer 1', 1),
(130, 33, 'answer 2', 2),
(131, 33, 'answer 3', 3),
(132, 33, 'answer 4', 4),
(133, 34, 'answer 1', 1),
(134, 34, 'answer 2', 2),
(135, 34, 'answer 3', 3),
(136, 34, 'answer 4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_question`
--

CREATE TABLE IF NOT EXISTS `t_survey_question` (
  `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT,
  `NM_QUESTION` varchar(250) NOT NULL,
  `NM_CATEGORY` varchar(250) NOT NULL,
  `DT_PRIMARY` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `TX_PRIMARY_STATUS` varchar(20) NOT NULL DEFAULT 'Pending',
  `ID_SECONDARY` int(11) NOT NULL,
  `DT_SECONDARY` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `TX_SECONDARY_STATUS` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_QUESTION`),
  UNIQUE KEY `ID_QUESTION` (`ID_QUESTION`),
  UNIQUE KEY `NM_QUESTION` (`NM_QUESTION`),
  KEY `ID_QUESTION_2` (`ID_QUESTION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `t_survey_question`
--

INSERT INTO `t_survey_question` (`ID_QUESTION`, `NM_QUESTION`, `NM_CATEGORY`, `DT_PRIMARY`, `TX_PRIMARY_STATUS`, `ID_SECONDARY`, `DT_SECONDARY`, `TX_SECONDARY_STATUS`) VALUES
(1, 'Job Requirements', 'Recruitment', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(2, 'Recruitment Criteria', 'Recruitment', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(3, 'Recruitment Process', 'Recruitment', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(4, 'HR Policies', 'HR Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(5, 'HR Processes', 'HR Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(6, 'Employee Data', 'HR Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(7, 'Org & Role Design', 'Manpower Planning', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(8, 'Manpower Projections', 'Manpower Planning', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(9, 'Manpower Review', 'Manpower Planning', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(10, 'Training Needs Analysis', 'Training & Development', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(11, 'Training & Devt Roadmap', 'Training & Development', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(12, 'Training Participation', 'Training & Development', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(13, 'Employee Onboarding', 'Training & Development', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(14, 'Goal-Setting', 'Performance Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(15, 'Performance Appraisal Process', 'Performance Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(16, 'Performance Coaching', 'Performance Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(17, 'Performance Incentives', 'Performance Management', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(18, 'C&B Structure ', 'Compensation & Benefits', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(19, 'Market Benchmarking', 'Compensation & Benefits', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(20, 'C&B Review', 'Compensation & Benefits', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(21, 'Mission-Critical Roles', 'Talent Management & Succession Planning', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(22, 'Talent Identification Criteria', 'Talent Management & Succession Planning', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(23, 'Succession Planning Process', 'Talent Management & Succession Planning', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(24, 'Culture Definition', 'Organization Culture & Core Values', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(25, 'Culture Development', 'Organization Culture & Core Values', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(26, 'Culture Drivers', 'Organization Culture & Core Values', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(27, 'Employee Engagement', 'Employee Engagement & Communications', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(28, 'Employee Comms', 'Employee Engagement & Communications', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(29, 'EVP Definition', 'Employee Value Proposition (EVP)', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(30, 'EVP Execution', 'Employee Value Proposition (EVP)', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(31, 'EVP Application through Employer Branding', 'Employee Value Proposition (EVP)', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(32, 'International Mobility Policies', 'International Mobility', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(33, 'International Mobility Processes & Support Infrastructure', 'International Mobility', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', ''),
(34, 'International Organisation Capability', 'International Mobility', '2014-03-31 03:44:00', 'Pending', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_response`
--

CREATE TABLE IF NOT EXISTS `t_survey_response` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SURVEY` int(11) NOT NULL,
  `ID_COMPANY` varchar(250) NOT NULL,
  `NM_CATEGORY` varchar(250) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_response_dtl`
--

CREATE TABLE IF NOT EXISTS `t_survey_response_dtl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SURVEY` int(11) NOT NULL,
  `NM_CATEGORY` varchar(250) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=470 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_survey_response_hdr`
--

CREATE TABLE IF NOT EXISTS `t_survey_response_hdr` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COMPANY` varchar(250) CHARACTER SET utf8 NOT NULL,
  `DT_SURVEY_START` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DT_SURVEY_COMPLETE` timestamp NULL DEFAULT NULL,
  `INT_CAT1` float NOT NULL,
  `INT_CAT2` float NOT NULL,
  `INT_CAT3` float NOT NULL,
  `INT_CAT4` float NOT NULL,
  `INT_CAT5` float NOT NULL,
  `INT_CAT6` float NOT NULL,
  `INT_CAT7` float NOT NULL,
  `INT_CAT8` float NOT NULL,
  `INT_CAT9` float NOT NULL,
  `INT_CAT10` float NOT NULL,
  `INT_CAT11` float NOT NULL,
  `INT_PT` float NOT NULL,
  `TX_STATUS` varchar(250) CHARACTER SET utf8 NOT NULL DEFAULT 'Not Completed',
  `CONSULTANT_ID` int(11) NOT NULL,
  `INIT` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE IF NOT EXISTS `t_user` (
  `ID_USER` smallint(6) NOT NULL AUTO_INCREMENT,
  `ID_LOGIN` varchar(30) NOT NULL,
  `EN_PASSWORD` varchar(128) NOT NULL,
  `IN_ADMIN` bit(1) NOT NULL DEFAULT b'0',
  `IN_CONSULTANT` bit(1) NOT NULL DEFAULT b'0',
  `IN_USER` bit(1) NOT NULL DEFAULT b'0',
  `NM_ORGANISATION` varchar(50) NOT NULL,
  `NM_USER` varchar(30) NOT NULL,
  `TX_USEREMAIL` varchar(30) NOT NULL,
  `DT_LAST_LOGIN` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IN_ACTIVE` smallint(1) NOT NULL DEFAULT '0',
  `TX_ACTIVE_CODE` varchar(9) NOT NULL DEFAULT '000000000',
  `TX_SECURITY_CODE` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`),
  UNIQUE KEY `ID_USER` (`ID_USER`),
  UNIQUE KEY `ID_LOGIN` (`ID_LOGIN`),
  UNIQUE KEY `ID_LOGIN_2` (`ID_LOGIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`ID_USER`, `ID_LOGIN`, `EN_PASSWORD`, `IN_ADMIN`, `IN_CONSULTANT`, `IN_USER`, `NM_ORGANISATION`, `NM_USER`, `TX_USEREMAIL`, `DT_LAST_LOGIN`, `IN_ACTIVE`, `TX_ACTIVE_CODE`, `TX_SECURITY_CODE`) VALUES
(13, 'administrator', '4297f44b13955235245b2497399d7a93', b'1', b'0', b'0', '123123', '123123', 'phanquocgiam@gmail.com', '2014-04-29 10:13:27', 1, '578646D69', 'f752a9858dd6f6919e27bee85d519858'),
(14, 'iamuser', '4297f44b13955235245b2497399d7a93', b'0', b'0', b'1', '123123', '123123', 'ubuntu.server.sync@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(15, 'consultant', '4297f44b13955235245b2497399d7a93', b'0', b'1', b'0', '123123', '123123', 'ubuntu.server.amd64@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', 'f752a9858dd6f6919e27bee85d519858');

-- --------------------------------------------------------

--
-- Table structure for table `vwaccess_currentversion`
--

CREATE TABLE IF NOT EXISTS `vwaccess_currentversion` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ItemCode` int(11) NOT NULL,
  `AccessCode` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vwcomplimentaryitem_currentversion`
--

CREATE TABLE IF NOT EXISTS `vwcomplimentaryitem_currentversion` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `ItemCode` int(11) NOT NULL,
  `ItemDescription` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

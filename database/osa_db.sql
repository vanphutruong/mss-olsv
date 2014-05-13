-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 15, 2014 at 01:43 AM
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
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('52e777ded1a160e240b868502521e81d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36', 1397524800, 'a:1:{s:9:"user_data";s:0:"";}');

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
(2, 'EMAIL', 'FORGOT_ID', 'SUBJECT : GET ID', '<!DOCTYPE html>\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">\r\n  <head profile="http://www.w3.org/2000/08/w3c-synd/#">\r\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n    <style>\r\ntd {\r\n  font-family: arial;\r\n  font-size: small;\r\n}\r\n</style>\r\n    <title>Survey Online</title>\r\n    </head>\r\n    <body bgcolor="#ffffff" topmargin="20" marginwidth="0" marginheight="0">\r\n        \r\n        \r\n          <h3 align="center"><strong>Welcome Survey Online</strong>\r\n          </h3>\r\n          \r\n        <center>\r\n          <table width="609" height="51" style="border-width : 1px; border-style : solid; border-color: DarkGray;" cellpadding="0" cellspacing="0" bgcolor="#ffffff">\r\n    <tr>\r\n              <td bgcolor="#f4f7f9"><table width="100%%" cellpadding="5" cellspacing="5" bgcolor="#ffffff" border="0" align="center">\r\n                  <tr bgcolor="#cbd8de">\r\n                  <td align="center"><div align="center"><b> Request  Retrieve Username</b></div></td>\r\n                </tr>\r\n                  <tr bgcolor="#f4f7f9">\r\n                  <td height="120" valign="top"><table width="100%%" cellpadding="0" cellspacing="0" border="0">\r\n                      <tr>\r\n                      <td align="center"><p>There is an required prompted username up to your system Survey Online</p>\r\n                        <p>Your username : <strong>{ID_LOGIN} </strong></p>\r\n                        <p>&nbsp;</p>\r\n                        <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p></td>\r\n                    </tr>\r\n                      <tr>\r\n                      <td><table width="588" height="40">\r\n                          <tr>\r\n                          <td height="34"><div align="center">\r\n                            <p>\r\n                            <em>Thank you used services of Online Survey</em></p>\r\n                          </div></td>\r\n                        </tr>\r\n                        </table></td>\r\n                    </tr>\r\n                    </table></td>\r\n                </tr>\r\n                </table></td>\r\n            </tr>\r\n          </table>\r\n        </center>\r\n</body>\r\n</html>\r\n'),
(3, 'EMAIL', 'FORGOT_PASSWORD', 'SUBJECT : GET PASSWORD', '<!DOCTYPE html>\r\n<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">\r\n  <head profile="http://www.w3.org/2000/08/w3c-synd/#">\r\n    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />\r\n    <style>\r\ntd {\r\n  font-family: arial;\r\n  font-size: small;\r\n}\r\n</style>\r\n    <title>Survey Online</title>\r\n    </head>\r\n    <body bgcolor="#ffffff" topmargin="20" marginwidth="0" marginheight="0">\r\n        \r\n        \r\n          <h3 align="center"><strong>Welcome Survey Online</strong>\r\n          </h3>\r\n          \r\n        <center>\r\n          <table width="609" height="51" style="border-width : 1px; border-style : solid; border-color: DarkGray;" cellpadding="0" cellspacing="0" bgcolor="#ffffff">\r\n    <tr>\r\n              <td bgcolor="#f4f7f9"><table width="100%%" cellpadding="5" cellspacing="5" bgcolor="#ffffff" border="0" align="center">\r\n                  <tr bgcolor="#cbd8de">\r\n                  <td align="center"><div align="center"><b> Request  Retrieve Password</b></div></td>\r\n                </tr>\r\n                  <tr bgcolor="#f4f7f9">\r\n                  <td height="120" valign="top"><table width="100%%" cellpadding="0" cellspacing="0" border="0">\r\n                      <tr>\r\n                      <td align="center"><p>There is an required prompted pasword up to your system Survey Online</p>\r\n                        <p>Code Security : <strong>{TX_SECURITY_CODE}</strong> </p>\r\n                        <p>&nbsp;</p>\r\n                        <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a> to redirect change password page</p></td><br>\r\n                        <p>Or paste link to address bar :</p><em>{LINK_CHANGEPASSWORD}</em></td>\r\n                    </tr>\r\n                      <tr>\r\n                      <td></td>\r\n                    </tr>\r\n                      <tr>\r\n                      <td><table width="588" height="40">\r\n                          <tr>\r\n                          <td height="34"><div align="center">\r\n                            <p>\r\n                            <em>Thank you used services of Online Survey</em></p>\r\n                          </div></td>\r\n                        </tr>\r\n                        </table></td>\r\n                    </tr>\r\n                    </table></td>\r\n                </tr>\r\n                </table></td>\r\n            </tr>\r\n          </table>\r\n        </center>\r\n</body>\r\n</html>\r\n');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `t_company_info`
--

INSERT INTO `t_company_info` (`ID_COMPANY`, `NM_COMPANY`, `NM_RESPONDENT`, `NM_DESIGNATION`, `ID_FAMILY_OWNED`, `N_REVENUE`, `N_STAFF_SIZE`, `N_HR_SIZE`, `NM_INDUSTRY`, `NM_TYPE`, `TX_REMARKS`, `ID_CONSULTANT`, `ID_CONSULTANT_ORG`, `ID_GS1`, `ID_GS2`) VALUES
(26, 'BPOTECH_1', 'a', 's', 1, 26, 35, 42, '1', '15', '', 'consultant', 'consultant', 5, 10),
(27, 'BPOTECH_2', '2', 'nbv', 0, 34, 36, 43, '2', '16', 'c', 'consultant', 'consultant', 6, 8),
(28, 'BPOTECH_3', '3', '3', 1, 26, 38, 45, '4', '16', 'ccccccccccc', 'administrator', 'administrator', 5, 8),
(29, 'mamamam', 'a', 'a', 0, 26, 35, 42, '1', '15', '', 'administrator', 'administrator', 6, 10),
(30, 'company_type_list', 'company_type_list', 'company_type_list', 0, 26, 35, 42, '1', '15', '', 'consultant', 'consultant', 3, 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `t_growth_stage`
--

INSERT INTO `t_growth_stage` (`ID_GS`, `NM_TYPE`, `VALUE`) VALUES
(3, 'QUESTION_1', 'The company has demonstrated a workable business model but is concerned with the ability to generate enough cash to break even (or finance growth to a size that is sufficiently large) and to cover repair/replacement of capital assets as they wear out'),
(4, 'QUESTION_1', 'Company has healthy profits and the objective is to keep it stable without additional risks or investments'),
(5, 'QUESTION_1', 'Company has healthy profits and the objective is to consolidate, shore up financial resources so as to expand'),
(6, 'QUESTION_1', 'Company is investing and trying to satify the great strains on cash and operations that rapid growth brings'),
(7, 'QUESTION_1', 'Company has the advantages of size and financial resources but it trying to consolidate and control the financial gains while preserving its invovation and entrepreneurial spirit'),
(8, 'QUESTION_2', 'Owner does everything himsefl  including directly supervising subordinates'),
(9, 'QUESTION_2', 'Company has a GM and/or Sales Manager who does not make decisions independently but carries out well-defined orders by the owner'),
(10, 'QUESTION_2', 'Company has several functions managers in place to take over certain duties of the owner and professionals like a Financial Controller or Production Scheduler are brought in'),
(11, 'QUESTION_2', 'Professional managers ane in place and the owner can fully delegate responsibility to; owner showing willingness to tolerate mistakes and resists the urge to take back direct control when something goes wrong');

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
  `NM_CATEGORY` varchar(250) CHARACTER SET utf8 NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=205 ;

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
(36, 2, 'Recruitment', 2, 2),
(37, 2, 'Recruitment', 3, 2),
(38, 2, 'HR Management', 4, 2),
(39, 2, 'HR Management', 5, 1),
(40, 2, 'HR Management', 6, 1),
(41, 2, 'Manpower Planning', 7, 2),
(42, 2, 'Manpower Planning', 8, 1),
(43, 2, 'Manpower Planning', 9, 1),
(44, 2, 'Training & Development', 10, 1),
(45, 2, 'Training & Development', 11, 1),
(46, 2, 'Training & Development', 12, 2),
(47, 2, 'Training & Development', 13, 1),
(48, 2, 'Performance Management', 14, 2),
(49, 2, 'Performance Management', 15, 2),
(50, 2, 'Performance Management', 16, 1),
(51, 2, 'Performance Management', 17, 2),
(52, 2, 'Compensation & Benefits', 18, 2),
(53, 2, 'Compensation & Benefits', 19, 2),
(54, 2, 'Compensation & Benefits', 20, 2),
(55, 2, 'Talent Management & Succession Planning', 21, 1),
(56, 2, 'Talent Management & Succession Planning', 22, 1),
(57, 2, 'Talent Management & Succession Planning', 23, 1),
(58, 2, 'Organization Culture & Core Values', 24, 1),
(59, 2, 'Organization Culture & Core Values', 25, 1),
(60, 2, 'Organization Culture & Core Values', 26, 1),
(61, 2, 'Employee Engagement & Communications', 27, 1),
(62, 2, 'Employee Engagement & Communications', 28, 1),
(63, 2, 'Employee Value Proposition (EVP)', 29, 1),
(64, 2, 'Employee Value Proposition (EVP)', 30, 1),
(65, 2, 'Employee Value Proposition (EVP)', 31, 1),
(66, 2, 'International Mobility', 32, 1),
(67, 2, 'International Mobility', 33, 1),
(68, 2, 'International Mobility', 34, 1),
(69, 3, 'Recruitment', 1, 3),
(70, 3, 'Recruitment', 2, 3),
(71, 3, 'Recruitment', 3, 3),
(72, 3, 'HR Management', 4, 2),
(73, 3, 'HR Management', 5, 2),
(74, 3, 'HR Management', 6, 2),
(75, 3, 'Manpower Planning', 7, 3),
(76, 3, 'Manpower Planning', 8, 2),
(77, 3, 'Manpower Planning', 9, 2),
(78, 3, 'Training & Development', 10, 2),
(79, 3, 'Training & Development', 11, 2),
(80, 3, 'Training & Development', 12, 2),
(81, 3, 'Training & Development', 13, 2),
(82, 3, 'Performance Management', 14, 2),
(83, 3, 'Performance Management', 15, 2),
(84, 3, 'Performance Management', 16, 2),
(85, 3, 'Performance Management', 17, 3),
(86, 3, 'Compensation & Benefits', 18, 2),
(87, 3, 'Compensation & Benefits', 19, 2),
(88, 3, 'Compensation & Benefits', 20, 2),
(89, 3, 'Talent Management & Succession Planning', 21, 1),
(90, 3, 'Talent Management & Succession Planning', 22, 2),
(91, 3, 'Talent Management & Succession Planning', 23, 2),
(92, 3, 'Organization Culture & Core Values', 24, 2),
(93, 3, 'Organization Culture & Core Values', 25, 2),
(94, 3, 'Organization Culture & Core Values', 26, 2),
(95, 3, 'Employee Engagement & Communications', 27, 2),
(96, 3, 'Employee Engagement & Communications', 28, 2),
(97, 3, 'Employee Value Proposition (EVP)', 29, 2),
(98, 3, 'Employee Value Proposition (EVP)', 30, 2),
(99, 3, 'Employee Value Proposition (EVP)', 31, 2),
(100, 3, 'International Mobility', 32, 2),
(101, 3, 'International Mobility', 33, 2),
(102, 3, 'International Mobility', 34, 2),
(103, 4, 'Recruitment', 1, 3),
(104, 4, 'Recruitment', 2, 3),
(105, 4, 'Recruitment', 3, 3),
(106, 4, 'HR Management', 4, 2),
(107, 4, 'HR Management', 5, 2),
(108, 4, 'HR Management', 6, 2),
(109, 4, 'Manpower Planning', 7, 3),
(110, 4, 'Manpower Planning', 8, 3),
(111, 4, 'Manpower Planning', 9, 3),
(112, 4, 'Training & Development', 10, 2),
(113, 4, 'Training & Development', 11, 2),
(114, 4, 'Training & Development', 12, 2),
(115, 4, 'Training & Development', 13, 2),
(116, 4, 'Performance Management', 14, 3),
(117, 4, 'Performance Management', 15, 3),
(118, 4, 'Performance Management', 16, 3),
(119, 4, 'Performance Management', 17, 3),
(120, 4, 'Compensation & Benefits', 18, 3),
(121, 4, 'Compensation & Benefits', 19, 3),
(122, 4, 'Compensation & Benefits', 20, 3),
(123, 4, 'Talent Management & Succession Planning', 21, 2),
(124, 4, 'Talent Management & Succession Planning', 22, 3),
(125, 4, 'Talent Management & Succession Planning', 23, 3),
(126, 4, 'Organization Culture & Core Values', 24, 2),
(127, 4, 'Organization Culture & Core Values', 25, 2),
(128, 4, 'Organization Culture & Core Values', 26, 2),
(129, 4, 'Employee Engagement & Communications', 27, 2),
(130, 4, 'Employee Engagement & Communications', 28, 2),
(131, 4, 'Employee Value Proposition (EVP)', 29, 3),
(132, 4, 'Employee Value Proposition (EVP)', 30, 3),
(133, 4, 'Employee Value Proposition (EVP)', 31, 3),
(134, 4, 'International Mobility', 32, 3),
(135, 4, 'International Mobility', 33, 3),
(136, 4, 'International Mobility', 34, 3),
(137, 5, 'Recruitment', 1, 3),
(138, 5, 'Recruitment', 2, 3),
(139, 5, 'Recruitment', 3, 3),
(140, 5, 'HR Management', 4, 3),
(141, 5, 'HR Management', 5, 3),
(142, 5, 'HR Management', 6, 3),
(143, 5, 'Manpower Planning', 7, 3),
(144, 5, 'Manpower Planning', 8, 3),
(145, 5, 'Manpower Planning', 9, 3),
(146, 5, 'Training & Development', 10, 3),
(147, 5, 'Training & Development', 11, 3),
(148, 5, 'Training & Development', 12, 3),
(149, 5, 'Training & Development', 13, 3),
(150, 5, 'Performance Management', 14, 3),
(151, 5, 'Performance Management', 15, 3),
(152, 5, 'Performance Management', 16, 3),
(153, 5, 'Performance Management', 17, 3),
(154, 5, 'Compensation & Benefits', 18, 3),
(155, 5, 'Compensation & Benefits', 19, 3),
(156, 5, 'Compensation & Benefits', 20, 3),
(157, 5, 'Talent Management & Succession Planning', 21, 3),
(158, 5, 'Talent Management & Succession Planning', 22, 3),
(159, 5, 'Talent Management & Succession Planning', 23, 3),
(160, 5, 'Organization Culture & Core Values', 24, 3),
(161, 5, 'Organization Culture & Core Values', 25, 3),
(162, 5, 'Organization Culture & Core Values', 26, 3),
(163, 5, 'Employee Engagement & Communications', 27, 3),
(164, 5, 'Employee Engagement & Communications', 28, 3),
(165, 5, 'Employee Value Proposition (EVP)', 29, 3),
(166, 5, 'Employee Value Proposition (EVP)', 30, 3),
(167, 5, 'Employee Value Proposition (EVP)', 31, 3),
(168, 5, 'International Mobility', 32, 3),
(169, 5, 'International Mobility', 33, 3),
(170, 5, 'International Mobility', 34, 3),
(171, 6, 'Recruitment', 1, 4),
(172, 6, 'Recruitment', 2, 4),
(173, 6, 'Recruitment', 3, 4),
(174, 6, 'HR Management', 4, 4),
(175, 6, 'HR Management', 5, 4),
(176, 6, 'HR Management', 6, 4),
(177, 6, 'Manpower Planning', 7, 4),
(178, 6, 'Manpower Planning', 8, 4),
(179, 6, 'Manpower Planning', 9, 4),
(180, 6, 'Training & Development', 10, 4),
(181, 6, 'Training & Development', 11, 4),
(182, 6, 'Training & Development', 12, 4),
(183, 6, 'Training & Development', 13, 4),
(184, 6, 'Performance Management', 14, 4),
(185, 6, 'Performance Management', 15, 4),
(186, 6, 'Performance Management', 16, 4),
(187, 6, 'Performance Management', 17, 4),
(188, 6, 'Compensation & Benefits', 18, 4),
(189, 6, 'Compensation & Benefits', 19, 4),
(190, 6, 'Compensation & Benefits', 20, 4),
(191, 6, 'Talent Management & Succession Planning', 21, 4),
(192, 6, 'Talent Management & Succession Planning', 22, 4),
(193, 6, 'Talent Management & Succession Planning', 23, 4),
(194, 6, 'Organization Culture & Core Values', 24, 4),
(195, 6, 'Organization Culture & Core Values', 25, 4),
(196, 6, 'Organization Culture & Core Values', 26, 4),
(197, 6, 'Employee Engagement & Communications', 27, 4),
(198, 6, 'Employee Engagement & Communications', 28, 4),
(199, 6, 'Employee Value Proposition (EVP)', 29, 4),
(200, 6, 'Employee Value Proposition (EVP)', 30, 4),
(201, 6, 'Employee Value Proposition (EVP)', 31, 4),
(202, 6, 'International Mobility', 32, 4),
(203, 6, 'International Mobility', 33, 4),
(204, 6, 'International Mobility', 34, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=375 ;

--
-- Dumping data for table `t_survey_response`
--

INSERT INTO `t_survey_response` (`ID`, `ID_SURVEY`, `ID_COMPANY`, `NM_CATEGORY`, `ID_QUESTION`, `ID_ANSWER`) VALUES
(171, 12, 'BPOTECH_3', 'Recruitment', 1, 1),
(172, 12, 'BPOTECH_3', 'Recruitment', 2, 6),
(173, 12, 'BPOTECH_3', 'Recruitment', 3, 10),
(174, 12, 'BPOTECH_3', 'HR Management', 4, 13),
(175, 12, 'BPOTECH_3', 'HR Management', 5, 18),
(176, 12, 'BPOTECH_3', 'HR Management', 6, 21),
(177, 12, 'BPOTECH_3', 'Manpower Planning', 7, 28),
(178, 12, 'BPOTECH_3', 'Manpower Planning', 8, 32),
(179, 12, 'BPOTECH_3', 'Manpower Planning', 9, 35),
(180, 12, 'BPOTECH_3', 'Training & Development', 10, 38),
(181, 12, 'BPOTECH_3', 'Training & Development', 11, 44),
(182, 12, 'BPOTECH_3', 'Training & Development', 12, 47),
(183, 12, 'BPOTECH_3', 'Training & Development', 13, 50),
(184, 12, 'BPOTECH_3', 'Performance Management', 14, 55),
(185, 12, 'BPOTECH_3', 'Performance Management', 15, 58),
(186, 12, 'BPOTECH_3', 'Performance Management', 16, 64),
(187, 12, 'BPOTECH_3', 'Performance Management', 17, 67),
(188, 12, 'BPOTECH_3', 'Compensation & Benefits', 18, 70),
(189, 12, 'BPOTECH_3', 'Compensation & Benefits', 19, 76),
(190, 12, 'BPOTECH_3', 'Compensation & Benefits', 20, 79),
(191, 12, 'BPOTECH_3', 'Talent Management & Succession Planning', 21, 84),
(192, 12, 'BPOTECH_3', 'Talent Management & Succession Planning', 22, 85),
(193, 12, 'BPOTECH_3', 'Talent Management & Succession Planning', 23, 91),
(194, 12, 'BPOTECH_3', 'Organization Culture & Core Values', 24, 96),
(195, 12, 'BPOTECH_3', 'Organization Culture & Core Values', 25, 100),
(196, 12, 'BPOTECH_3', 'Organization Culture & Core Values', 26, 104),
(197, 12, 'BPOTECH_3', 'Employee Engagement & Communications', 27, 108),
(198, 12, 'BPOTECH_3', 'Employee Engagement & Communications', 28, 112),
(199, 12, 'BPOTECH_3', 'Employee Value Proposition (EVP)', 29, 115),
(200, 12, 'BPOTECH_3', 'Employee Value Proposition (EVP)', 30, 118),
(201, 12, 'BPOTECH_3', 'Employee Value Proposition (EVP)', 31, 121),
(202, 12, 'BPOTECH_3', 'International Mobility', 32, 127),
(203, 12, 'BPOTECH_3', 'International Mobility', 33, 130),
(204, 12, 'BPOTECH_3', 'International Mobility', 34, 134),
(205, 11, 'BPOTECH_2', 'Recruitment', 1, 4),
(206, 11, 'BPOTECH_2', 'Recruitment', 2, 8),
(207, 11, 'BPOTECH_2', 'Recruitment', 3, 12),
(208, 11, 'BPOTECH_2', 'HR Management', 4, 16),
(209, 11, 'BPOTECH_2', 'HR Management', 5, 20),
(210, 11, 'BPOTECH_2', 'HR Management', 6, 24),
(211, 11, 'BPOTECH_2', 'Manpower Planning', 7, 28),
(212, 11, 'BPOTECH_2', 'Manpower Planning', 8, 32),
(213, 11, 'BPOTECH_2', 'Manpower Planning', 9, 36),
(214, 11, 'BPOTECH_2', 'Training & Development', 10, 40),
(215, 11, 'BPOTECH_2', 'Training & Development', 11, 44),
(216, 11, 'BPOTECH_2', 'Training & Development', 12, 48),
(217, 11, 'BPOTECH_2', 'Training & Development', 13, 52),
(218, 11, 'BPOTECH_2', 'Performance Management', 14, 56),
(219, 11, 'BPOTECH_2', 'Performance Management', 15, 60),
(220, 11, 'BPOTECH_2', 'Performance Management', 16, 64),
(221, 11, 'BPOTECH_2', 'Performance Management', 17, 68),
(222, 11, 'BPOTECH_2', 'Compensation & Benefits', 18, 72),
(223, 11, 'BPOTECH_2', 'Compensation & Benefits', 19, 76),
(224, 11, 'BPOTECH_2', 'Compensation & Benefits', 20, 80),
(225, 11, 'BPOTECH_2', 'Talent Management & Succession Planning', 21, 84),
(226, 11, 'BPOTECH_2', 'Talent Management & Succession Planning', 22, 88),
(227, 11, 'BPOTECH_2', 'Talent Management & Succession Planning', 23, 92),
(228, 11, 'BPOTECH_2', 'Organization Culture & Core Values', 24, 96),
(229, 11, 'BPOTECH_2', 'Organization Culture & Core Values', 25, 100),
(230, 11, 'BPOTECH_2', 'Organization Culture & Core Values', 26, 104),
(231, 11, 'BPOTECH_2', 'Employee Engagement & Communications', 27, 108),
(232, 11, 'BPOTECH_2', 'Employee Engagement & Communications', 28, 112),
(233, 11, 'BPOTECH_2', 'Employee Value Proposition (EVP)', 29, 113),
(234, 11, 'BPOTECH_2', 'Employee Value Proposition (EVP)', 30, 117),
(235, 11, 'BPOTECH_2', 'Employee Value Proposition (EVP)', 31, 121),
(236, 11, 'BPOTECH_2', 'International Mobility', 32, 125),
(237, 11, 'BPOTECH_2', 'International Mobility', 33, 129),
(238, 11, 'BPOTECH_2', 'International Mobility', 34, 135),
(341, 10, 'BPOTECH_1', 'Recruitment', 1, 1),
(342, 10, 'BPOTECH_1', 'Recruitment', 2, 6),
(343, 10, 'BPOTECH_1', 'Recruitment', 3, 12),
(344, 10, 'BPOTECH_1', 'HR Management', 4, 14),
(345, 10, 'BPOTECH_1', 'HR Management', 5, 18),
(346, 10, 'BPOTECH_1', 'HR Management', 6, 22),
(347, 10, 'BPOTECH_1', 'Manpower Planning', 7, 28),
(348, 10, 'BPOTECH_1', 'Manpower Planning', 8, 32),
(349, 10, 'BPOTECH_1', 'Manpower Planning', 9, 36),
(350, 10, 'BPOTECH_1', 'Training & Development', 10, 40),
(351, 10, 'BPOTECH_1', 'Training & Development', 11, 44),
(352, 10, 'BPOTECH_1', 'Training & Development', 12, 48),
(353, 10, 'BPOTECH_1', 'Training & Development', 13, 52),
(354, 10, 'BPOTECH_1', 'Performance Management', 14, 53),
(355, 10, 'BPOTECH_1', 'Performance Management', 15, 58),
(356, 10, 'BPOTECH_1', 'Performance Management', 16, 61),
(357, 10, 'BPOTECH_1', 'Performance Management', 17, 66),
(358, 10, 'BPOTECH_1', 'Compensation & Benefits', 18, 69),
(359, 10, 'BPOTECH_1', 'Compensation & Benefits', 19, 73),
(360, 10, 'BPOTECH_1', 'Compensation & Benefits', 20, 78),
(361, 10, 'BPOTECH_1', 'Talent Management & Succession Planning', 21, 81),
(362, 10, 'BPOTECH_1', 'Talent Management & Succession Planning', 22, 86),
(363, 10, 'BPOTECH_1', 'Talent Management & Succession Planning', 23, 90),
(364, 10, 'BPOTECH_1', 'Organization Culture & Core Values', 24, 94),
(365, 10, 'BPOTECH_1', 'Organization Culture & Core Values', 25, 98),
(366, 10, 'BPOTECH_1', 'Organization Culture & Core Values', 26, 102),
(367, 10, 'BPOTECH_1', 'Employee Engagement & Communications', 27, 106),
(368, 10, 'BPOTECH_1', 'Employee Engagement & Communications', 28, 110),
(369, 10, 'BPOTECH_1', 'Employee Value Proposition (EVP)', 29, 113),
(370, 10, 'BPOTECH_1', 'Employee Value Proposition (EVP)', 30, 117),
(371, 10, 'BPOTECH_1', 'Employee Value Proposition (EVP)', 31, 121),
(372, 10, 'BPOTECH_1', 'International Mobility', 32, 125),
(373, 10, 'BPOTECH_1', 'International Mobility', 33, 129),
(374, 10, 'BPOTECH_1', 'International Mobility', 34, 134);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=223 ;

--
-- Dumping data for table `t_survey_response_dtl`
--

INSERT INTO `t_survey_response_dtl` (`ID`, `ID_SURVEY`, `NM_CATEGORY`, `ID_QUESTION`, `ID_ANSWER`) VALUES
(1, 11, 'Recruitment', 1, 4),
(4, 15, 'Recruitment', 1, 1),
(5, 11, 'Recruitment', 2, 8),
(33, 11, 'Recruitment', 3, 12),
(34, 11, 'HR Management', 4, 16),
(35, 11, 'HR Management', 5, 20),
(36, 11, 'HR Management', 6, 24),
(78, 11, 'Manpower Planning', 7, 28),
(79, 11, 'Manpower Planning', 8, 32),
(80, 11, 'Manpower Planning', 9, 36),
(81, 11, 'Training & Development', 10, 40),
(82, 11, 'Training & Development', 11, 44),
(83, 11, 'Training & Development', 12, 48),
(84, 11, 'Training & Development', 13, 52),
(85, 11, 'Performance Management', 14, 56),
(86, 11, 'Performance Management', 15, 60),
(87, 11, 'Performance Management', 16, 64),
(88, 11, 'Performance Management', 17, 68),
(89, 11, 'Compensation & Benefits', 18, 72),
(90, 11, 'Compensation & Benefits', 19, 76),
(91, 11, 'Compensation & Benefits', 20, 80),
(92, 11, 'Talent Management & Succession Planning', 21, 84),
(93, 11, 'Talent Management & Succession Planning', 22, 88),
(94, 11, 'Talent Management & Succession Planning', 23, 92),
(95, 11, 'Organization Culture & Core Values', 24, 96),
(96, 11, 'Organization Culture & Core Values', 25, 100),
(97, 11, 'Organization Culture & Core Values', 26, 104),
(98, 11, 'Employee Engagement & Communications', 27, 108),
(99, 11, 'Employee Engagement & Communications', 28, 112),
(100, 11, 'Employee Value Proposition (EVP)', 29, 113),
(101, 11, 'Employee Value Proposition (EVP)', 30, 117),
(102, 11, 'Employee Value Proposition (EVP)', 31, 121),
(103, 11, 'International Mobility', 32, 125),
(104, 11, 'International Mobility', 33, 129),
(150, 10, 'Recruitment', 1, 1),
(151, 10, 'Recruitment', 2, 6),
(152, 10, 'Recruitment', 3, 12),
(153, 10, 'HR Management', 4, 14),
(154, 10, 'HR Management', 5, 18),
(155, 10, 'HR Management', 6, 22),
(156, 10, 'Manpower Planning', 7, 28),
(157, 10, 'Manpower Planning', 8, 32),
(158, 10, 'Manpower Planning', 9, 36),
(159, 10, 'Training & Development', 10, 40),
(160, 10, 'Training & Development', 11, 44),
(161, 10, 'Training & Development', 12, 48),
(165, 11, 'International Mobility', 34, 133),
(166, 10, 'Training & Development', 13, 52),
(167, 10, 'Performance Management', 14, 53),
(168, 10, 'Performance Management', 15, 58),
(169, 10, 'Performance Management', 16, 61),
(170, 10, 'Performance Management', 17, 66),
(171, 10, 'Compensation & Benefits', 18, 69),
(172, 10, 'Compensation & Benefits', 19, 73),
(173, 10, 'Compensation & Benefits', 20, 78),
(174, 10, 'Talent Management & Succession Planning', 21, 81),
(175, 10, 'Talent Management & Succession Planning', 22, 86),
(176, 10, 'Talent Management & Succession Planning', 23, 90),
(177, 10, 'Organization Culture & Core Values', 24, 94),
(178, 10, 'Organization Culture & Core Values', 25, 98),
(179, 10, 'Organization Culture & Core Values', 26, 102),
(180, 10, 'Employee Engagement & Communications', 27, 106),
(181, 10, 'Employee Engagement & Communications', 28, 110),
(182, 10, 'Employee Value Proposition (EVP)', 29, 113),
(183, 10, 'Employee Value Proposition (EVP)', 30, 117),
(184, 10, 'Employee Value Proposition (EVP)', 31, 121),
(185, 10, 'International Mobility', 32, 125),
(186, 10, 'International Mobility', 33, 129),
(189, 12, 'Recruitment', 2, 6),
(190, 12, 'Recruitment', 3, 10),
(191, 12, 'HR Management', 4, 13),
(192, 12, 'HR Management', 5, 18),
(193, 12, 'HR Management', 6, 21),
(194, 12, 'Manpower Planning', 7, 28),
(195, 12, 'Manpower Planning', 8, 32),
(196, 12, 'Manpower Planning', 9, 35),
(197, 12, 'Training & Development', 10, 38),
(198, 12, 'Training & Development', 11, 44),
(199, 12, 'Training & Development', 12, 47),
(200, 12, 'Training & Development', 13, 50),
(201, 12, 'Performance Management', 14, 55),
(202, 12, 'Performance Management', 15, 58),
(203, 12, 'Performance Management', 16, 64),
(204, 12, 'Performance Management', 17, 67),
(205, 12, 'Compensation & Benefits', 18, 70),
(206, 12, 'Compensation & Benefits', 19, 76),
(207, 12, 'Compensation & Benefits', 20, 79),
(208, 12, 'Talent Management & Succession Planning', 21, 84),
(209, 12, 'Talent Management & Succession Planning', 22, 85),
(210, 12, 'Talent Management & Succession Planning', 23, 91),
(211, 12, 'Organization Culture & Core Values', 24, 96),
(212, 12, 'Organization Culture & Core Values', 25, 100),
(213, 12, 'Organization Culture & Core Values', 26, 104),
(214, 12, 'Employee Engagement & Communications', 27, 108),
(215, 12, 'Employee Engagement & Communications', 28, 112),
(216, 12, 'Employee Value Proposition (EVP)', 29, 115),
(217, 12, 'Employee Value Proposition (EVP)', 30, 118),
(218, 12, 'Employee Value Proposition (EVP)', 31, 121),
(219, 12, 'International Mobility', 32, 127),
(220, 12, 'International Mobility', 33, 130),
(222, 12, 'Recruitment', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `t_survey_response_hdr`
--

INSERT INTO `t_survey_response_hdr` (`ID_SURVEY`, `ID_COMPANY`, `DT_SURVEY_START`, `DT_SURVEY_COMPLETE`, `INT_CAT1`, `INT_CAT2`, `INT_CAT3`, `INT_CAT4`, `INT_CAT5`, `INT_CAT6`, `INT_CAT7`, `INT_CAT8`, `INT_CAT9`, `INT_CAT10`, `INT_CAT11`, `INT_PT`, `TX_STATUS`, `CONSULTANT_ID`, `INIT`) VALUES
(10, 'BPOTECH_1', '2014-04-08 04:33:38', '2014-04-14 02:11:15', 2.3, 2, 4, 4, 1.5, 1.3, 1.7, 2, 2, 1, 1.3, 2.1, 'Not Completed', 2, 0),
(11, 'BPOTECH_2', '2014-04-07 07:38:51', '2014-04-10 07:04:23', 4, 4, 4, 4, 4, 4, 4, 4, 4, 1, 1, 3, 'Completed', 2, 0),
(12, 'BPOTECH_3', '2014-04-10 07:11:34', '2014-04-08 17:00:00', 2, 1, 4, 3, 3, 3, 3, 4, 4, 2, 2, 3, 'Completed', 1, 0),
(14, 'mamamam', '2014-04-01 06:18:59', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Not Completed', 1, 1),
(15, 'company_type_list', '2014-04-02 04:28:19', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Not Completed', 2, 0);

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
  `IN_FORGOT_PASSWORD` smallint(1) NOT NULL DEFAULT '0',
  `TX_ACTIVE_CODE` varchar(9) NOT NULL DEFAULT '000000000',
  PRIMARY KEY (`ID_USER`),
  UNIQUE KEY `ID_USER` (`ID_USER`),
  UNIQUE KEY `ID_LOGIN` (`ID_LOGIN`),
  UNIQUE KEY `ID_LOGIN_2` (`ID_LOGIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`ID_USER`, `ID_LOGIN`, `EN_PASSWORD`, `IN_ADMIN`, `IN_CONSULTANT`, `IN_USER`, `NM_ORGANISATION`, `NM_USER`, `TX_USEREMAIL`, `DT_LAST_LOGIN`, `IN_ACTIVE`, `IN_FORGOT_PASSWORD`, `TX_ACTIVE_CODE`) VALUES
(1, 'administrator', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'admin', 'admin', 'admin@admin.com', '2014-04-15 01:15:09', 1, 0, '000000000'),
(2, 'consultant', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'consultant', 'consultant', 'consultant@consultant.com', '2014-04-10 01:11:48', 1, 0, '000000000'),
(3, 'demouser', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'user', 'user', 'user@user.com', '2014-04-10 01:17:51', 1, 0, '000000000'),
(4, 'test', '12345', b'0', b'0', b'1', 'TEST', 'TEST', '', '2014-03-20 02:22:21', 0, 0, '000000000'),
(6, 'test1', '1234', b'0', b'0', b'1', 'TEST', 'TEST', '', '2014-03-20 02:23:50', 0, 0, '000000000'),
(7, 'test21', '12345', b'0', b'0', b'1', 'TEST', 'TEST', '', '2014-03-20 03:10:53', 0, 0, '000000000'),
(9, 'test211', '12345', b'0', b'0', b'1', 'TEST', 'TEST', '', '2014-03-20 03:11:38', 0, 0, '000000000'),
(10, '123123', '4297f44b13955235245b2497399d7a93', b'0', b'0', b'1', '123123', '123123', 'hoangminhquan90@gmail.com', '2014-03-29 03:57:37', 0, 0, 'E80550143'),
(11, '123123123', '4297f44b13955235245b2497399d7a93', b'0', b'0', b'1', '123123', '123123', 'hoangminhquan90@gmail.com', '2014-03-29 03:58:51', 0, 0, '44FD3F8E4'),
(12, 'hoangminhquan', '4297f44b13955235245b2497399d7a93', b'0', b'0', b'1', '123123', '123123', 'hoangminhquan90@gmail.com', '2014-03-29 04:01:48', 1, 0, '99499092C');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

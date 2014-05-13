##GIAMPQ
##01/05/2014##
## Add table ci_sessions ##

CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);

##Change script End##

##GIAMPQ
##31/03/2014##
## Add table email_template  and Dumping data##

CREATE TABLE IF NOT EXISTS `email_template` (
  `ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(100) NOT NULL,
  `TEMPLATE_KEY` varchar(100) NOT NULL,
  `TEMPLATE_SUBJECT` varchar(100),
  `TEMPLATE_BODY` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Email templae using active accout, forgot password/id , report....' AUTO_INCREMENT=4 ;

DELETE FROM `email_template`

INSERT INTO `email_template` (`ID`, `TYPE`, `TEMPLATE_KEY`, `TEMPLATE_SUBJECT`, `TEMPLATE_BODY`) VALUES
(1, 'EMAIL', 'ACTIVE_ACCOUNT', 'ACTIVE ACCOUNT', ''),
(2, 'EMAIL', 'FORGOT_ID', 'SUBJECT : GET ID', '<!DOCTYPE html>
<html>
<head>
<title>HAY GROUP COMPANY</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
@media only screen and (max-width: 660px) {
table[class=w0], td[class=w0] {
  width: 0 !important;
}
table[class=w10], td[class=w10], img[class=w10] {
  width: 10px !important;
}
table[class=w15], td[class=w15], img[class=w15] {
  width: 5px !important;
}
table[class=w30], td[class=w30], img[class=w30] {
  width: 10px !important;
}
table[class=w60], td[class=w60], img[class=w60] {
  width: 10px !important;
}
table[class=w125], td[class=w125], img[class=w125] {
  width: 80px !important;
}
table[class=w130], td[class=w130], img[class=w130] {
  width: 55px !important;
}
table[class=w140], td[class=w140], img[class=w140] {
  width: 90px !important;
}
table[class=w160], td[class=w160], img[class=w160] {
  width: 180px !important;
}
table[class=w170], td[class=w170], img[class=w170] {
  width: 100px !important;
}
table[class=w180], td[class=w180], img[class=w180] {
  width: 80px !important;
}
table[class=w195], td[class=w195], img[class=w195] {
  width: 80px !important;
}
table[class=w220], td[class=w220], img[class=w220] {
  width: 80px !important;
}
table[class=w240], td[class=w240], img[class=w240] {
  width: 180px !important;
}
table[class=w255], td[class=w255], img[class=w255] {
  width: 185px !important;
}
table[class=w275], td[class=w275], img[class=w275] {
  width: 135px !important;
}
table[class=w280], td[class=w280], img[class=w280] {
  width: 135px !important;
}
table[class=w300], td[class=w300], img[class=w300] {
  width: 140px !important;
}
table[class=w325], td[class=w325], img[class=w325] {
  width: 95px !important;
}
table[class=w360], td[class=w360], img[class=w360] {
  width: 140px !important;
}
table[class=w410], td[class=w410], img[class=w410] {
  width: 180px !important;
}
table[class=w470], td[class=w470], img[class=w470] {
  width: 200px !important;
}
table[class=w580], td[class=w580], img[class=w580] {
  width: 280px !important;
}
table[class=w640], td[class=w640], img[class=w640] {
  width: 300px !important;
}
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {
  display: none !important;
}
table[class=h0], td[class=h0] {
  height: 0 !important;
}
p[class=footer-content-left] {
  text-align: center !important;
}
#headline p {
  font-size: 30px !important;
}
.article-content, #left-sidebar {
  -webkit-text-size-adjust: 90% !important;
  -ms-text-size-adjust: 90% !important;
}
.header-content, .footer-content-left {
  -webkit-text-size-adjust: 80% !important;
  -ms-text-size-adjust: 80% !important;
}
img {
  height: auto;
  line-height: 100%;
}
}
#outlook a {
  padding: 0;
}
body {
  width: 100% !important;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
  display: block !important;
}
body {
  background-color: #c7c7c7;
  margin: 0;
  padding: 0;
}
img {
  outline: none;
  text-decoration: none;
  display: block;
}
br, strong br, b br, em br, i br {
  line-height: 100%;
}
h1, h2, h3, h4, h5, h6 {
  line-height: 100% !important;
  -webkit-font-smoothing: antialiased;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: blue !important;
}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
  color: red !important;
}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
  color: purple !important;
}
table td, table tr {
  border-collapse: collapse;
}
.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black;
  text-decoration: none !important;
  border-bottom: none !important;
  background: none !important;
}
code {
  white-space: normal;
  word-break: break-all;
}
#background-table {
  background-color: #c7c7c7;
}
#top-bar {
  border-radius: 6px 6px 0px 0px;
  -moz-border-radius: 6px 6px 0px 0px;
  -webkit-border-radius: 6px 6px 0px 0px;
  -webkit-font-smoothing: antialiased;
  background-color: #2E2E2E;
  color: #888888;
}
#top-bar a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#footer {
  border-radius: 0px 0px 6px 6px;
  -moz-border-radius: 0px 0px 6px 6px;
  -webkit-border-radius: 0px 0px 6px 6px;
  -webkit-font-smoothing: antialiased;
}
body, td {
  font-family: HelveticaNeue, sans-serif;
}
.header-content, .footer-content-left, .footer-content-right {
  -webkit-text-size-adjust: none;
  -ms-text-size-adjust: none;
}
.header-content {
  font-size: 12px;
  color: #888888;
}
.header-content a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#headline p {
  color: #000c8f;
  font-family: HelveticaNeue, sans-serif;
  font-size: 36px;
  text-align: center;
  margin-top: 0px;
  margin-bottom: 30px;
}
#headline p a {
  color: #000c8f;
  text-decoration: none;
}
.article-title {
  font-size: 18px;
  line-height: 24px;
  color: #0f0080;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-title a {
  color: #0f0080;
  text-decoration: none;
}
.article-title.with-meta {
  margin-bottom: 0;
}
.article-meta {
  font-size: 13px;
  line-height: 20px;
  color: #ccc;
  font-weight: bold;
  margin-top: 0;
}
.article-content {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-content a {
  color: #2f82de;
  font-weight: bold;
  text-decoration: none;
}
.article-content img {
  max-width: 100%
}
.article-content ol, .article-content ul {
  margin-top: 0px;
  margin-bottom: 18px;
  margin-left: 19px;
  padding: 0;
}
.article-content li {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
}
.article-content li a {
  color: #2f82de;
  text-decoration: underline;
}
.article-content p {
  margin-bottom: 15px;
}
.footer-content-left {
  font-size: 12px;
  line-height: 15px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-left a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
.footer-content-right {
  font-size: 11px;
  line-height: 16px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-right a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
#footer {
  background-color: #000000;
  color: #888888;
}
#footer a {
  color: #eeeeee;
  text-decoration: none;
  font-weight: bold;
}
#permission-reminder {
  white-space: normal;
}
#street-address {
  color: #ffffff;
  white-space: normal;
}
#email-footer{
    width: 1024 px !important;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="10222" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px !important;
   padding: 0 !important;
   list-style-position: inside !important;
}
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta property="og:title" content="Hay Group">
</head>
<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
  <tbody>
    <tr style="border-collapse:collapse;">
      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
          <tbody>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>
                        </div>
                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;"> </tr>
                          </tbody>
                        </table>
                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>
                        </div></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr id="simple-content-row" style="border-collapse:collapse;">
              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request  Retrieve Username</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi, 
                                <p>You or someone has sent request reminded username,</p>
                                </br>
                                <p>Username: <strong>{ID_LOGIN}</strong></p>
                                </br>
                                <p>Click<a href="{LINK_LOGIN}"><em> Here </em></a>to login</p>
                                <p>if you are not requirement, please ignore email of this, Thanks you</p>
                                </div>
                              </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">
                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">
                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                        </span>
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
'),
(3, 'EMAIL', 'FORGOT_PASSWORD', 'SUBJECT : GET PASSWORD', '<!DOCTYPE html>
<html>
<head>
<title>HAY GROUP COMPANY</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=320, target-densitydpi=device-dpi">
<style type="text/css">
@media only screen and (max-width: 660px) {
table[class=w0], td[class=w0] {
  width: 0 !important;
}
table[class=w10], td[class=w10], img[class=w10] {
  width: 10px !important;
}
table[class=w15], td[class=w15], img[class=w15] {
  width: 5px !important;
}
table[class=w30], td[class=w30], img[class=w30] {
  width: 10px !important;
}
table[class=w60], td[class=w60], img[class=w60] {
  width: 10px !important;
}
table[class=w125], td[class=w125], img[class=w125] {
  width: 80px !important;
}
table[class=w130], td[class=w130], img[class=w130] {
  width: 55px !important;
}
table[class=w140], td[class=w140], img[class=w140] {
  width: 90px !important;
}
table[class=w160], td[class=w160], img[class=w160] {
  width: 180px !important;
}
table[class=w170], td[class=w170], img[class=w170] {
  width: 100px !important;
}
table[class=w180], td[class=w180], img[class=w180] {
  width: 80px !important;
}
table[class=w195], td[class=w195], img[class=w195] {
  width: 80px !important;
}
table[class=w220], td[class=w220], img[class=w220] {
  width: 80px !important;
}
table[class=w240], td[class=w240], img[class=w240] {
  width: 180px !important;
}
table[class=w255], td[class=w255], img[class=w255] {
  width: 185px !important;
}
table[class=w275], td[class=w275], img[class=w275] {
  width: 135px !important;
}
table[class=w280], td[class=w280], img[class=w280] {
  width: 135px !important;
}
table[class=w300], td[class=w300], img[class=w300] {
  width: 140px !important;
}
table[class=w325], td[class=w325], img[class=w325] {
  width: 95px !important;
}
table[class=w360], td[class=w360], img[class=w360] {
  width: 140px !important;
}
table[class=w410], td[class=w410], img[class=w410] {
  width: 180px !important;
}
table[class=w470], td[class=w470], img[class=w470] {
  width: 200px !important;
}
table[class=w580], td[class=w580], img[class=w580] {
  width: 280px !important;
}
table[class=w640], td[class=w640], img[class=w640] {
  width: 300px !important;
}
table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] {
  display: none !important;
}
table[class=h0], td[class=h0] {
  height: 0 !important;
}
p[class=footer-content-left] {
  text-align: center !important;
}
#headline p {
  font-size: 30px !important;
}
.article-content, #left-sidebar {
  -webkit-text-size-adjust: 90% !important;
  -ms-text-size-adjust: 90% !important;
}
.header-content, .footer-content-left {
  -webkit-text-size-adjust: 80% !important;
  -ms-text-size-adjust: 80% !important;
}
img {
  height: auto;
  line-height: 100%;
}
}
#outlook a {
  padding: 0;
}
body {
  width: 100% !important;
}
.ReadMsgBody {
  width: 100%;
}
.ExternalClass {
  width: 100%;
  display: block !important;
}
body {
  background-color: #c7c7c7;
  margin: 0;
  padding: 0;
}
img {
  outline: none;
  text-decoration: none;
  display: block;
}
br, strong br, b br, em br, i br {
  line-height: 100%;
}
h1, h2, h3, h4, h5, h6 {
  line-height: 100% !important;
  -webkit-font-smoothing: antialiased;
}
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
  color: blue !important;
}
h1 a:active, h2 a:active, h3 a:active, h4 a:active, h5 a:active, h6 a:active {
  color: red !important;
}
h1 a:visited, h2 a:visited, h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
  color: purple !important;
}
table td, table tr {
  border-collapse: collapse;
}
.yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
  color: black;
  text-decoration: none !important;
  border-bottom: none !important;
  background: none !important;
}
code {
  white-space: normal;
  word-break: break-all;
}
#background-table {
  background-color: #c7c7c7;
}
#top-bar {
  border-radius: 6px 6px 0px 0px;
  -moz-border-radius: 6px 6px 0px 0px;
  -webkit-border-radius: 6px 6px 0px 0px;
  -webkit-font-smoothing: antialiased;
  background-color: #2E2E2E;
  color: #888888;
}
#top-bar a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#footer {
  border-radius: 0px 0px 6px 6px;
  -moz-border-radius: 0px 0px 6px 6px;
  -webkit-border-radius: 0px 0px 6px 6px;
  -webkit-font-smoothing: antialiased;
}
body, td {
  font-family: HelveticaNeue, sans-serif;
}
.header-content, .footer-content-left, .footer-content-right {
  -webkit-text-size-adjust: none;
  -ms-text-size-adjust: none;
}
.header-content {
  font-size: 12px;
  color: #888888;
}
.header-content a {
  font-weight: bold;
  color: #eeeeee;
  text-decoration: none;
}
#headline p {
  color: #000c8f;
  font-family: HelveticaNeue, sans-serif;
  font-size: 36px;
  text-align: center;
  margin-top: 0px;
  margin-bottom: 30px;
}
#headline p a {
  color: #000c8f;
  text-decoration: none;
}
.article-title {
  font-size: 18px;
  line-height: 24px;
  color: #0f0080;
  font-weight: bold;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-title a {
  color: #0f0080;
  text-decoration: none;
}
.article-title.with-meta {
  margin-bottom: 0;
}
.article-meta {
  font-size: 13px;
  line-height: 20px;
  color: #ccc;
  font-weight: bold;
  margin-top: 0;
}
.article-content {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
  margin-top: 0px;
  margin-bottom: 18px;
  font-family: HelveticaNeue, sans-serif;
}
.article-content a {
  color: #2f82de;
  font-weight: bold;
  text-decoration: none;
}
.article-content img {
  max-width: 100%
}
.article-content ol, .article-content ul {
  margin-top: 0px;
  margin-bottom: 18px;
  margin-left: 19px;
  padding: 0;
}
.article-content li {
  font-size: 13px;
  line-height: 18px;
  color: #444444;
}
.article-content li a {
  color: #2f82de;
  text-decoration: underline;
}
.article-content p {
  margin-bottom: 15px;
}
.footer-content-left {
  font-size: 12px;
  line-height: 15px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-left a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
.footer-content-right {
  font-size: 11px;
  line-height: 16px;
  color: #888888;
  margin-top: 0px;
  margin-bottom: 15px;
}
.footer-content-right a {
  color: #eeeeee;
  font-weight: bold;
  text-decoration: none;
}
#footer {
  background-color: #000000;
  color: #888888;
}
#footer a {
  color: #eeeeee;
  text-decoration: none;
  font-weight: bold;
}
#permission-reminder {
  white-space: normal;
}
#street-address {
  color: #ffffff;
  white-space: normal;
}
#email-footer{
    width: 1024 px !important;
}
</style>
<!--[if gte mso 9]>
<style _tmplitem="10222" >
.article-content ol, .article-content ul {
   margin: 0 0 0 24px !important;
   padding: 0 !important;
   list-style-position: inside !important;
}
</style>
<![endif]-->
<meta name="robots" content="noindex,nofollow">
<meta property="og:title" content="Hay Group">
</head>
<body style="width:100% !important;background-color:#c7c7c7;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;font-family:HelveticaNeue, sans-serif;">
<table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="background-color:#c7c7c7;">
  <tbody>
    <tr style="border-collapse:collapse;">
      <td align="center" bgcolor="#c7c7c7" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0" style="margin-top:0;margin-bottom:0;margin-right:10px;margin-left:10px;">
          <tbody>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="20" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:6px 6px 0px 0px;-moz-border-radius:6px 6px 0px 0px;-webkit-border-radius:6px 6px 0px 0px;-webkit-font-smoothing:antialiased;background-color:#2E2E2E;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w325" width="350" valign="middle" align="left" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <div class="header-content" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;color:#888888;"><a href="{HOME_PAGE}" style="font-weight:bold;color:#eeeeee;text-decoration:none;">Home Page</a><span class="hide">&nbsp;&nbsp;|&nbsp;</span>
                        </div>
                        <table class="w325" width="350" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w325" width="350" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w255" width="255" valign="middle" align="right" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table>
                        <table cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;"> </tr>
                          </tbody>
                        </table>
                        <table class="w255" width="255" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w255" width="255" height="8" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w15" width="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td id="header" class="w640" width="640" align="center" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><div align="center" id="headline">
                          <p style="color:#000c8f;font-family:HelveticaNeue, sans-serif;font-size:36px;text-align:center;margin-top:0px;margin-bottom:30px;"> <strong><a href="http://vietnam.createsend1.com/t/d-l-fjhkky-l-d/" style="color:#000c8f;text-decoration:none;">Hay Group Company</a></strong> </p>
                        </div></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="30" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr id="simple-content-row" style="border-collapse:collapse;">
              <td class="w640" width="640" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table align="left" class="w640" width="640" cellpadding="0" cellspacing="0" border="0">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table class="w580" width="580" cellpadding="0" cellspacing="0" border="0">
                          <tbody>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><p align="left" class="article-title" style="font-size:18px;line-height:24px;color:#0f0080;font-weight:bold;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Request Retrieve Password</p>
                                <div align="left" class="article-content" style="font-size:14px;line-height:14px;color:#444444;margin-top:0px;margin-bottom:18px;font-family:HelveticaNeue, sans-serif;">Hi <strong>{TX_USERNAME}</strong>, 
                                <p>You have requested to reset the password for the following account:</p>
                                </br>
                                <p>Username: <strong>{TX_USERNAME}</strong></p>
                                </br>
                                 <p>Generated Password: <strong>{TX_SECURITY_CODE}</strong></p>
                                <p>Click<a href="{LINK_CHANGEPASSWORD}"><em> Here </em></a>to auto login and go to change password</p>
                                <p>To reset the password, please go to the <a href="{LOGIN_PAGE}"><em> login page </em></a> and login with the given password. Upon login, you will be prompted to reset your password. Thank you.</p>
                                </div>
                              </td>
                            </tr>
                            <tr style="border-collapse:collapse;">
                              <td class="w580" width="580" height="10" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                            </tr>
                          </tbody>
                        </table></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="15" bgcolor="#ffffff" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000" style="border-radius:0px 0px 6px 6px;-moz-border-radius:0px 0px 6px 6px;-webkit-border-radius:0px 0px 6px 6px;-webkit-font-smoothing:antialiased;background-color:#000000;color:#888888;">
                  <tbody>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w0" width="160" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;padding-left: 20px;"></td>
                      <td class="w580" width="90%" valign="top" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"><span class="hide">
                        <p id="permission-reminder" align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;white-space:normal;"><span>About Hay Group</span><br style="line-height:100%;">
                          <span>Hay Group is a global management consulting firm that works with leaders to transform strategy into reality. We develop talent, organize people to be more effective and motivate them to perform at their best.</span></p>
                        </span>
                        <p align="left" class="footer-content-left" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;font-size:12px;line-height:15px;color:#888888;margin-top:0px;margin-bottom:15px;"><a href="#">{ALT_BODY}</a> |</p></td>
                    </tr>
                    <tr style="border-collapse:collapse;">
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w580 h0" width="360" height="15" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                      <td class="w30" width="30" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr style="border-collapse:collapse;">
              <td class="w640" width="640" height="60" style="font-family:HelveticaNeue, sans-serif;border-collapse:collapse;"></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
');

##Change script End##


##GIAMPQ##
##01/03/2014##
##Table structure for table `t_survey_response_hdr`##

CREATE TABLE IF NOT EXISTS `t_survey_response_hdr` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COMPANY` int(11) NOT NULL,
  `DT_SURVEY_START` datetime NOT NULL,
  `DT_SURVEY_COMPLETE` datetime DEFAULT NULL,
  `INT_CAT1` int(11) NOT NULL,
  `INT_CAT2` int(11) NOT NULL,
  `INT_CAT3` int(11) NOT NULL,
  `INT_CAT4` int(11) NOT NULL,
  `INT_CAT5` int(11) NOT NULL,
  `INT_CAT6` int(11) NOT NULL,
  `INT_CAT7` int(11) NOT NULL,
  `INT_CAT8` int(11) NOT NULL,
  `INT_CAT9` int(11) NOT NULL,
  `INT_CAT10` int(11) NOT NULL,
  `INT_CAT11` int(11) NOT NULL,
  `INT_PT` int(11) NOT NULL,
  `TX_STATUS` varchar(250) NOT NULL,
  `CONSULTANT_ID` text NOT NULL,
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##


##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_option`##

CREATE TABLE IF NOT EXISTS `t_survey_option` (
  `ID_OPTION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  `NM_ANSWER` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_OPTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##


##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_response`##

CREATE TABLE IF NOT EXISTS `t_survey_response` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COMPANY` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##

##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_response_dtl`##

CREATE TABLE IF NOT EXISTS `t_survey_response_dtl` (
  `ID_SURVEY` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CATEGORY` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_ANSWER` int(11) NOT NULL,
  PRIMARY KEY (`ID_SURVEY`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

##Change script End##

##GIAMPQ##
##01/05/2014##
##Table structure for table `t_survey_benchmark_hdr`##

CREATE TABLE IF NOT EXISTS `t_survey_benchmark_hdr` (
  `ID_MATURITY` int(11) NOT NULL AUTO_INCREMENT,
  `NM_CATEGORY` varchar(250) NOT NULL,
  `INT_CAT` int(11) NOT NULL,
  PRIMARY KEY (`ID_MATURITY`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

##Change script End##

##GIAMPQ##
##01/05/2014##
##Change data for table `t_survey_benchmark_hdr`##
--
-- Delete data for table `t_dropdown`
--

DELETE FROM `t_dropdown`;

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

##Change script End##


##GIAMPQ##
##01/05/2014##
##Add data for table `t_user`##

DELETE FROM `t_user`

INSERT INTO `t_user` (`ID_USER`, `ID_LOGIN`, `EN_PASSWORD`, `IN_ADMIN`, `IN_CONSULTANT`, `IN_USER`, `NM_ORGANISATION`, `NM_USER`, `TX_USEREMAIL`, `DT_LAST_LOGIN`, `IN_ACTIVE`, `TX_ACTIVE_CODE`, `TX_SECURITY_CODE`) VALUES
(1, 'ADMINISTRATOR', 'e10adc3949ba59abbe56e057f20f883e', b'1', b'0', b'0', 'HAY GROUP ', 'ADMINISTRATOR', 'phanquocgiam@gmail.com', '2014-05-01 10:35:14', 1, '578646D69', 'b737e210185e346700603865bad905d9'),
(2, 'USERNORMAL', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'0', b'1', 'HAY GROUP', 'USERNORMAL', 'ubuntu.server.sync@gmail.com', '2014-04-28 01:06:22', 1, 'F9BCBB53F', NULL),
(3, 'CONSULTANT', 'e10adc3949ba59abbe56e057f20f883e', b'0', b'1', b'0', 'HAY GROUP', 'CONSULTANT', 'ubuntu.server.amd64@gmail.com', '2014-04-29 10:14:18', 1, '578646D69', 'f752a9858dd6f6919e27bee85d519858');



##Change script End##
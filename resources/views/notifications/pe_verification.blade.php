<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>A Simple Responsive HTML Email</title>
    <style type="text/css">
    body {margin: 0; padding: 0; min-width: 100%!important;}
    img {height: auto;}
    .content {width: 100%; max-width: 1200px;}
    .header {padding: 40px 30px 20px 30px;}
    .innerpadding {padding: 30px 30px 30px 30px;}
    .borderbottom {border-bottom: 1px solid #f2eeed;}
    .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;}
    .h2, .bodycopy {color: #153643; font-family: sans-serif;}
    .h1 {font-size: 33px; line-height: 38px; font-weight: bold; color: #e5f2ff}
    .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;}
    .bodycopy {font-size: 16px; line-height: 22px;}
    .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;}
    .button a {color: #ffffff; text-decoration: none;}
    .footer {padding: 20px 30px 15px 30px;}
    .footercopy {font-family: sans-serif; font-size: 14px; color: #ffffff;}
    .footercopy a {color: #ffffff; text-decoration: underline;}
    @media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
    body[yahoo] .hide {display: none!important;}
    body[yahoo] .buttonwrapper {background-color: transparent!important;}
    body[yahoo] .button {padding: 0px!important;}
    body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
    body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
    }
    body {
    color: #153643;
    padding:0px;
    }
    /*@media only screen and (min-device-width: 601px) {
    .content {width: 600px !important;}
    .col425 {width: 425px!important;}
    .col380 {width: 380px!important;}
    }*/
    th {
    background-color:#800000;
    color:#ffffff;
    border: 1px solid black;
    }
    </style>
  </head>
  <body yahoo bgcolor="#f6f8f1">
    <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td>
          <!--[if (gte mso 9)|(IE)]>
          <table width="800" align="center" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td>
                <![endif]-->
                <table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" border="0">
                  <tr>
                    <td bgcolor="#800000" class="header">
                      <!--[if (gte mso 9)|(IE)]>
                      <table width="525" align="left" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td>
                            <![endif]-->
                            <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 425px;">
                              <tr>
                                <td height="70">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td class="subhead" style="padding: 0 0 0 3px;">
                                        QDN
                                      </td>
                                    </tr>
                                    <tr>
                                      <td class="h1" style="padding: 5px 0 0 0;">
                                        Quality Deviation Notice
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                          </td>
                        </tr>
                      </table>
                      <![endif]-->
                    </td>
                  </tr>
                  <tr>
                    <td class="innerpadding borderbottom bodycopy">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td class="h2">
                            Below is the list of PIPs Candidates for your review and approval!
                          </td>
                        </tr>
                        <tr>
                          <td class="bodycopy">
                            <table style="border-collapse: collapse;border: 1px solid black;">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Description</th>
                                  <th>Station</th>
                                  <th>Failure Mode</th>
                                  <th>Category</th>
                                  <th>Status</th>
                                  <th>Timestamps</th>
                                </tr>
                              </thead>
                              <tbody>
                                <td style="border: 1px solid black;">{{ $qdn->control_id }}</td>
                                <td style="border: 1px solid black;">{{ Str::title($qdn->problem_description) }}</td>
                                <td style="border: 1px solid black;">{{ Str::upper($qdn->station) }}</td>
                                <td style="border: 1px solid black;">{{ Str::title($qdn->failure_mode) }}</td>
                                <td style="border: 1px solid black;">{{ Str::title($qdn->discrepancy_category) }}</td>
                                <td style="border: 1px solid black;">{{ Str::title($qdn->closure->status) }}</td>
                                <td style="border: 1px solid black;">{{ $qdn->updated_at }}</td>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td class="innerpadding borderbottom">
                      <!--[if (gte mso 9)|(IE)]>
                      <table width="380" align="left" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                          <td>
                            <![endif]-->
                            <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;">
                              <tr>
                                <td>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td class="bodycopy">
                                        {{ $qdn->msg }}
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                         {{ "- ".$qdn->closure->pe_verified_by }}
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="padding: 20px 0 0 0;">
                                        <table class="buttonwrapper" bgcolor="#e05443" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td class="button" height="45">
                                              <a href="#">Visit the page!</a>
                                            </td>
                                          </tr>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                          </td>
                        </tr>
                      </table>
                      <![endif]-->
                    </td>
                  </tr>
                  <tr>
                    <td class="footer" bgcolor="#222222">
                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center" class="footercopy">
                            &reg; Telford Services Philippines, Incorporation {{ date('Y') }}<br/>
                            <span class="hide">Maintained by QA Department. For any queries</span>
                            <a href="mailto:robinson.legaspi@astigp.com" class="unsubscribe"><font color="#ffffff">Email me</font></a>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
              </td>
            </tr>
          </table>
          <![endif]-->
        </td>
      </tr>
    </table>
  </body>
</html>
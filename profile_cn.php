<?php
session_start();
// profile.php
// php first edited by ian
include("includes/config.inc.php");

// we do function for checking the status id
function checkstatusid($statusid)
{
  if ($statusid == 1) {
    return "Student (Full-time)";
  }
  if ($statusid == 2) {
    return "Grad Student";
  }
  if ($statusid == 3) {
    return "Alumnus/Alumna";
  }
  if ($statusid == 4) {
    return "Faculity";
  }
  if ($statusid == 5) {
    return "Staff";
  }
  if ($statusid == 6) {
    return "✓ Developer";
  }
  //status 7
  if ($statusid == 7) {
    return "✓ Staff";
  } else {
    return "Status error";
  }
}
// we do function to check SEX

function checksex($sex)
{
  if ($sex == 0) {
    return "Not set";
  }
  if ($sex == 1) {
    return "Male";
  }
  if ($sex == 2) {
    return "Female";
  }
  if ($sex == 3) {
    return "Not applicable";
  } else {
    return "N/A";
  }
}
if (isset($_GET['id'])) {
  $uid = $_GET['id'];
  // check see if id is valid
  $checkvalidid = $conn->prepare("SELECT * FROM fuckbook_users WHERE id = ?");
  $checkvalidid->bind_param("i", $uid);
  $checkvalidid->execute();
  $checkidres = $checkvalidid->get_result();

  if ($checkidres->num_rows > 0) {
    // now id is valid
    // set vars for stuff below
    while ($row = $checkidres->fetch_assoc()) {
      $user_name = $row['username'];
      $user_email = $row['email'];
      $user_status = $row['status'];
      $user_date = $row['date'];
    }
  } else {
    //redirect to 404(temp)
    header("Location: 404.php");
  }

  // we get additional information(if applicable)
  $getbasicinfo = $conn->prepare("SELECT * FROM fuckbook_profiles WHERE id = ?");
  $getbasicinfo->bind_param("i", $uid);
  $getbasicinfo->execute();
  $getbasicres = $getbasicinfo->get_result();

  if ($getbasicres->num_rows > 0) {
    while ($row = $getbasicres->fetch_assoc()) {
      if (is_null($row['school'])) {
        $get_school = "N/A";
      } else {
        $get_school = $row['school'];
      }
      if (is_null($row['sex'])) {
        $get_sex = "N/A";
      } else {
        $get_sex = $row['sex'];
      }
      if (is_null($row['birthday'])) {
        $get_bday = "N/A";
      } else {
        $get_bday = $row['birthday'];
      }
      if (is_null($row['hometown'])) {
        $get_hometown = "N/A";
      } else {
        $get_hometown = $row['hometown'];
      }
      if (is_null($row['highschool'])) {
        $get_highschool = "N/A";
      } else {
        $get_highschool = $row['highschool'];
      }
    }
  }
  // now we do get for contact
  // this section is quite smol
  $getcontactinfo = $conn->prepare("SELECT * FROM fuckbook_profiles WHERE id = ?");
  $getcontactinfo->bind_param("i", $uid);
  $getcontactinfo->execute();
  $getcontactres = $getcontactinfo->get_result();

  if ($getcontactres->num_rows > 0) {
    while ($row = $getcontactres->fetch_assoc()) {
      if (is_null($row['screenname'])) {
        $get_screenname = "N/A";
      } else {
        $get_screenname = $row['screenname'];
      }
    }
    if (is_null($row['mobile'])) {
      $get_mobile = "N/A";
    } else {
      $get_mobile = $row['mobile'];
    }
  }
} else {
  // nothing was set in the id field
  // putting this here first, later will redirect to user's own page
  if (isset($_SESSION['id'])) {
    header("Location: profile.php?id=" . $_SESSION['id']);
  } else {
    header("Location: 404.php");
  }
}
?>
<html>

<head>
  <title>高书 | 欢迎来到高书！</title>
  <link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" href="favicon.ico">
  <?php //where charset??? 
  ?>
  <meta charset="utf-8">
</head>

<body>
  <center>
    <table class="bordertable" cellspacing="0" cellpadding="0" border="0" width="700">
      <tbody>
        <tr>
          <td>
            <?php require("header.php"); ?>
          </td>
        </tr>
        <tr>
          <td>
            <table cellspacing="0" cellpadding="2" border="0" width="100%">
              <tbody>
                <tr>
                  <td valign="top">
                    <table cellspacing="0" cellpadding="0" border="0" width="105">
                      <tbody>
                        <tr>
                          <td>
                            <?php include("sidebar.php"); ?>
                          </td>
                        </tr>


                      </tbody>
                    </table>
                  </td>
                  <td width="595" valign="top">
                    <table class="bordertable" width="100%" cellspacing="0" cellpadding="0" border="1">
                      <tbody>
                        <tr>
                          <td>
                            <table width="100%" cellspacing="0" cellpadding="2" border="0">
                              <tbody>
                                <tr>
                                  <td class="white" bgcolor="#3B5998">
                                    <?php echo htmlspecialchars($user_name); ?>的主页
                                  </td>
                                  <table width="100%" cellspacing="2" cellpadding="2" border="0">
                                    <tbody>
                                      <tr>
                                        <td valign=top>
                                          <table class='bordertable' cellspacing=0 cellpadding=0 width=100%>
                                            <tr>
                                              <td>
                                                <table cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                    <td class='white' bgcolor=#3B5998 colspan=2>
                                                      照片
                                                    </td>
                                                  </tr>
                                                </table>
                                                <br>
                                                <center>
                                                  <table cellspacing=0 cellpadding=2 border=0 width=95%>
                                                    <tr>
                                                      <td align=center>
                                                        <p>N/A</p>
                                                      </td>
                                                    </tr>
                                                  </table>
                                              </td>
                                            </tr>
                                          </table>
                                          <br>
                                          <table class='bordertable' cellspacing=0 cellpadding=0 width=100% valign=top>
                                            <tr>
                                              <td>
                                                <table class='bottomborder' cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                    <td>
                                                      <a href="friends.php">看看我的好友</a>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <table class='bottomborder' cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <table class='bottomborder' cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                    <td>
                                                      <a href="account.php">我的账号设置</a>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <table cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                    <td>
                                                      <a href="privacy.php">我的隐私设置</a>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                          <br>
                                          <table class='bordertable' cellspacing=0 cellpadding=0 width=100% valign=top>
                                            <tr>
                                              <td>
                                                <table cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                    <td class='white' bgcolor=#3B5998>
                                                      关系
                                                    </td>
                                                  </tr>
                                                </table>
                                                <table cellspacing=0 cellpadding=2 border=0 width=95% align=center>
                                                  <tr>
                                                    <td align=center>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                          <br>
                                          <table class='bordertable' cellspacing=0 cellpadding=0 width=100% valign=top>
                                            <tr>
                                              <td>
                                                <table cellspacing=0 cellpadding=2 border=0 width=100%>
                                                  <tr>
                                                    <td class='white' bgcolor=#3B5998 colspan=2>
                                                      木屋下的好友
                                                    </td>
                                                  </tr>
                                                </table>
                                                &nbsp;<br>
                                                <center>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                        <td>
                                          <table cellspacing=0 cellpadding=2 border=0 width=100%>
                                            <tr>
                                              <td class='white' bgcolor=#3B5998 colspan=2>
                                                个人资料
                                              </td>
                                            </tr>
                                          </table>

                                          <table class='bordertable' cellspacing=0 cellpadding=2 border=0 width=100%>
                                            <tr>
                                              <td>
                                                <table cellspacing=0 cellpadding=0 border=0>
                                                  <tr>
                                                    <td><?php
                                                        if (isset($_SESSION['userid'])) {
                                                          if ($_SESSION['userid'] == $uid) {
                                                            echo "<p style='text-align:Center'><a href='edit_profile.php?id=" . $_SESSION['userid'] . "'>[ Edit ]</a></p>";
                                                          } else {
                                                            echo "";
                                                          }
                                                        }
                                                        ?></td>
                                                  </tr>
                                                  <tr>
                                                  <tr>
                                                    <td>
                                                      <table cellspacing=0 cellpadding=2 border=0>
                                                        <tr>
                                                          <td colspan=2>
                                                            <b>账号资料:</b>
                                                          </td>

                                                        </tr>
                                                        <tr>
                                                          <td style="width:104px">
                                                            姓名:
                                                          </td>
                                                          <td style="width:187px">
                                                            <?php echo htmlspecialchars($user_name); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            账号创建日期:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($user_date); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            最上一次跟新:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        <tr>
                                                        <tr>

                                                          <td>
                                                            <b>基本资料:</b>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td>
                                                            学校:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($get_school); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            状态:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars(checkstatusid($user_status)); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            性别:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars(checksex($get_sex)); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            生日:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($get_bday); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            家乡:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($get_hometown); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            中学:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($get_highschool); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>

                                                          <td>
                                                            <b>联系资料:</b>
                                                          </td>

                                                        </tr>
                                                        <tr>
                                                          <td>
                                                            电邮:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($user_email); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            昵称:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($get_screenname); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            手提电话:
                                                          </td>
                                                          <td>
                                                            <?php echo htmlspecialchars($get_mobile); ?>
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            <b>个人资料:</b>
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td>
                                                            正在寻找:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            感兴趣的东西:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            感情状态:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            政治立场:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            兴趣:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        <tr>
                                                        <tr>
                                                          <td>
                                                            音乐:
                                                          </td>
                                                          <td>
                                                            N/A
                                                          </td>
                                                        </tr>
                                                      </table>
                                                    </td>
                                                  </tr>
                                                </table>
                                              </td>
                                            </tr>
                                          </table>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <?php require("footer.php"); ?><br>
                  </td>
                </tr>
              </tbody>
            </table>

          </td>
        </tr>
      </tbody>
    </table>

    <br>
    </td>
    </tr>
    </tbody>
    </table><br>

  </center>
</body>

</html>
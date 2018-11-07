<?php
session_start();
unset($_SESSION['g1_graph']);
unset($_SESSION['g2_graph']);
unset($_SESSION['g3_graph']);
unset($_SESSION['vals']);
unset($_SESSION['periods']);
unset($_SESSION['title']);

$conn = new mysqli('pluto.cse.msstate.edu', 'jgb272', 'Winston22', 'jgb272');
if ($conn->connect_error)
  die($conn->connect_error);

$data = $conn->query("SELECT * FROM gmt_students");

$periods = false;
if (isset($_POST['periods'])) {
  $periods = true;
}
$_SESSION['periods'] = $periods;

$param = 'NO_PARAM';

$res1 = array(0);
$res2 = array(0);
$res3 = array(0);

if (isset($_POST['internet'])) {
  $param = 'internet';
  $vals = array('Has Access', 'No Access');
  $counts = array(0, 0);
  $sums1 = array(0, 0);
  $sums2 = array(0, 0);
  $sums3 = array(0, 0);
  while ($stu = $data->fetch_array()) {
    if ($stu['internet'] == 'yes') {
      $counts[0] = $counts[0]+1;
      if ($periods) {
        $sums1[0] = $sums1[0]+$stu['G1'];
        $sums2[0] = $sums2[0]+$stu['G2'];
      }
      $sums3[0] = $sums3[0]+$stu['G3'];
    } elseif ($stu['internet'] == 'no') {
      $counts[1] = $counts[1]+1;
      if ($periods) {
        $sums1[1] = $sums1[1]+$stu['G1'];
        $sums2[1] = $sums2[1]+$stu['G2'];
      }
      $sums3[1] = $sums3[1]+$stu['G3'];
    }
  }
  if ($periods) {
    $res1 = array($sums1[0]/$counts[0], $sums1[1]/$counts[1]);
    $res2 = array($sums2[0]/$counts[0], $sums2[1]/$counts[1]);
  }
  $res3 = array($sums3[0]/$counts[0], $sums3[1]/$counts[1]);

} elseif (isset($_POST['failures'])) {
  $param = 'failures';
  $vals = array('0', '1', '2', '3', '4+');
  $counts = array(0, 0, 0, 0, 0);
  $sums1 = array(0, 0, 0, 0, 0);
  $sums2 = array(0, 0, 0, 0, 0);
  $sums3 = array(0, 0, 0, 0, 0);
  while ($stu = $data->fetch_array()) {
    if ($stu['failures'] == 0) {
      $counts[0] = $counts[0]+1;
      if ($periods) {
        $sums1[0] = $sums1[0]+$stu['G1'];
        $sums2[0] = $sums2[0]+$stu['G2'];
      }
      $sums3[0] = $sums3[0]+$stu['G3'];
    } elseif ($stu['failures'] == 1) {
      $counts[1] = $counts[1]+1;
      if ($periods) {
        $sums1[1] = $sums1[1]+$stu['G1'];
        $sums2[1] = $sums2[1]+$stu['G2'];
      }
      $sums3[1] = $sums3[1]+$stu['G3'];
    } elseif ($stu['failures'] == 2) {
      $counts[2] = $counts[2]+1;
      if ($periods) {
        $sums1[2] = $sums1[2]+$stu['G1'];
        $sums2[2] = $sums2[2]+$stu['G2'];
      }
      $sums3[2] = $sums3[2]+$stu['G3'];
    } elseif ($stu['failures'] == 3) {
      $counts[3] = $counts[3]+1;
      if ($periods) {
        $sums1[3] = $sums1[3]+$stu['G1'];
        $sums2[3] = $sums2[3]+$stu['G2'];
      }
      $sums3[3] = $sums3[3]+$stu['G3'];
    } elseif ($stu['failures'] >= 4) {
      echo "4";
      $counts[4] = $counts[4]+1;
      if ($periods) {
        $sums1[4] = $sums1[4]+$stu['G1'];
        $sums2[4] = $sums2[4]+$stu['G2'];
      }
      $sums3[4] = $sums3[4]+$stu['G3'];
    }
  }
  if ($periods) {
    $res1 = array($sums1[0]/$counts[0], $sums1[1]/$counts[1], $sums1[2]/$counts[2], $sums1[3]/$counts[3], $sums1[4]/$counts[4]);
    $res2 = array($sums2[0]/$counts[0], $sums2[1]/$counts[1], $sums2[2]/$counts[2], $sums2[3]/$counts[3], $sums2[4]/$counts[4]);
  }
  $res3 = array($sums3[0]/$counts[0], $sums3[1]/$counts[1], $sums3[2]/$counts[2], $sums3[3]/$counts[3], $sums3[4]/$counts[4]);

} elseif (isset($_POST['studytime'])) {
  $param = 'studytime';
  $vals = array('<2 hrs', '2 - 5 hrs', '5 - 10 hrs', '>10 hrs');
  $counts = array(0, 0, 0, 0);
  $sums1 = array(0, 0, 0, 0);
  $sums2 = array(0, 0, 0, 0);
  $sums3 = array(0, 0, 0, 0);
  while ($stu = $data->fetch_array()) {
    if ($stu['studytime'] == 1) {
      $counts[0] += 1;
      if ($periods) {
        $sums1[0] += $stu['G1'];
        $sums2[0] += $stu['G2'];
      }
      $sums3[0] += $stu['G3'];
    } elseif ($stu['studytime'] == 2) {
      $counts[1] += 1;
      if ($periods) {
        $sums1[1] += $stu['G1'];
        $sums2[1] += $stu['G2'];
      }
      $sums3[1] += $stu['G3'];
    } elseif ($stu['studytime'] == 3) {
      $counts[2] += 1;
      if ($periods) {
        $sums1[2] += $stu['G1'];
        $sums2[2] += $stu['G2'];
      }
      $sums3[2] += $stu['G3'];
    } elseif ($stu['studytime'] == 4) {
      $counts[3] += 1;
      if ($periods) {
        $sums1[3] += $stu['G1'];
        $sums2[3] += $stu['G2'];
      }
      $sums3[3] += $stu['G3'];
    }
  }
  if ($periods) {
    $res1 = array($sums1[0]/$counts[0], $sums1[1]/$counts[1], $sums1[2]/$counts[2], $sums1[3]/$counts[3]);
    $res2 = array($sums2[0]/$counts[0], $sums2[1]/$counts[1], $sums2[2]/$counts[2], $sums2[3]/$counts[3]);
  }
  $res3 = array($sums3[0]/$counts[0], $sums3[1]/$counts[1], $sums3[2]/$counts[2], $sums3[3]/$counts[3]);

} elseif (isset($_POST['absences'])) {
  $param = 'absences';
  $vals = array('0-19', '20-39', '40-59', '60-79', '80-99');
  $counts = array(0, 0, 0, 0, 0);
  $sums1 = array(0, 0, 0, 0, 0);
  $sums2 = array(0, 0, 0, 0, 0);
  $sums3 = array(0, 0, 0, 0, 0);
  while ($stu = $data->fetch_array()) {
    if ($stu['absences'] < 20) {
      $counts[0] += 1;
      if ($periods) {
        $sums1[0] += $stu['G1'];
        $sums2[0] += $stu['G2'];
      }
      $sums3[0] += $stu['G3'];
    } elseif ($stu['absences'] >= 20 && $stu['absences'] < 40) {
      $counts[1] += 1;
      if ($periods) {
        $sums1[1] += $stu['G1'];
        $sums2[1] += $stu['G2'];
      }
      $sums3[1] += $stu['G3'];
    } elseif ($stu['absences'] >= 40 && $stu['absences'] < 60) {
      $counts[2] += 1;
      if ($periods) {
        $sums1[2] += $stu['G1'];
        $sums2[2] += $stu['G2'];
      }
      $sums3[2] += $stu['G3'];
    } elseif ($stu['absences'] >= 40 && $stu['absences'] < 80) {
      $counts[3] += 1;
      if ($periods) {
        $sums1[3] += $stu['G1'];
        $sums2[3] += $stu['G2'];
      }
      $sums3[3] += $stu['G3'];
    } elseif ($stu['absences'] >= 80) {
      $counts[4] += 1;
      if ($periods) {
        $sums1[4] += $stu['G1'];
        $sums2[4] += $stu['G2'];
      }
      $sums3[4] += $stu['G3'];
    }
  }
  if ($periods) {
    $res1 = array($sums1[0]/$counts[0], $sums1[1]/$counts[1], $sums1[2]/$counts[2], $sums1[3]/$counts[3], $sums1[4]/$counts[4]);
    $res2 = array($sums2[0]/$counts[0], $sums2[1]/$counts[1], $sums2[2]/$counts[2], $sums2[3]/$counts[3], $sums2[4]/$counts[4]);
  }
  $res3 = array($sums3[0]/$counts[0], $sums3[1]/$counts[1], $sums3[2]/$counts[2], $sums3[3]/$counts[3], $sums3[4]/$counts[4]);

} elseif (isset($_POST['health'])) {
  $param = 'health';
  $vals = array('Very Bad', 'Bad', 'Average', 'Good', 'Very Good');
  $counts = array(0, 0, 0, 0, 0);
  $sums1 = array(0, 0, 0, 0, 0);
  $sums2 = array(0, 0, 0, 0, 0);
  $sums3 = array(0, 0, 0, 0, 0);
  while ($stu = $data->fetch_array()) {
    if ($stu['health'] == 1) {
      $counts[0] += 1;
      if ($periods) {
        $sums1[0] += $stu['G1'];
        $sums2[0] += $stu['G2'];
      }
      $sums3[0] += $stu['G3'];
    } elseif ($stu['health'] == 2) {
      $counts[1] += 1;
      if ($periods) {
        $sums1[1] += $stu['G1'];
        $sums2[1] += $stu['G2'];
      }
      $sums3[1] += $stu['G3'];
    } elseif ($stu['health'] == 3) {
      $counts[2] += 1;
      if ($periods) {
        $sums1[2] += $stu['G1'];
        $sums2[2] += $stu['G2'];
      }
      $sums3[2] += $stu['G3'];
    } elseif ($stu['health'] == 4) {
      $counts[3] += 1;
      if ($periods) {
        $sums1[3] += $stu['G1'];
        $sums2[3] += $stu['G2'];
      }
      $sums3[3] += $stu['G3'];
    } elseif ($stu['health'] == 5) {
      $counts[4] += 1;
      if ($periods) {
        $sums1[4] += $stu['G1'];
        $sums2[4] += $stu['G2'];
      }
      $sums3[4] += $stu['G3'];
    }
  }
  if ($periods) {
    $res1 = array($sums1[0]/$counts[0], $sums1[1]/$counts[1], $sums1[2]/$counts[2], $sums1[3]/$counts[3], $sums1[4]/$counts[4]);
    $res2 = array($sums2[0]/$counts[0], $sums2[1]/$counts[1], $sums2[2]/$counts[2], $sums2[3]/$counts[3], $sums2[4]/$counts[4]);
  }
  $res3 = array($sums3[0]/$counts[0], $sums3[1]/$counts[1], $sums3[2]/$counts[2], $sums3[3]/$counts[3], $sums3[4]/$counts[4]);
} elseif (isset($_POST['traveltime'])) {
  $param = 'traveltime';
  $vals = array('<15 min', '15 - 30 min', '30 min - 1 hr', '>1 hr');
  $counts = array(0, 0, 0, 0);
  $sums1 = array(0, 0, 0, 0);
  $sums2 = array(0, 0, 0, 0);
  $sums3 = array(0, 0, 0, 0);
  while ($stu = $data->fetch_array()) {
    if ($stu['traveltime'] == 1) {
      $counts[0] += 1;
      if ($periods) {
        $sums1[0] += $stu['G1'];
        $sums2[0] += $stu['G2'];
      }
      $sums3[0] += $stu['G3'];
    } elseif ($stu['traveltime'] == 2) {
      $counts[1] += 1;
      if ($periods) {
        $sums1[1] += $stu['G1'];
        $sums2[1] += $stu['G2'];
      }
      $sums3[1] += $stu['G3'];
    } elseif ($stu['traveltime'] == 3) {
      $counts[2] += 1;
      if ($periods) {
        $sums1[2] += $stu['G1'];
        $sums2[2] += $stu['G2'];
      }
      $sums3[2] += $stu['G3'];
    } elseif ($stu['traveltime'] == 4) {
      $counts[3] += 1;
      if ($periods) {
        $sums1[3] += $stu['G1'];
        $sums2[3] += $stu['G2'];
      }
      $sums3[3] += $stu['G3'];
    }
  }

  if ($periods) {
    $res1 = array($sums1[0]/$counts[0], $sums1[1]/$counts[1], $sums1[2]/$counts[2], $sums1[3]/$counts[3]);
    $res2 = array($sums2[0]/$counts[0], $sums2[1]/$counts[1], $sums2[2]/$counts[2], $sums2[3]/$counts[3]);
  }
  $res3 = array($sums3[0]/$counts[0], $sums3[1]/$counts[1], $sums3[2]/$counts[2], $sums3[3]/$counts[3]);
}

if ($periods) {
  for ($i=0; $i<count($res1); $i++) {
    if (!$res1[$i]) {
      $res1[$i] = (float)0.0;
    }
    if (!$res2[$i]) {
      $res2[$i] = (float)0.0;
    }
  }
}
for ($i=0; $i<count($res3); $i++) {
  if (!$res3[$i]) {
    $res3[$i] = (float)0.0;
  }
}

$_SESSION['vals'] = $vals;
$_SESSION['g1_graph'] = $res1;
$_SESSION['g2_graph'] = $res2;
$_SESSION['g3_graph'] = $res3;

$title = "";
if ($param == 'internet') {
  $title = 'Internet Access vs. Average Grade';
} elseif ($param == 'failures') {
  $title = 'Number of Failures vs. Average Grade';
} elseif ($param == 'studytime') {
  $title = 'Hours Spent Studying vs. Average Grade';
} elseif ($param == 'absences') {
  $title = 'Number of Absences vs. Average Grade';
} elseif ($param == 'health') {
  $title = 'Overall Health vs. Average Grade';
} elseif ($param == 'traveltime') {
  $title = 'Hours Spent Traveling vs. Average Grade';
}

$_SESSION['title'] = $title;

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Trends</title>
</head>
<style type="text/css">
#wrap {
  background-color:White;
  margin:auto;
  width:1000px;
  height:575px;
  border-radius:10px;
}
.h_title {
  padding:1px;
  padding-left:30px;
}
.main {
  padding:10px;
}
.menu {
  float:left;
  width:250px;
  height:375px;
  background-color:PowderBlue;
  padding:10px;
  border-radius:10px;
}
.gr {
  float:right;
  width:650px;
  height:375px;
  padding:10px;
  border-style:inset;
  border-radius:10px;
}
h1 {
  font-family:Impact, Charcoal, sans-serif;
  font-size:50px;
}


</style>
<body style="background-color:Snow">
  <div id="wrap">
  <div class="h_title"><h1>Student Trends</h1></div>
  <hr>
  <div class="main">
  <div class="menu">
    <form method='POST' action='index.php'>
      <h3>Select an Attribute</h3>
      <label class="switch">
        <input type="checkbox" name="periods" <?php if (isset($_POST['periods'])) echo "checked='checked'"; ?>>
        <span class="slider"></span>
        Show over all 3 grading periods
      </label><br><br><br>
      <input type='submit' name='internet' value='Internet Access'><br><br>
      <input type='submit' name='failures' value='Past Failures'><br><br>
      <input type='submit' name='studytime' value='Study Time'><br><br>
      <input type='submit' name='absences' value='Absences'><br><br>
      <input type='submit' name='health' value='Overall Health'><br><br>
      <input type='submit' name='traveltime' value='Travel Time'><br><br>
    </form>
  </div>
  <div class="gr">
    <?php

    if ($param == 'NO_PARAM') {
      echo "Please select an attribute to the left.";
    } else {
      echo "<img src='graph.php'>";
    }
    ?>
  </div>
  </div>
  </div>

</body>
</html>

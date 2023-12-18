<?php
session_start();
include('dbConnection.php');
$email=$_SESSION['email'];
if(isset($_GET['eid'])) {
    $eid = $_GET['eid'];
    
    
    $result = mysqli_query($con, "SELECT * FROM quiz WHERE eid = '$eid'") or die('Error');
    
    echo '<div class="panel"><div class="table-responsive"><table class="table table-striped title1">
          <tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
    
    $c = 1;
    while($row = mysqli_fetch_array($result)) {
        $title = $row['title'];
        $total = $row['total'];
        $sahi = $row['sahi'];
        $time = $row['time'];
        $eid = $row['eid'];
        
        $q12 = mysqli_query($con, "SELECT score FROM history WHERE eid='$eid' AND email='$email'") or die('Error98');
        $rowcount = mysqli_num_rows($q12);
        
        if($rowcount == 0) {
            echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;sec</td>
            <td><b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'&time='.$time.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
        } else {
            echo '<tr style="color:#99cc32"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solved by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
            <td><b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'&time='.$time.'" class="pull-right btn sub1" style="margin:0px;background:red"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
        }
    }
    
    $c = 0;
    echo '</table></div></div>';
}
?>

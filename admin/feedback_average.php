<form method="post">
<table class="table table-hover">
<tr>

<th> Select Faculty</th>
<td>
<select name="faculty" class="form-control">
    <?php
    $sql=mysqli_query($conn,"select * from faculty");
    while($r=mysqli_fetch_array($sql))
    {
    echo "<option value='".$r['email']."'>".$r['Name']."</option>";
    }
       ?>
</select>
</td>
<td><input name="sub" type="submit" value="Check Average" class="btn btn-success"/></td>
</tr>
</table>
</form>
<hr style="border:1px solid red"/>


<?php
extract($_POST);
if(isset($sub))
{
//Count total Votes
$r=mysqli_query($conn,"select * from feedback where faculty_id='$faculty'");
$c=mysqli_num_rows($r);  
echo "<h4>Total Student Attempts : ".$c."</h4>";

//question 1 start
error_reporting(1);
$q=mysqli_query($conn,"select * from feedback where faculty_id='$faculty'");
while($res=mysqli_fetch_array($q))
{
    if($res[3]==5)
    {
    $stongly_agree++;
    } 
    else if($res[3]==4)
    {
    $agree++;
    }
    else if($res[3]==3)
    {
    $neutral++;
    }
    else if($res[3]==2)
    {
    $disagree++;
    }
    else if($res[3]==1)
    {
    $strongly_disagree++;
    }
    
}
//question 1 end


//question 2 start
$q2=mysqli_query($conn,"select * from feedback where faculty_id='$faculty'");
while($res=mysqli_fetch_array($q2))
{
    if($res[4]==5)
    {
    $stongly_agree1++;
    } 
    else if($res[4]==4)
    {
    $agree++;
    }
    else if($res[4]==3)
    {
    $neutral++;
    }
    else if($res[4]==2)
    {
    $disagree++;
    }
    else if($res[4]==1)
    {
    $strongly_disagree++;
    }
    
}
//question 2 end

//count 
$t = (int)$stongly_agree + (int)$stongly_agree1;
echo "<h4>Strongly Agree : ".$t."</h4>";

$q=mysqli_query($conn,"select * from feedback where faculty_id='$faculty'");
while($res=mysqli_fetch_array($q))
{
    $count += (int)$res[3];
    $count += (int)$res[4];
    $count += (int)$res[5];
    $count += (int)$res[6];
    $count += (int)$res[7];
    $count += (int)$res[8];
    $count += (int)$res[9];
    $count += (int)$res[10];
    $count += (int)$res[11];
    $count += (int)$res[12];
    $count += (int)$res[13];
    $count += (int)$res[14];
    $count += (int)$res[15];
}
$average = $count / ($c * 15); // calculate the average
echo "<h4>Average : ".number_format((float)$average, 2, '.', '')."</h4>"; // display the average in float value with 2 decimal places
}
?>
<?php
session_start();
include('session_customer.php');
include 'assets.php';
include 'header.php';
// if(!isset($_SESSION['login_customer'])){
//     session_destroy();
//     header("location: customerlogin.php");
// }
$id = $_GET["id"];
$qry = 'SELECT * from inquiry WHERE inquiry_id='.$id.' LIMIT 1';
$result = $conn->query($qry);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $customer_username = $row["customer_username"];
        $query = $row["query"];
        $date = $row["date"];
        $reply = $row["reply"];
        $status = $row["status"];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title> Inquiry | OC Rental </title>
</head>
<style>
#frm {
    /* border: none; */
    background: rgba(240, 240, 240, 0.60);
    /* background: rgba(3,138,255,0.06); */
    /* background-color:red; */
}
</style>

<div style="padding-top:80px;" class="container">
    <div class="jumbotron" style="height:10rem;">
        <h1 class="text-center" style="margin-top:-2rem;">OC Rentals - Customer Inquiry </span>
        </h1>
        <p class="text-center">Tell what you want to know about OC Rental.</p>
    </div>
</div>


<div class="container" style="margin-top: 1%; margin-bottom: 2%;">
    <!-- <div class="col-md-5 col-md-offset-4"> -->
    <div class="col-md-7" style="float: none; margin: 0 auto;">
        <div class="form-area" id="frm" style="border-radius: 15px;">
            <form role="form" action="inquiry_process.php?id=<?php echo $id;?>" method="POST">
                <label>Username</label>
                <p><?php echo $customer_username; ?></p><br>
                <!-- <input type="text" id="uname" name="unameDis" class="form-control" value="" disabled><br> -->
                <!-- <input type="hidden" name="uname" value="<?php echo $customer_username; ?>"> -->

                <label>Query</label>
                <p><?php echo $query; ?></p><br>
                <!-- <textarea class="form-control" name="query" id="query" cols="30" rows="8" required></textarea><br> -->

                <label>Reply</label>
                <?php
                    if($status == 0){
                        echo '<p>No Reply Given</p><br>';
                        if(isset($_SESSION['login_admin'])){
                            echo '<label>Reply</label>';
                            echo '<textarea class="form-control" name="reply" id="reply" cols="30" rows="8" required></textarea><br>';
                            ?>
                <!-- <a href="inquiry_process.php?id=<?php echo $id;?>"> -->
                <button type="submit" class="btn btn-success pull-left"> Submit </button>
                <!-- </a> -->
                <?php
                           }
                        
                    }
                    else{
                        echo '<p>'.$reply.'</p><br>';
                    }

                   

            
                ?>
                <div id="tst"></div>


            </form>

        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
<!-- <script>
function replyFunction() {
  var rep = document.getElementById("reply");
  var reply = rep.value;
  var id = ;
  alert(id);
  var action='data';

  setTimeout(function(){
  $.ajax({
                url:'inquiry_process.php',
                method:'POST',
                data:{action:action,reply:reply,id:id},
                success:function(response){
                    console.log('Success');
                    // $("#tst").html(response);
                }
            });
        }, 2500); 
}
</script> -->

</html>
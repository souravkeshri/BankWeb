<header>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.1/dist/sweetalert2.css"  />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.1/dist/sweetalert2.all.js"  charset="UTF-8"></script>
<script type="text/javascript">

function myFn1(){
        Swal.fire({
  icon: "success",
  title: 'Money Sent Successfully',
  showConfirmButton: false,
 
  timer: 1500
}).then(function()
{
  window.location="history.php";
});
}  

function myFn2(){
        Swal.fire({
  icon: "error",
  title: 'Oops...',
  text: 'Not Enough Balance'
}).then(function()
{
  window.history.back();
});
}

function myFn3(){
        Swal.fire({
  icon: "error",
  title: 'Oops...',
  text: 'Please Select any other user to send money'
}).then(function()
{
    window.history.back();
});
}

function myFn4(){
        Swal.fire({
  icon: "error",
  title: 'Oops...',
  text: 'Sender Name/Receiver name or amount cannot be empty!!'
}).then(function()
{
  window.history.back();
});
}

function myFn5(){
        Swal.fire({
  icon: "error",
  title: 'Oops...',
  text: 'Amount can not be negative!!'
}).then(function()
{
  window.history.back();
});
}
function myFn6(){
        Swal.fire({
  icon: "error",
  title: 'Oops...',
  text: 'Amount can not be zero!!'
}).then(function()
{
  window.history.back();
});
}

</script>

</header>



<?php
   $conn=mysqli_connect('localhost','root');
   mysqli_select_db($conn,'login');
    if (!$conn) 
    {
        die("Connection failed: " .mysqli_error($conn));
    }
    if(isset($_POST['submit'])){

           if(empty( $_POST['sender']) && empty( $_POST['receiver']) || empty( $_POST['amount'])){
                 echo '<script type="text/javascript">
                 myFn4();
                 </script>';
           }
           else if($_POST['sender']==$_POST['receiver']){
                 echo '<script type="text/javascript">
                 myFn3();
                 </script>';
           }
           else{
                 $amount=$_POST['amount'];
                 $sender=$_POST['sender'];
                 $receiver=$_POST['receiver'];
                 $senderQuery="SELECT * FROM userdata WHERE id='". $sender ."'";
                 $senderResult=mysqli_query($conn,$senderQuery);
                 $receiverQuery="SELECT * FROM userdata WHERE id='". $receiver ."'";
                 $receiverResult=mysqli_query($conn,$receiverQuery);
                 $num=mysqli_num_rows($receiverResult);

                 while($senderRow = mysqli_fetch_array($senderResult))
                 {
                  while($receiverRow=mysqli_fetch_array($receiverResult))
                  {
                    $senderAmount=$senderRow['balance'];
                    $senderName=$senderRow['name'];
                    $receiverName=$receiverRow['name'];
                    $receiverAmount=$receiverRow['balance'];
					if($amount<0){
						echo '<script type="text/javascript">
                          myFn5();
                         </script>';
					}
					else if($amount==0){
						echo '<script type="text/javascript">
                          myFn6();
                         </script>';}
                    else if($amount>$senderAmount)
                    {
                      $insertQuery="INSERT INTO transaction (sender,receiver,amount,date,status) VALUES ('". $senderName ."','". $receiverName ."','". $amount ."',now(),'failed')";
                       if(mysqli_query($conn,$insertQuery)){
                          echo '<script type="text/javascript">
                          myFn2();
                         </script>';
                       }
                       else{
                        echo "wrong";
                       }

                    }
                    else{
                    $newReceiverAmt=$receiverAmount+$amount;
                    $newSenderAmt=$senderAmount-$amount;
                    $deductQuery="UPDATE userdata SET balance='". $newSenderAmt ."' WHERE id='". $sender ."'";
                    $addQuery="UPDATE userdata SET balance='". $newReceiverAmt ."' WHERE id='". $receiver ."'";
                    $insertQuery="INSERT INTO transaction (sender,receiver,amount,date,status) VALUES ('". $senderName ."','". $receiverName ."','". $amount ."',now(),'success')";
                    if(mysqli_query($conn,$deductQuery) && mysqli_query($conn,$addQuery) && mysqli_query($conn,$insertQuery))
                    {
                      echo '<script type="text/javascript">
                      myFn1();
                      </script>';
                    }
                    else
                    {
                      echo "something went wrong";
                    }
                   }
                }
             }
         }
    }

?>

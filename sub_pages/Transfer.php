<?php
    include '../components/Navigation__Bar.php';
    // ===========Condición global de siempre, que copié de la transacción depositar JAJA==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='../pages/Login.php?type=n'</script>";
        }


    // ==================Variable global================
        $customer_ac = '';
        $transaction_type = '';
        $transfer_ac = '';
        $amount = '';
        $transfer_by =  $_SESSION['USER_ID'];

        $msg = '';


    // ============Mensaje de exito, otra vez..===========
        if(isset($_GET["msg"])){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Exitoso, La Boulagarie is the best business ever!</h4>
                    <strong>Transferencia exitosa!</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }

        
    // =================Ahora algunas cosas que tienen que ver con la base de datos=============
            if(isset($_POST['transfer'])){
                $customer_ac = mysqli_escape_string($con,$_POST['account_no']);
                $transaction_type = 'Transfer';
                $transfer_ac = mysqli_escape_string($con,$_POST['transfer_no']);
                $amount = mysqli_escape_string($con,$_POST['amount']);
                
                $sql_sender = "SELECT * FROM customer WHERE account_no='$customer_ac' LIMIT 1";
                $sql_sender_q = mysqli_query($con,$sql_sender);
                $sql_sender_fe = mysqli_fetch_assoc($sql_sender_q);

                $sql_resiver = "SELECT * FROM customer WHERE account_no='$transfer_ac' LIMIT 1";
                $sql_resiver_q = mysqli_query($con,$sql_resiver);
                $sql_resiver_fe = mysqli_fetch_assoc($sql_resiver_q);

                if(mysqli_num_rows( $sql_sender_q) > 0){
                    if(mysqli_num_rows($sql_resiver_q) > 0){
                        // Verificar el balance
                        $sender_priv_balance =  $sql_sender_fe['acount_balance'];
                        // Verificar si la transacción fue exitosa
                        $resiver_priv_balance =  $sql_resiver_fe['acount_balance'];

                        if($sender_priv_balance > $amount){
                            $sender_final_balance = $sender_priv_balance - $amount;
                            // Todo exitoso, ahora a comunicarle eso a la base de datos!
                            mysqli_query($con,"UPDATE customer SET acount_balance = '$sender_final_balance' WHERE account_no = '$customer_ac'");
    
                            mysqli_query($con,"INSERT INTO transaction (customer_ac,transaction_type,transfer_customer_ac,amount,transfer_by) VALUES ('$customer_ac','$transaction_type','$transfer_ac','$amount','$transfer_by')");

                            $resiver_final_balance = $resiver_priv_balance + $amount;
                             // Todo super correcto!
                             mysqli_query($con,"UPDATE customer SET acount_balance = '$resiver_final_balance' WHERE account_no = '$transfer_ac'");

                             echo "<script>window.location='Transfer.php?type=n&msg=msg'</script>";

                        }else{
                            $msg = "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                                <strong>Ooop!</strong> El balance no es suficiente ( Sender Account ) para transferur.  Usa menos, no somos millonarios aqui ¿O si?
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                    }else{
                        $msg = "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                            <strong>Ooop!</strong> El número de cuenta ( Resiver Costomer )es incorrecto, contacta con Alejo, el de seguro tiene una solución!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                }else{
                    $msg = "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                            <strong>Ooop!</strong> El número de cuenta ( Sender Costomer ) es incorrecto, contacta con Alejo, el te puede ayudar!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
                
            }

?>
    <!----------------------- Formulario de transacción full en PHP, para modificar las variables ------------- -->
        <?php include '../components/User_Name.php'; ?>
        <?php echo $msg;?>
        <?php include '../components/SubNavigation.php'; ?>
        <div class="container">
            <form method="post" action="" class="row g-3 mt-2">
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Número de cuenta</label>
                    <input type="text" name='account_no' class="form-control" id="inputEmail4" required>
                </div>
                <div class="col-md-4">
                    <label for="inputEmail4" class="form-label">Transferir a</label>
                    <input type="text" name='transfer_no' class="form-control" id="inputEmail4" required>
                </div>
                <div class="col-md-4">
                    <label for="inputAddress2" class="form-label">Monto</label>
                    <input type="text" name="amount" class="form-control" id="inputAddress2" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" name="transfer" class="btn btn-primary">Trasfiere ahora!</button>
                </div>
            </form>
        </div>

<?php
    include '../components/Footer.php';
?>
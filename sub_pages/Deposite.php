<?php
    include '../components/Navigation__Bar.php';
    // ===========Condición para su respectivo logon OwO+==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='../pages/Login.php?type=n'</script>";
        }


    // ==================Variable global!, no poner mucho cuidado, literal copie y pegué esto del index jaja================
        $customer_ac = '';
        $transaction_type = '';
        $amount = '';
        $transfer_by =  $_SESSION['USER_ID'];

        $msg = '';


    // ============Respuesta a (TRUE) en forma de popup anclado (O el diseño es similar jaja)===========
        if(isset($_GET["msg"])){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Todo listo</h4>
                    <strong>Deposito exitoso</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }

        
    // =================Transacciones, conectando a la DB _MONEY Tal como aparece en el mapa de redes que hice previamente=============
    // Uso SQL, me conecto a la base de datos, con la variable global, ahora llamo a la base de datos y le pregunto algunas cositas
            if(isset($_POST['deposite'])){
                $customer_ac = mysqli_escape_string($con,$_POST['account_no']);
                $transaction_type = 'Deposite';
                $amount = mysqli_escape_string($con,$_POST['amount']);
                
                $sql = "SELECT * FROM customer WHERE account_no='$customer_ac' LIMIT 1";
                $sql_q = mysqli_query($con,$sql);

                if(mysqli_num_rows($sql_q) > 0){
                    $ac_checked = mysqli_fetch_assoc($sql_q);
                    $prev_balance = $ac_checked['acount_balance'];
                    $balance_added = $amount + $prev_balance;
                    mysqli_query($con,"UPDATE customer SET acount_balance = '$balance_added' WHERE account_no = '$customer_ac'");

                    mysqli_query($con,"INSERT INTO transaction (customer_ac,transaction_type,transfer_customer_ac,amount,transfer_by) VALUES ('$customer_ac','$transaction_type','NA','$amount','$transfer_by')");

                    echo "<script>window.location='Deposite.php?type=n&msg=msg'</script>";
                }else{
                    $msg = "<div class='alert alert-warning alert-dismissible fade show text-center' role='alert'>
                            <strong>Oh ohhh!!</strong> El número de cuenta es incorrecto, Contacta con Alejo el de seguro te puede ayudar!!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }

?>
    <!----------------------- Depositar formulario + Botón (Back) ------------- -->
        <?php include '../components/User_Name.php'; ?>
        <?php echo $msg;?>
        <?php include '../components/SubNavigation.php'; ?>
        <div class="container">
            <form method="post" action="" class="row g-3 mt-2">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Número de cuenta</label>
                    <input type="text" name='account_no' class="form-control" id="inputEmail4" required>
                </div>
                <div class="col-md-6">
                    <label for="inputAddress2" class="form-label">Monto</label>
                    <input type="number" name="amount" class="form-control" id="inputAddress2" required>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" name="deposite" class="btn btn-primary">Depositar</button>
                </div>
            </form>
        </div>
   
<?php
    include '../components/Footer.php';
?>
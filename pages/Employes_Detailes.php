<?php
    include '../components/Navigation__Bar.php';
    // ===========Condition==============
        if(!isset($_SESSION['IS_LOGGIN'])){
            echo "<script>window.location='Login.php?type=n'</script>";
        }
        if($_SESSION['ROLE'] != 0){
            echo "<script>window.location='Customers.php?type=n'</script>";
        }
    // ========X===Condition===x=========
    $msg = '';

    // ============Get Massege Here===========
        if(isset($_GET["msg"])){
            $msg_get = mysqli_escape_string($con,$_GET["msg"]);
            if($msg_get == "msg"){
                $msg = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <h4 class='alert-heading'>Bien hecho!!!, todo gracias a mis creadores Luis Garavito y Cristian Gonzales!</h4>
                    <strong>Todo correcto!!</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    // =========X===Get Massege Here===X=======

    // ==========Delete Functionality=========
        if(isset($_GET['id']) && $_GET['id'] != "" && isset($_GET['option']) && $_GET['option']!=""){
            $id = mysqli_escape_string($con,$_GET['id']);
            $option = mysqli_escape_string($con,$_GET['option']);

            if($option == 'delete'){
                mysqli_query($con,"DELETE FROM employe WHERE employe_id = '$id'");
                mysqli_query($con,"DELETE FROM users WHERE usename = '$id'");
                echo "<script>window.location='Employes_Detailes.php?type=n'</script>";
            }
        }
    // =======X===Delete Functionality===X======

    // =============Get Record==============
        $sql = mysqli_query($con,"SELECT * FROM employe ORDER BY id DESC");
    // =============Get Record==============
?>
    <!-- Display Customer Table -->
        <?php include '../components/User_Name.php' ?>
        <?php echo $msg;?>
        <div class="container" id="display_record">
            <div class="row text-center">
                <h2>Todos los Administradores</h2>
                <p>Datos de administradores aqui</p>
            </div>
            <div class="table-responsive mt-2">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="15%" scope="col">ID ADM</th>
                            <th width="15%" scope="col">Rol</th>
                            <th width="10%" scope="col">UID BACKUP</th>
                            <th width="20%" scope="col">Nombre</th>
                            <th width="10%" scope="col">Genero</th>
                            <th width="10%" scope="col">Unido</th>
                            <th width="20%" scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($sql)){
                        ?>
                            <tr>
                                <th scope="row" class="text-primary"><?php echo $row['employe_id']; ?></th>
                                <th scope="row" class="text-success"><?php echo  $row['designation']; ?></th>
                                <td><?php echo $row['salary']?></td>
                                <td><?php echo $row['name']?></td>
                                <td><?php echo $row['gender']?></td>
                                <td><?php 
                                        $dateStr=strtotime($row['join_date']);
                                        echo date('d-m-Y',$dateStr);
                                    ?></td>
                                <td class="d-flex justify-content-around">
                                    <a href="New__Employe.php?type=n&id=<?php echo $row['id']?>&option=view"><i class="far fa-eye text-primary"></i></a>
                                    <a href="New__Employe.php?type=n&id=<?php echo $row['id']?>&option=edit"><i class="fas fa-pen text-success"></i></a>
                                    <a href="?type=n&id=<?php echo $row['employe_id']?>&option=delete"><i class="fas fa-trash text-danger"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <!--X- Display Customer Table -X-->
<?php
    include '../components/Footer.php';
?>
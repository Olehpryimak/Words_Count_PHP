<?php
include_once './app/header.php';

if (!isset($_SESSION['logged_user'])) {
  header("Location: /");
}
include_once './app/header2.php';
$id = $_SESSION['logged_user'];
$user = R::findOne('users', 'id = ?', array($id));
?>
<div class="container" style="margin-top: 4%">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">

            <div class="well">
                <div style="text-align: center; display: inline-block; width: 48%; font-size:xx-large ;">
                    <?php echo $user['name']; ?>
                </div>
                <div style="text-align: center; display: inline-block; width: 48%;font-size:xx-large ; ">
                    <form action="/logout.php" method="post">
                        <button name="do_logout" class="btn btn-danger btn-lg" type="submit">Вихід</button>
                    </form>
                </div>
            </div>    
            <div class="well">

                <div class="form-group">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <br>
                        <input type="file" name="filename" size="9" class="form-control"/>    
                        <br>
                        <div style="text-align: center">
                            <button type="submit" class="btn btn-success btn-md" >Завантажити</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3"></div>
    </div>
</div>
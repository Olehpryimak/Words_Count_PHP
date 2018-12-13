<!DOCTYPE html>
<meta charset="utf-8">

<?php
include_once './app/header.php';
?>

<div class="container" style="margin-top: 4%">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5">
            <div class="well">

                <div class="form-group">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div style="text-align: center">
                            <h2>File</h2>
                        </div>
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
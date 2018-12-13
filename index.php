<!DOCTYPE html>
<meta charset="utf-8">



<?php
require_once './app/header.php';
?>
<!--Використовуємо Bootstrap для адаптивної верстки -->
<div class="container" style="margin-top: 4%">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">

            <?php
            $data = $_POST;
            $check = 1;
            $errors;
// Перевіряємо з якої кнопки ми прийшли і проводимо реєстрацію
            if (isset($data['do_signup']) && isset($data['email'])) {



                if (strlen($data['password']) <= 3) {
                    $errors[] = 'Пароль надто короткий - мінімум 4 символи!';
                }

                if (($data['password']) != $data['password_2']) {
                    $errors[] = 'Паролі не збігаються!';
                }


                if (empty($errors)) {
                    $check = 2;
                    $user = R::dispense('users');
                    $user->name = $_POST['name'];
                    $user->email = $_POST['email'];
                    $user->password = $_POST['password'];
                    R::store($user);
                    ?>    
            <div class="bg-success" style="text-align: center; font-weight: bold">
                        <?php echo 'Ви успішно пройшли реєстрацію'; ?>
                    </div>
                    <?php
                } else {

                    $check = 3;
                    ?>
                    <div class="bg-warning" style="text-align: center; font-weight: bold">
                        <?php echo array_shift($errors); ?>
                    </div>             
                    <?php
                }
            }
            ?>                  
            <div class="well">

                <div class="form-group" >
                    <form style="text-align: center" id="sighup" action="/" method="post">
                        <h2>Sign Up</h2>
                        <br>
                        <input type="text" name="name" value=""class="form-control"placeholder="Ваше ім'я" required>
                        <br>
                        <input type="email" name="email" value=""class="form-control"placeholder="Введіть email" required>
                        <br>
                        <input type="password" name="password" value=""class="form-control"placeholder="Введіть пароль" required>
                        <br>
                        <input type="password" name="password_2" value=""class="form-control"placeholder="Повторіть пароль" required>
                        <br>
                        <button type="submit"  class="btn btn-success" name="do_signup">Зареєструватися</button>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-3">



            <div class="well">

                <div class="form-group">
                    <form action="/" method="post">
                        <div style="text-align: center">
                            <h2>Sign In</h2>
                        </div>
                        <br>
                        <input type="email" name="email" value=""class="form-control"placeholder="Введіть email" required>
                        <br>
                        <input type="password" name="password" value=""class="form-control"placeholder="Введіть пароль" required>

                        <br>

                        <div style="text-align: center">
                            <button type="submit" class="btn btn-success btn-md" >Вхід</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?php
require_once './app/footer.php';
?>

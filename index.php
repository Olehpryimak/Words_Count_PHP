<?php require_once './app/header.php';
require_once './app/header2.php';
?>
<!--Використовуємо Bootstrap для адаптивної верстки -->
<div class="container" style="margin-top: 4%">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">

            <?php
            $data = $_POST;
            $errors;
            
            
// Перевіряємо з якої кнопки ми прийшли і проводимо реєстрацію
            if (isset($data['do_signup']) && isset($data['email'])) {
                
                
                if (R::count('users' , "email = ?" , array($data["email"])) > 0 ) {
                    $errors[] = "Користувач з таким email вже зареєстрований!";
                    
                }
                
                if(isset($data['name'])== FALSE){
                    $errors[] = "Введіть ім'я!";
                }
                
                if (isset($data['password'])==FALSE) {
                    $errors[] = 'Введіть пароль';
                }
              
                
                if (strlen($data['password']) <= 3) {
                    $errors[] = 'Пароль надто короткий - мінімум 4 символи!';
                }

                if (($data['password']) != $data['password_2']) {
                    $errors[] = 'Паролі не збігаються!';
                }

                // запис в базу даних
                if (empty($errors)) {

                    $user = R::dispense('users');
                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
                    R::store($user);
                    ?>    
                    <div class="bg-success" style="text-align: center; font-weight: bold">
                        <?php echo 'Ви успішно пройшли реєстрацію'; ?>
                    </div>
                    <?php
                } else {

                    
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
                    <form style="text-align: center" id="signup" action="/" method="post">
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

            <?php
            if(isset($data['do_login'])){
                $user = R::findOne('users', 'email = ?', array($data['email']));
                if($user)
                {
               if(password_verify($data['password'],$user->password)){
                   $_SESSION ['logged_user'] = $user['id'];?>
                  <script>document.location.href="./upload.php"</script>
                   <?php
               } 
               else{
                   $errors2 [] = 'Пароль введено не правильно!';
                   
               }
                }
                else{
                    $errors2 [] = 'Не існує користувача з таким email!';
                }
            
            
            if (!empty($errors2)) {

                    
                    ?>
                    <div class="bg-warning" style="text-align: center; font-weight: bold">
                        <?php echo array_shift($errors2); ?>
                    </div>             
                    <?php
                }
            
            }
            
            
            
            ?>
            
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
                            <button type="submit"  name="do_login" class="btn btn-success btn-md" >Вхід</button>
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

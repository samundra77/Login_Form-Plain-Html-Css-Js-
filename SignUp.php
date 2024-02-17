<?php
session_start();
if (isset($_SESSION['Email_Session'])) {
    header("Location: welcome.php");
    die();
}
include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
$msg = "";
$Error_Pass="";
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conx, $_POST['Username']);
    $email = mysqli_real_escape_string($conx, $_POST['Email']);
    $Password = mysqli_real_escape_string($conx, md5($_POST['Password']));
    $Confirm_Password = mysqli_real_escape_string($conx, md5($_POST['Conf-Password']));
    $Code = mysqli_real_escape_string($conx, md5(rand()));
    if (mysqli_num_rows(mysqli_query($conx, "SELECT * FROM register where email='{$email}'")) > 0) {
        $msg = "<div class='alert alert-danger'>This Email:'{$email}' is alredy exist.</div>";
    } else {
        if ($Password === $Confirm_Password) {
            $query = "INSERT INTO register(`Username`, `email`, `Password`, `CodeV`) values('$name','$email','$Password','$Code')";
            $result = mysqli_query($conx, $query);
            if ($result) {
                
                $mail = new PHPMailer(true);

                try {
                   
                    $mail->SMTPDebug = 0;                      
                    $mail->isSMTP();                                            
                    $mail->Host       = 'smtp.gmail.com';                     
                    $mail->SMTPAuth   = true;                                   
                    $mail->Username   = 'samundra.devkota51@gmail.com';                     
                    $mail->Password   = 'ekypafpsqlusftku';                               
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                    $mail->Port       = 465;                                     
                    $mail->setFrom('samundra.devkota51@gmail.com');
                    $mail->addAddress($email,$name);
                    $mail->isHTML(true);                                  
                    $mail->Subject = 'You have Successfully Registered';
                    $mail->Body    = '<p> This is the Verifecation Link<b><a href="http://localhost/login_register_form/?Verification='.$Code.'">"http://localhost/login_register_form/?Verification='.$Code.'"</a></b></p>';

                    $mail->send();

                   
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                $msg = "<div class='alert alert-info'>We have send a verification link on your email address</div>";
            } else {
                $msg = "<div class='alert alert-danger'>Something was Wrong</div>";
                
            }
        } else {
            $msg = "<div class='alert alert-danger'>Password and Confirm Password does not match</div>";
            $Error_Pass='style="border:1px Solid red;box-shadow:0px 1px 11px 0px red"';
        }
    }
}
?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="passwod.js"></script>

    <link rel="stylesheet" href="style.css" />
    <title>Sign in & Sign up Form</title>
    <style>
        .alert {
            padding: 1rem;
            border-radius: 5px;
            color: white;
            margin: 1rem 0;
            font-weight: 500;
            width: 65%;
        }

        .alert-success {
            background-color: #42ba96;
        }

        .alert-danger {
            background-color: #fc5555;
        }

        .alert-info {
            background-color: #2E9AFE;
        }

        .alert-warning {
            background-color: #ff9966;
        }
    </style>
</head>

<body>
    <div class="container sign-up-mode">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="" method="POST" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <?php echo $msg ?>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="Username" placeholder="Username"  value="<?php if (isset($_POST['submit'])) { echo $name;} ?>" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="Email" placeholder="Email"  value="<?php if (isset($_POST['submit'])) {echo $email; } ?>" required>
                    </div>
                    <div class="input-field" <?php echo $Error_Pass?>>
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="Password" placeholder="Password" required>
                    </div>
                    <br>
                    <div class="input-field" <?php echo $Error_Pass?>>
                        <i class="fas fa-lock"></i>
                        <input type="password" name="Conf-Password" placeholder="Confirm Password" required>
                    </div>
                    <div class="g-recaptcha" data-sitekey="6Lcqp0ElAAAAALG4GSxPmOLOXJHD-mCkiru5HX_8"></div>

                    <input type="submit" name="submit" class="btn" value="Sign up" />
                    <script type="text/javascript">
    $(function() {
        $("#password").passwordStrength();
    });
</script>
                    
                </form>
                <div class="cont" style="text-align:center;">
                    <h3 >Already Register ?</h3>
                    <a href="index.php" class="btn transparent" id="sign-in-btn" style="padding:10px 20px;text-decoration:none ; color:blue">
                        Sign in</a> 
               </div>

            </div>
        </div>
         <div class="panels-container">
            <div class="panel left-panel">
            </div>
            <div class="panel right-panel">
            <img src="img/imagelg.png" class="image" alt="" />
        </div>
    </div>
    </div>
</body>

</html>

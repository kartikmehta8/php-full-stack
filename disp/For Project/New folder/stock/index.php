


<?php require_once 'includes/header.php';
require_once 'bootstrap.php';
?>
<div class="row" style="background-image: url('bglogin.jpg');height:700px;">
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
<div class="row">&nbsp;<br></div>
    <div class="  col-md-6 col-sm-12 mx-auto col-md-offset-3" >
    
        <div class=" jumbotron card card-body bg-light mt-5" style="box-shadow: 5px 10px 18px #888888;">
            <h2>Login </h2>

            <form action="<?php echo URLROOT; ?>/actions/__login.php" method="post">
                <!--div class="form-group">
                    <label for="email">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="enter email">
                </div-->
                <!--place for error message flashing-->
                <div>
                <?php
                  //this will display any kind of error/success message
                  flash();
                ?>
                </div>
                <!--end flashing-->
                <div class="form-group">
                    <label for="id">ID: <sup>*</sup></label>
                    <input type="text" name="id" class="form-control form-control-lg" placeholder="Enter Your ID" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg"
                           placeholder=" Password" required>
                </div>
                <input type="hidden" name="token" value="<?php echo Token::generate();?>">
                <div class="form-group">
                     <input type="submit" name="submit" value="LOGIN" class="btn btn-success">
                </div>

              </form>
        </div>
    </div>
</div>

<?php require_once './includes/footer.php'; ?>






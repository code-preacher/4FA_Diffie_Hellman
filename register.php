<?php
require_once 'library/lib.php';
require_once 'classes/crud.php';
?>

<?php
$lib=new Lib;
$crud=new Crud;

if (isset($_POST['sub'])) {
    $crud->addUser($_POST,$_FILES);
}
?>
<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="admin/assets/images/favicon.png">
    <title>DIFFIE-HELLMAN ALGORITHM</title>
    <!-- Custom CSS -->
    <link href="admin/dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper">

    <!-- End Left Sidebar  -->

    <!-- Bread crumb -->
<!--    <div class="row page-titles">-->
<!--        <div class="col-md-5 align-self-center">-->
<!--            <h3 class="text-primary">REGISTRATION FORM</h3> </div>-->
<!--        <div class="col-md-7 align-self-center">-->
<!--            <ol class="breadcrumb">-->
<!--                <li class="breadcrumb-item"><a href="index.html" style="color: purple;">Click to go back to Home</a></li>-->
<!--                <li class="breadcrumb-item"><a href="#">Registration</a></li>-->
<!---->
<!--            </ol>-->
<!--        </div>-->
<!--    </div>-->
    <!-- End Bread crumb -->
    <!-- Page wrapper  -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card"><br>
                    <div class="card-title">
                        <h4>REGISTRATION INFORMATION</h4>

                        <p><?=$lib->msg();?></p>

                    </div>
                    <div class="card-body" style="background-color: #ffffff;border:1px solid #f0f0f1;mso-border-shadow: yes">
                        <div class="basic-form">
                            <form action="register.php" method="POST" enctype="multipart/form-data">


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Fullname :</p>
                                            <input type="text" class="form-control input-rounded" name="name" placeholder="Please enter fullname" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Email :</p>
                                            <input type="email" class="form-control input-rounded" name="email" placeholder="Please enter email" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Security Question :</p>
                                            <input type="text" class="form-control input-rounded" name="question" placeholder="Please enter security question" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Security Answer :</p>
                                            <input type="text" class="form-control input-rounded" name="answer" placeholder="Please enter security answer" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Phone Number :</p>
                                            <input type="text" class="form-control input-rounded" name="phone" placeholder="Please enter phone number" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Password :</p>
                                            <input type="password" class="form-control input-rounded" name="password" placeholder="Please enter password" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Residence Address :</p>
                                            <input type="text" class="form-control input-rounded" name="address" placeholder="Please enter residence address" required="required">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Select Gender :</p>
                                            <select class="form-control input-rounded" name="gender" required="required">
                                                <option value="MALE">MALE</option>
                                                <option value="FEMALE">FEMALE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>





                                <hr style="border:3px solid black;">

                                <h3>GRAPHICAL IMAGE UPLOADS</h3>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Upload Image 1 :</p>
                                            <img id="list1" height="200" width="220"/><br>
                                            <input type="file" name="img1" id="upfile1" accept="image/jpeg, image/png, image/jpg, image/gif">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Upload Image 2  :</p>
                                            <img id="list2" height="200" width="220"/><br>
                                            <input type="file" name="img2" id="upfile2" accept="image/jpeg, image/png, image/jpg, image/gif">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <p class="text-muted m-b-15 f-s-12">Upload Image 3 :</p>
                                            <img id="list3" height="200" width="220"/><br>
                                            <input type="file" name="img3" id="upfile3" accept="image/jpeg, image/png, image/jpg, image/gif">
                                        </div>
                                    </div>


                                </div>


                                <div class="form-actions">
                                    <button type="submit" name="sub" class="btn btn-success col-md-3"> <i class="fa fa-plus"></i> Sign Up</button>
                                    <button type="reset" class="btn btn-inverse col-md-3"><i class="fa fa-refresh"></i> Clear</button>
                                </div>
                                <br>
                                <span><a href="index.php"  style="color:#000;"><i class="ti-home"></i>&nbsp;&nbsp;&nbsp;Back to Home</a></span>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->
    <!-- footer -->

    <!-- FOOTER REGION -->
    <?php
    include "admin/inc/footer.php";
    ?>

    <!-- End footer -->

    <!-- End Page wrapper  -->
</div>
<!-- End Wrapper -->

<script>
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '" width="120" height="120"/>'].join('');
                    document.getElementById('list1').insertBefore(span, null);
                    document.getElementById("list1").src=e.target.result;

                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('upfile1').addEventListener('change', handleFileSelect, false);


    function handleFileSelect2(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '" width="120" height="120"/>'].join('');
                    document.getElementById('list2').insertBefore(span, null);
                    document.getElementById("list2").src=e.target.result;

                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('upfile2').addEventListener('change', handleFileSelect2, false);


    function handleFileSelect3(evt) {
        var files = evt.target.files; // FileList object

        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '" width="120" height="120"/>'].join('');
                    document.getElementById('list3').insertBefore(span, null);
                    document.getElementById("list3").src=e.target.result;

                };
            })(f);
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('upfile3').addEventListener('change', handleFileSelect3, false);


</script>
<script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ============================================================== -->
<!-- This page plugin js -->
<!-- ============================================================== -->
<script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function(){

        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
</script>

</body>

</html>
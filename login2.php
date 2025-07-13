<?php
require_once 'library/lib.php';
require_once 'classes/auth.php';
?>

<?php
$lib=new Lib;
$validate=new Auth;

if (isset($_POST['sub'])) {
    $validate->check2($_FILES);
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

<body class="fix-header fix-sidebar">
<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<!-- Main wrapper  -->
<div id="main-wrapper">

    <!-- End Left Sidebar  -->

    <!-- Bread crumb -->
<br><br>
    <!-- End Bread crumb -->
    <!-- Page wrapper  -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-md-6 offset-3">
                <div class="card">
                    <div class="card-title">
<!--                        <h4>LOGIN</h4>-->

                        <p><?=$lib->msg();?></p>

                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <hr style="border-color:#000000;">
                            <div class="text-center">
                                <span style="color: #000;font-size: 18px;">DIFFIE-HELLMAN ALGORITHM</span>
                            </div><br>
                            <form action="login2.php" method="POST" enctype="multipart/form-data">


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
                                <hr style="border-color:#000000;">

                                <div class="form-actions">
                                    <button type="submit" name="sub" class="btn btn-success col-md-3"> <i class="fa fa-sign-in"></i> Validate</button>
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

<!-- All Jquery -->
<script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="admin/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>

<script>

    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();

</script>

</body>

</html>
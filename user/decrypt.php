<?php
require_once '../library/lib.php';
require_once '../classes/crud.php';

$lib=new Lib;
$crud=new Crud;
$lib->check_login2();

$ALGORITHM = 'AES-128-CBC';
$IV    = '12dasdq3g5b2434b';
$error = '';



if (isset($_POST) && isset($_POST['action'])) {
  $s=(float)microtime();
  $pass1   = isset($_POST['pass1']) && $_POST['pass1']!='' ? $_POST['pass1'] : null;
  $pass2   = isset($_POST['pass2']) && $_POST['pass2']!='' ? $_POST['pass2'] : null;
  $password   = $pass1.$pass2;
  $action = isset($_POST['action']) ? $_POST['action'] : null;
  $file     = isset($_FILES) && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ? $_FILES['file'] : null;


  if ($pass1 === null) {
    $error .= 'Invalid Decryption Key 1 or No Decryption Key 1 was entered<br>';
  }
  if ($pass2 === null) {
    $error .= 'Invalid Decryption Key 2 or No Decryption Key 2 was entered<br>';
  }
  if ($action === null) {
    $error .= 'Invalid Action or No Action was selected <br>';
  }
  if ($file === null) {
    $error .= 'Errors occurred while elaborating the file<br>';
  }

$users=$crud->displayThreeSpecific('matrix','password',$pass1,'email',$_SESSION['id'],'filename',$_FILES['file']['name']);

 $filenamez=''; $passkey='';$exp_time='';
  if ($users) {
  $exp_time=$users['exp_time'];
  $passkey=$users['password'];

    if($exp_time < date('Y/m/d H:i:s')){
     $error .= 'Key has expired, ask sender to re-encrypt..Thanks<br>';
    }
  
  if ($error === '') {
  
    $contenuto = '';
    $nomefile  = '';
  
    $contenuto = file_get_contents($file['tmp_name']);
    $filename  = $file['name'];
  
 
    $contenuto = openssl_decrypt($contenuto, $ALGORITHM, $password, 0, $IV);
    $filename  = preg_replace('#\.df$#','',$filename);
    
    if ($contenuto === false) {
      $error .= 'Invalid Key/Action...Errors occurred while decrypting the file ';
    }
    
    if ($error === '') {
      session_start();
      $_SESSION['c'] = $contenuto;
      $_SESSION['f'] = $filename;
      header("location:decrypt2.php");
      
      $d=(float)microtime(); 
  $execution_time = $s + $d ;
  $crud->addMatrix($_SESSION['id'],'decryption',$filename,$lib->formatBytes($_FILES['file']['size'], $precision = 2),$exp_time,$execution_time,$password);
    }
    }
  
 
  } else {
  $error .= 'Invalid Password/Email/File supplied<br>';
  }


  
  
}

?>


<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">DECRYPT DATA</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Decrypt Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


     <?php if ($error != '') { ?>
      <div class="row">
        <div class="col-12 alert alert-danger" role="alert">
          <?php echo ($error); ?>
        </div>
      </div>
      <?php }?>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                            <div class="card-title"><!-- 
                                <h4>DIAGNOSIS</h4> -->

                            </div>
                            <div class="card-body">
                                <div class="basic-form">


                                    <form class="form" enctype="multipart/form-data" method="post" id="form1" name="form1" auto-complete="off" class="col-12">
                                        <div class="row p-b-30">
                                            <div class="col-12">

                                                <label>Please click to upload file of any kind: </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-warning text-white" id="basic-addon1"><i class="ti-location-arrow"></i></span>
                                                </div>
                                                <input type="file" class="form-control form-control-lg" placeholder="File Uploads" aria-label="Address" name="file" id="file" aria-describedby="basic-addon1" required>
                                            </div>

   
                                            <label>Please enter decryption key 1: </label>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control form-control-lg" placeholder="Decryption Key 1" aria-label="Password" minlength="8" maxlength="8" name="pass1" aria-describedby="basic-addon1" required>
                                            </div>


                                              <label>Please enter decryption key 2: </label>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-success text-white" id="basic-addon2"><i class="ti-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control form-control-lg" placeholder="Decryption Key 2" aria-label="Password" minlength="8" maxlength="8" name="pass2" aria-describedby="basic-addon1" required>
                                            </div>


                                            <input type="hidden" name="action" value="d">



                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="p-t-20">
                                                    <button class="btn btn-info" name="sub" type="submit" class="col-6"><i class="ti-reload m-r-5"></i>Decrypt</button>
                                                    <!-- <button class="btn btn-info" name="sub" onclick="setTimeout('document.form1.reset();',1000)" type="submit" class="col-6"><i class="ti-reload m-r-5"></i>Decrypt</button> -->
                                                </div>
                                            </div>
                                        </div>


                                    </form>

                                </div>



                            </div>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- End PAge Content -->
        </div>
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php
        include 'inc/footer.php';
        ?>

        <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function(value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>
</body>

</html>
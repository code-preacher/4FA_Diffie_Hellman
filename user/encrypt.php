
<?php
require_once '../library/lib.php';
require_once '../classes/crud.php';

$lib=new Lib;
$crud=new Crud;
$lib->check_login2();

$user=$crud->displayAll('user');

$ALGORITHM = 'AES-128-CBC';
$IV    = '12dasdq3g5b2434b';
$error = '';

if (isset($_POST) && isset($_POST['action'])) { 
  $s=(float)microtime();
  
  $password   = isset($_POST['password']) && $_POST['password']!='' ? $_POST['password'] : null;
  $exp_time   = isset($_POST['exp_time']) && $_POST['exp_time']!='' ? $_POST['exp_time'] : null;
 
  $action = isset($_POST['action']) ? $_POST['action'] : null;
  $file     = isset($_FILES) && isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK ? $_FILES['file'] : null;
  
  if ($password === null) {
    $error .= 'Invalid Password or No Password was entered<br>';
  }
   if ($exp_time === null) {
    $error .= 'Invalid Expiry time or Expiry time was entered<br>';
  }
  if ($action === null) {
    $error .= 'Invalid Action or No Action was selected <br>';
  }
  if ($file === null) {
    $error .= 'Errors occurred while elaborating the file<br>';
  }
  
  if ($error === '') {
  
    $contenuto = '';
    $nomefile  = '';
  
    $contenuto = file_get_contents($file['tmp_name']);
    $filename  = $file['name'];
  


      // $password2 = rand(00000,900);
      $password2 = $lib->gen_random_num();


      $key = $password.$password2;
 
    $contenuto = openssl_encrypt($contenuto, $ALGORITHM, $key, 0, $IV);
    $filename  = $filename . '.df';
    
    if ($contenuto === false) {
      $error .= 'Invalid Password/Action...Errors occurred while encrypting the file ';
    }
     


    
    if ($error === '') {

      $email = $crud->displayEmailById('user',$_POST['user_id']);
      $crud->SendMail($email,$key,$file['name'].'.dh');

      session_start();
      $_SESSION['c'] = $contenuto;
      $_SESSION['f'] = $filename;
      header("location:encrypt2.php");

        $d=(float)microtime(); 
        $execution_time = $s + $d ;
  $crud->addMatrix($email,'encryption',$filename,$lib->formatBytes($_FILES['file']['size'], $precision = 2),$exp_time,$execution_time,$password);
    }

    
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
                <h4 class="page-title">ENCRYPT DATA</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Encrypt Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>


     <?php if ($error != '') { ?>
      <div class="row">
        <div class="col-12 alert alert-danger" role="alert">
          <?php echo ($error);?>
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

   
                                            <label>Please enter encryption key: </label>
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control form-control-lg" placeholder="Encryption Key" aria-label="Password" minlength="8" maxlength="8" name="password" aria-describedby="basic-addon1" required>
                                            </div>

                                              <label>Select User : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-user"></i></span>
                                                </div>
                                                <select class="form-control form-control-lg" name="user_id"  required="required">
                                                    <?php foreach ($user as $u) { ?>
                                                     <option value="<?=$u['id']?>"><?php echo strtoupper($u['name']);?></option>
                                                 <?php  } ?>
                                             </select>
                                           </div>


                                           <label>Time Duration : </label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-info text-white" id="basic-addon2"><i class="ti-time"></i></span>
                                                </div>
                                                <select class="form-control form-control-lg" name="exp_time"  required="required">
                                                     <option value="<?=date('Y/m/d H:i:s', strtotime('+1 minute'))?>">1 Minutes</option>
                                                     <option value="<?=date('Y/m/d H:i:s', strtotime('+2 minute'))?>">2 Minutes</option>
                                                     <option value="<?=date('Y/m/d H:i:s', strtotime('+5 minute'))?>">5 Minutes</option>
                                                     <option value="<?=date('Y/m/d H:i:s', strtotime('+1 day'))?>">1 Day</option>
                                             </select>
                                           </div>

                                            <input type="hidden" name="action" value="c">



                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="p-t-20">
                                                    <button class="btn btn-info" name="sub" type="submit" class="col-6"><i class="ti-reload m-r-5"></i>Encrypt</button>
                                                    <!-- <button class="btn btn-info" name="sub" onclick="setTimeout('document.form1.reset();',1000)" type="submit" class="col-6"><i class="ti-reload m-r-5"></i>Encrypt</button> -->
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
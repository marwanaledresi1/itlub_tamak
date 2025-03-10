<!DOCTYPE html>
<html lang="ar">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();


if (isset($_POST['submit'])) {
    if (empty($_POST['c_name'])) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>الحقل مطلوب!</strong>
															</div>';
    } else {

        $check_cat = mysqli_query($db, "SELECT c_name FROM res_category where c_name = '" . $_POST['c_name'] . "' ");



        if (mysqli_num_rows($check_cat) > 0) {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>الفئة موجودة بالفعل!</strong>
															</div>';
        } else {


            $mql = "INSERT INTO res_category(c_name) VALUES('" . $_POST['c_name'] . "')";
            mysqli_query($db, $mql);
            $success =     '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																تم إضافة فئة جديدة بنجاح.</br></div>';
        }
    }
}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>إضافة فئة</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>


<body class="fix-header">
   
    <div id="main-wrapper">
        <?php include '../components/head_admin.php'; ?>


        <?php include '../components/left_slider_admin.php'; ?>



        <div class="page-wrapper">
           

            <div class="container-fluid">




                <div class="row">



                    <div class="container-fluid">



                        <?php
                        echo $error;
                        echo $success; ?>





                        <div class="col-lg-12">
                            <div class="card card-outline-primary">
                                <div class="card-header">
                                    <h4 class="m-b-0 text-white">إضافة فئة مطعم</h4>
                                </div>
                                <form action='' method='post'>
                                    <div class="form-body">

                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label">فئة</label>
                                                    <input type="text" name="c_name" class="form-control">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="form-actions">
                                            <input type="submit" name="submit" class="btn btn-primary" value="حـفظ">
                                            <a href="add_category.php" class="btn btn-inverse">إلغاء</a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-12">


                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">الفئات المضافة</h4>

                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-hover table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>رقم الفئة</th>
                                            <th>اسم الفئة</th>
                                            <th>تاريخ</th>

                                            <th>تعديل/حذف</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        $sql = "SELECT * FROM res_category order by c_id desc";
                                        $query = mysqli_query($db, $sql);

                                        if (!mysqli_num_rows($query) > 0) {
                                            echo '<td colspan="7"><center>No Categories-Data!</center></td>';
                                        } else {
                                            while ($rows = mysqli_fetch_array($query)) {



                                                echo ' <tr><td>' . $rows['c_id'] . '</td>
																								<td>' . $rows['c_name'] . '</td>
																								<td>' . $rows['date'] . '</td>
																								
																									 <td><a href="delete_category.php?cat_del=' . $rows['c_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_category.php?cat_upd=' . $rows['c_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="fa fa-edit"></i></a>
																									</td></tr>';
                                            }
                                        }


                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

        </div>

        <?php include "include/footer.php" ?>

    </div>

    </div>

    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>

</body>

</html>
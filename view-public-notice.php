<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sturecmsaid']==0)) {
  header('location:logout.php');
} else {
  if(isset($_POST['submit'])) {
    $classid=$_POST['classid'];
    $subjectname=$_POST['subjectname'];
    $subjectcode=$_POST['subjectcode'];
    
    // Kiểm tra mã môn học đã tồn tại chưa
    $check_code = "SELECT ID FROM tblsubjects WHERE SubjectCode=:subjectcode";
    $query = $dbh->prepare($check_code);
    $query->bindParam(':subjectcode',$subjectcode,PDO::PARAM_STR);
    $query->execute();
    
    if($query->rowCount() > 0) {
      echo "<script>alert('Mã môn học này đã tồn tại. Vui lòng thử lại');</script>";
    } else {
      try {
        $sql="INSERT INTO tblsubjects(ClassId,SubjectName,SubjectCode) VALUES(:classid,:subjectname,:subjectcode)";
        $query=$dbh->prepare($sql);
        $query->bindParam(':classid',$classid,PDO::PARAM_STR);
        $query->bindParam(':subjectname',$subjectname,PDO::PARAM_STR);
        $query->bindParam(':subjectcode',$subjectcode,PDO::PARAM_STR);
        $query->execute();
        $LastInsertId=$dbh->lastInsertId();
        if ($LastInsertId>0) {
          echo '<script>alert("Môn học đã được thêm thành công.")</script>';
          echo "<script>window.location.href ='manage-subjects.php'</script>";
        } else {
          echo '<script>alert("Đã xảy ra lỗi. Vui lòng thử lại")</script>';
        }
      } catch(PDOException $e) {
        echo '<script>alert("Lỗi: ' . $e->getMessage() . '")</script>';
      }
    }
  }
  // Code for deletion
  if(isset($_GET['delid'])) {
    $rid=intval($_GET['delid']);
    $sql="delete from tblsubjects where ID=:rid";
    $query=$dbh->prepare($sql);
    $query->bindParam(':rid',$rid,PDO::PARAM_STR);
    $query->execute();
    echo "<script>alert('Môn học đã được xóa thành công');</script>"; 
    echo "<script>window.location.href = 'manage-subjects.php'</script>";     
  }
?>
<!DOCTYPE html>
<html lang="vi">
  <head>
    <title>Hệ Thống Quản Lý Sinh Viên || Quản Lý Môn Học</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Quản Lý Môn Học</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Bảng điều khiển</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Quản Lý Môn Học</li>
                </ol>
              </nav>
            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Danh Sách Môn Học</h4>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Tên Môn Học</th>
                            <th>Mã Môn Học</th>
                            <th>Lớp</th>
                            <th>Ngày Tạo</th>
                            <th>Hành Động</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $sql="SELECT tblsubjects.ID,tblsubjects.SubjectName,tblsubjects.SubjectCode,tblsubjects.CreationDate,
                          tblclass.ClassName,tblclass.Section from tblsubjects 
                          join tblclass on tblclass.ID=tblsubjects.ClassId";
                          $query = $dbh->prepare($sql);
                          $query->execute();
                          $results=$query->fetchAll(PDO::FETCH_OBJ);
                          $cnt=1;
                          if($query->rowCount() > 0) {
                            foreach($results as $row) {               
                          ?>
                          <tr>
                            <td><?php echo htmlentities($cnt);?></td>
                            <td><?php echo htmlentities($row->SubjectName);?></td>
                            <td><?php echo htmlentities($row->SubjectCode);?></td>
                            <td><?php echo htmlentities($row->ClassName);?> <?php echo htmlentities($row->Section);?></td>
                            <td><?php echo htmlentities($row->CreationDate);?></td>
                            <td>
                              <a href="edit-subject.php?editid=<?php echo htmlentities($row->ID);?>"><i class="icon-pencil"></i></a>
                              <a href="manage-subjects.php?delid=<?php echo htmlentities($row->ID);?>" onclick="return confirm('Bạn có chắc chắn muốn xóa môn học này?');"> <i class="icon-trash"></i></a>
                            </td>
                          </tr>
                          <?php $cnt=$cnt+1;}} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/data-table.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<?php } ?>

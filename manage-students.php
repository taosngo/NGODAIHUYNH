// ... existing code ...
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Mã SV</th>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Lớp</th>
        <th>Số ĐT</th>
        <th>Ngày Tạo</th>
        <th>Hành Động</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT s.*, c.ClassName, c.Section 
              FROM tblstudent s
              LEFT JOIN tblclass c ON c.ID = s.StudentClass
              ORDER BY s.ID DESC";
      $query = $dbh->prepare($sql);
      $query->execute();
      $results = $query->fetchAll(PDO::FETCH_OBJ);
      $cnt = 1;
      if($query->rowCount() > 0) {
        foreach($results as $row) {
      ?>
      <tr>
        <td><?php echo $cnt;?></td>
        <td><?php echo htmlentities($row->StudentId);?></td>
        <td><?php echo htmlentities($row->StudentName);?></td>
        <td><?php echo htmlentities($row->StudentEmail);?></td>
        <td><?php echo htmlentities($row->ClassName);?> <?php echo htmlentities($row->Section);?></td>
        <td><?php echo htmlentities($row->ContactNumber);?></td>
        <td><?php echo htmlentities($row->CreationDate);?></td>
        <td>
          <a href="edit-student.php?editid=<?php echo $row->ID;?>" class="btn btn-primary btn-sm">
            <i class="icon-pencil"></i>
          </a>
          <a href="manage-students.php?delid=<?php echo $row->ID;?>" 
             onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?');" 
             class="btn btn-danger btn-sm">
            <i class="icon-trash"></i>
          </a>
        </td>
      </tr>
      <?php 
          $cnt++;
        }
      } else { 
      ?>
      <tr>
        <td colspan="8" class="text-center">Không có dữ liệu sinh viên</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
// ... existing code ...
<div class="card-body">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="card-title">Danh Sách Sinh Viên</h4>
    <a href="add-students.php" class="btn btn-primary">
      <i class="icon-plus"></i> Thêm Sinh Viên
    </a>
  </div>
  // ... existing table code ...
</div>
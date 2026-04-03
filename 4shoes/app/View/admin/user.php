
            
            <div class="card">
                <div class="card-header">
                    <span class="header-title">Admin Profile</span>
                    <!-- <a href="admin.php?page=user_form" class="btn-add">Add Admin Profile</a> -->

                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Vai trò</th>
                                <th>Ẩn</th>
                                <th>Chặn</th>
                                <!-- <th>Xóa</th> -->
                            </tr>
                        </thead>
                        <tbody>
<?php
$stt = 1;
foreach ($dsuser as $us) {
?>
    <tr>
        <td><?php echo $stt++; ?></td>
        <td><?php echo htmlspecialchars($us['name']); ?></td>
        <td><?php echo htmlspecialchars($us['email']); ?></td>
        <td><?php echo htmlspecialchars($us['phone']); ?></td>
        <td><?php echo htmlspecialchars($us['role']); ?></td>

        <!-- Nút Ẩn/Hiện -->
        <td>
            <?php if ($us['is_hidden'] == 0): ?>
                <a href="admin.php?page=hideUser&id=<?php echo $us['id']; ?>" class="btn btn-edit">Ẩn</a>
            <?php else: ?>
                <a href="admin.php?page=showUser&id=<?php echo $us['id']; ?>" class="btn btn-edit">Hiện</a>
            <?php endif; ?>
        </td>

        <!-- Nút Chặn/Mở chặn -->
        <td>
            <?php if ($us['is_blocked'] == 0): ?>
                <a href="admin.php?page=blockUser&id=<?php echo $us['id']; ?>" class="btn btn-edit">Chặn</a>
            <?php else: ?>
                <a href="admin.php?page=unblockUser&id=<?php echo $us['id']; ?>" class="btn btn-edit">Mở chặn</a>
            <?php endif; ?>
        </td>

        <!-- Nếu muốn thêm nút xoá -->
        <!--
        <td>
            <a href="admin.php?page=user&id=<?php echo $us['id']; ?>" 
               class="btn btn-delete" 
               onclick="return confirm('Bạn có chắc muốn xoá user này?');">DELETE</a>
        </td>
        -->
    </tr>
<?php
}
?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
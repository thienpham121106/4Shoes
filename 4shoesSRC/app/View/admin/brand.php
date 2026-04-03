<?php
    if(isset($br_edit)) {
        $name = $br_edit[0]['name'];
        $title_form = "Cập nhật Thương hiệu";
    } else {
        $name = '';
        $title_form = "Thêm Thương hiệu Mới";
    }
?>  

<div class="card" style="margin-bottom: 25px;">
    <div class="card-header">
        <span class="header-title"><?= $title_form ?></span>
    </div>
    <div style="padding: 20px;">
        <form method="post" action="" style="display: flex; gap: 15px; align-items: flex-end;">
            <div style="flex: 1;">
                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Tên thương hiệu:</label>
                <input type="text" name="catname" value="<?=$name?>" class="form-control" required placeholder="Nhập tên thương hiệu..." style="width: 100%; padding: 10px; border: 1px solid #d1d3e2; border-radius: 5px;">
            </div>
            
            <div>
                <input type="submit" class="btn btn-add" 
                       value="<?php if(isset($_GET['idedit'])) echo "Lưu thay đổi"; else echo "Thêm mới"; ?>" 
                       name="add_cat" style="height: 40px; padding: 0 20px;">
                
                <?php if(isset($_GET['idedit'])): ?>
                    <a href="admin.php?page=brand" class="btn btn-delete" style="height: 40px; line-height: 40px; text-decoration: none; display: inline-block;">Hủy</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="header-title">Danh sách Thương hiệu</span>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">ID</th>
                    <th style="width: 80%;">Tên Thương hiệu</th>
                    <th style="width: 10%;">Hành động</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $stt = 1;  
                foreach($dsbr as $br) {
            ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td style="font-weight: 500; color: #4e73df;"><?= htmlspecialchars($br['name']) ?></td>
                    <td>
                        <a href="admin.php?page=brand&idedit=<?=$br['id']?>" class="btn btn-edit" title="Sửa">
                            <i class="fa-solid fa-pen"></i> Sửa
                        </a>
                        
                        </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
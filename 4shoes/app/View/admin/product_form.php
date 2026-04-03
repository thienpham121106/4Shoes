<form class="xform-neo" cart="form" method="post" action="" enctype="multipart/form-data">
    <label class="xform-label">Tên</label>
    <input class="xform-input" type="text" name="name" value="<?= isset($sp_edit)?htmlspecialchars($sp_edit['name']):'' ?>" required>

<!-- Brand -->
<label class="xform-label">Thương hiệu</label>
<select class="xform-select" name="brand_id" required>
    <?php foreach($dsbr as $br): ?>
        <option value="<?= $br['id'] ?>" <?= isset($sp_edit)&&$sp_edit['brand_id']==$br['id']?'selected':'' ?>>
            <?= htmlspecialchars($br['name']) ?>
        </option>
    <?php endforeach; ?>
</select>

<!-- Category -->
<label class="xform-label">Danh mục</label>
<select class="xform-select" name="category_id" required>
    <?php foreach($dscategory as $cat): ?>
        <option value="<?= $cat['id'] ?>" <?= isset($sp_edit)&&$sp_edit['category_id']==$cat['id']?'selected':'' ?>>
            <?= htmlspecialchars($cat['name']) ?>
        </option>
    <?php endforeach; ?>
</select>

    <label class="xform-label">Giá</label>
    <input class="xform-input" type="number" name="price" value="<?= isset($sp_edit)?$sp_edit['price']:'' ?>" required>

    <label class="xform-label">Tồn kho</label>
    <input class="xform-input" type="number" name="stock" value="<?= isset($sp_edit)?$sp_edit['stock']:'' ?>" required>

    <label class="xform-label">Mô tả</label>
    <textarea class="xform-textarea" name="description"><?= isset($sp_edit)?htmlspecialchars($sp_edit['description']):'' ?></textarea>

    <label class="xform-label">Hình ảnh</label>
    <input class="xform-file" type="file" name="image">
    <?php if(isset($sp_edit) && $sp_edit['image']): ?>
        <div class="xform-preview">
            <img src="public/images/<?= htmlspecialchars($sp_edit['image']) ?>" alt="Product Image" width="120">
        </div>
    <?php endif; ?>

    <input class="xform-btn" type="submit" 
           name="<?= isset($sp_edit)?'update_sp':'add_sp' ?>" 
           value="<?= isset($sp_edit)?'Lưu':'Thêm' ?>">
</form>

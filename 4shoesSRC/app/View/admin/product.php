
            
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Danh sách sản phẩm</span>
                    <a href="admin.php?page=product_form">
                    <button class="btn-add">Thêm Sản Phẩm</button>
                    </a>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 50px;">ID</th>
                                <th style="width: 80px;">Image</th>
                                <th>Tên</th>
                                <th>Thương hiệu</th>
                                <th>Danh mục</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th style="width: 80px;">Sửa</th>
                                <!-- <th style="width: 90px;">Ẩn</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $stt = 1;  foreach($dssp as $sp) {
                            ?>
                            <tr>
                                <td> <?= $stt++ ?></td>
                                <td class="col-image"><img src="../public/ASM-js/images/index-product/<?= $sp['image'] ?>" alt="iPhone"></td>
                                <td><?= $sp['name'] ?></td>
                                <td><?= $sp['brand_name'] ?></td>
                                <td><?= $sp['category_name'] ?></td>
                                <td class="price-tag"><?= $sp['price'] ?></td>
                                <td><span class="stock-badge stock-high"><?= $sp['stock'] ?></span></td>
                                    <td>
                                <!-- Nút sửa -->
                                <a href="admin.php?page=product_form&idedit=<?= $sp['id'] ?>">
                                    <button class="btn-action btn-edit">Sửa</button>
                                </a>
                            </td>
                                 <!-- <td> -->
                                <!-- Nút xoá -->
                                <!-- <a href="admin.php?page=product&id=<?= $sp['id'] ?>" 
                                   onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?')">
                                    <button class="btn-action btn-delete">Xóa</button>
                                </a> -->
                            <!-- </td> -->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
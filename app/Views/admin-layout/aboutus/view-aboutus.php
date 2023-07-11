<!-- Main content -->
<?php if ($aboutus) : ?>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title"><b></b></h1>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Page Name</th>
                    <th>Controller Name</th>
                    <th>Page Title</th>
                    <th>Meta Key Word</th>
                    <th>Description</th>
                    <th>Is Active</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Images</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($aboutus as $about) { ?>
                    <tr>
                      <td><?= $about['page_name']; ?></td>
                      <td><?= $about['controller_name']; ?></td>
                      <td><?= $about['page_title']; ?></td>
                      <td><?= $about['meta_key_word']; ?></td>
                      <td><?= $about['description']; ?></td>
                      <td><?= $about['is_active']; ?></td>
                      <td><?= date('Y-m-d', strtotime($about['created_at'])); ?></td>
                      <td><?= date('Y-m-d', strtotime($about['updated_at'])); ?></td>
                      <td>
                        <?php if ($about['images']) : ?>
                          <button class="btn btn-sm btn-info toggle-images-btn">Show</button>
                          <?php foreach ($about['images'] as $image) : ?>
                            <div class="thumbnail">
                              <img src="<?php echo base_url('admin-template/upload/' . $image['file_name']); ?>" alt="Image" class="portfolio-image" style="display: none;">
                            </div>
                          <?php endforeach; ?>

                        <?php endif; ?>
                      </td>
                      <td><a href="<?= base_url('admin/softsol-data/edit/' . $about['id']); ?>">Edit</a></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
<?php else : ?>
  <a href="<?= base_url('/admin/softsol-data'); ?>">
    <button class="btn btn-success ml-2 font-bold">Create</button>
  </a>
<?php endif; ?>
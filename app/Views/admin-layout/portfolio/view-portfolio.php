<!-- Main content -->
<?php if ($portfolio): ?>
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
                  <th>Title</th>
                  <th>Meta Key Word</th>
                  <th>Description</th>
                  <th>Images</th>
                  <th>Edit</th>
                </tr>
              </thead>
              <tbody>
                <!-- portfolio data will be shown here -->
                <?php foreach ($portfolio as $data) : ?>
                  <tr>
                    <td><?php echo $data['title']; ?></td>
                    <td><?php echo $data['meta_key_word']; ?></td>
                    <td><?php echo $data['description']; ?></td>
                    <td>
                      <?php if ($data['images']): ?>
                        <button class="btn btn-sm btn-info toggle-images-btn">Show</button>
                        <?php foreach ($data['images'] as $image) : ?>
                          <div class="thumbnail">
                            <img src="<?php echo base_url('admin-template/upload/' . $image['file_name']); ?>" alt="Image" class="portfolio-image" style="display: none;">
                          </div>
                        <?php endforeach; ?>
                       
                      <?php endif; ?>
                    </td>
                    <td><a href="<?php echo base_url('admin/edit/portfolio/' . $data['id']); ?>">Edit</a></td>
                  </tr>
                <?php endforeach; ?>
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
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php else: ?>
  <a href="/admin/create-portfolio"> <button class="btn btn-success ml-2 font-bold">Create Portfolio</button> </a>
<?php endif; ?>












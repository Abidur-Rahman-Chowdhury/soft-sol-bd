    <!-- Main content -->
     <!-- Main content -->

     <?php if ($aboutus): ?>

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
                    <th>Is Active</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>

                 <?php 
                //  dd($aboutus);
                 foreach ($aboutus as $about) { ?>
                  <tr>
                    <!-- Data will be printed here  -->
                  
                  <td><?php echo $about['title'];?></td>
                  <td><?php echo $about['meta_key_word'];?></td>
                  <td><?php echo $about['description'];?></td>
                  <td><?php echo $about['is_active'];?></td>
                  <td><?php echo $about['created_at'];?></td>
                  <td><?php echo $about['updated_at'];?></td>
                  <td><a href="">Edit</a></td>
                  <td><a href="">Delete</a></td>
                  </tr>
                  <?php }?>
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

        
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
         <a href="/admin/create-about"> <button class="btn btn-success ml-2 font-bold">Create</button> </a>  
    <?php endif; ?>
   
   
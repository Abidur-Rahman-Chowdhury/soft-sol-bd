    <!-- Main content -->
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
            
              
              <th>File Name</th>
              <th>Edit</th>
             
            </tr>
            </thead>
            <tbody>
            <!-- portfolio data will be shown here   -->
            <?php 
                //  dd($aboutus);
                  foreach ($portfolio as $data) { ?>
                  <tr>
                    <!-- Data will be printed here  -->
                   
                  <td><?php echo $data['title'];?></td>
                  <td><?php echo $data['meta_key_word'];?></td>
                  <td><?php echo $data['description'];?></td>
                  <td><?php echo $data['file_name'];?></td>
                  <td><a href="<?php echo base_url(); ?>admin/edit/portfolio/<?php echo $data['id']?>">Edit</a></td>
                 
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


   <!-- <a href="/admin/create-about"> <button class="btn btn-success ml-2 font-bold">Create</button> </a>   -->

   <?php else: ?>
         <a href="/admin/create-portfolio"> <button class="btn btn-success ml-2 font-bold">Create Portfolio</button> </a>  
    <?php endif; ?>
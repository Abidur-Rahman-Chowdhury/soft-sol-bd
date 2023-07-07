<div class="col-md-6 mx-auto">

  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create About Us</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form method="post" enctype='multipart/form-data' action="<?php echo site_url('admin/create/insert'); ?>">
      <div class="card-body">
        <div class="form-group">
          <label for="title">Page Title</label>
          <input type="text" class="form-control" id="title" name="page_title" placeholder="title">
          <?php if (isset($errors['title'])) : ?>
            <span class="text-danger"><?= $errors['title'] ?></span>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="page_name">Page Name</label>
          <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Page Name">
          <?php if (isset($errors['page_name'])) : ?>
            <span class="text-danger"><?= $errors['page_name'] ?></span>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="controller_name">Controller Name</label>
          <input type="text" class="form-control" id="controller_name" name="controller_name" placeholder="Controller Name">
          <?php if (isset($errors['page_name'])) : ?>
            <span class="text-danger"><?= $errors['page_name'] ?></span>
          <?php endif ?>
        </div>
        <div class="form-group">
          <label for="MetaKeyWord">Meta Key Word</label>
          <input type="text" class="form-control" id="MetaKeyWord" name="meta_key_word" placeholder="meta key word">
          <?php if (isset($errors['meta_key_word'])) : ?>
            <span class="text-danger"><?= $errors['meta_key_word'] ?></span>
          <?php endif ?>
        </div>
        <!-- editor -->
        <div class="mb-4">
          <h3 class="card-title">
            <b> Description</b>
          </h3>
        </div>
        <div class="card-body " style="margin-left:-20px;">
          <textarea id="summernote"  rows="4" cols="50" name="description">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
          <?php if (isset($errors['description'])) : ?>
            <span class="text-danger"><?= $errors['description'] ?></span>
          <?php endif ?>
        </div>

        <div class="form-group">
          <label for="IsActive">Is Active</label>
          <input type="number" class="form-control" id="IsActive" name="is_active" placeholder="Is Active">
          <?php if (isset($errors['is_active'])) : ?>
            <span class="text-danger"><?= $errors['is_active'] ?></span>
          <?php endif ?>
        </div>

        <div class="form-group">
          <label for="formFileLg" class="form-label">Select image:</label>
          <input class="form-control form-control-lg" type="file" name="image">
        </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>







<!-- jQuery -->
<script src="admin-template/plugins/jquery/jquery.min.js"></script>


<!-- Page specific script -->
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
      format: 'L'
    });

    //Date and time picker
    // $('#created_at').datetimepicker({ icons: { time: 'far fa-clock' } });
    // $('#updated_at').datetimepicker({ icons: { time: 'far fa-clock' } });

    $('#created_at').datetimepicker({
      format: 'Y-M-D',
      icons: {
        time: 'far fa-clock'
      }
    });
    $('#updated_at').datetimepicker({
      format: 'Y-M-D',
      icons: {
        time: 'far fa-clock'
      }
    });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function() {
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function() {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() {
      myDropzone.enqueueFile(file)
    }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script>
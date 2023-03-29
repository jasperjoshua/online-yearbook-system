
<form action="draft.php?m=upload&type=image-multi-optional&batch=<?php echo $_GET['batch'] ?>&img_type=<?php echo $type ?>" 
    method="POST" enctype="multipart/form-data" class="p-3">
    <div class="row m-1">
        <div class="col-sm-9">
            <input type="file" name="uploaded_file" accept="image/*" class="form-control form-control-lg" id="uploaded_file" />
            <p class="text-muted mt-0">
                <small>
                    <strong>Note:</strong> 
                    <em>The image will be used in the print-version of the yearbook. The images will be added in order of their upload time.</em>
                </small>
            </p>
        </div>
        <div class="col-sm-3 m-0">
            <input type="hidden" name="image_type" value="<?php $type ?>" />
            <input type="hidden" name="save" value="upload" />
            <button class="btn btn-primary p-3" type="submit">Upload Image</button>
        </div>
    </div>
</form>
<?php foreach (array_values($_POST['image-multi-optional'][$type]) as $i => $img_path): ?>
    <form action="draft.php?m=delete&batch=<?php echo $_GET['batch'] ?>&img_type=<?php echo $type ?>" method="POST" enctype="multipart/form-data" class="p-3">
        <div class="row m-1">
            <div class="col-sm-8">
                <img class="img-fluid ybook-page" src="<?php echo $img_path ?>" width="100%" alt="">
            </div>
            <div class="col-sm-4" style="position: relative; left: -10%;">
                <input type="hidden" name="image_path" value="<?php echo $img_path ?>" />
                <button class="btn btn-primary mt-2 p-3" type="submit">Delete Image</button>
            </div>
        </div>
    </form>
<?php endforeach; ?>
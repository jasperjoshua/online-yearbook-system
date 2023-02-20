<center>

    <form method="POST" enctype="multipart/form-data" 
        action="draft.php?m=layout&batch=<?php echo $_GET['batch'] ?>" >
            
        <div class="row p-0 m-0">
            <div class="col-6 mt-2">
                <div class="form-floating">            
                    <select class="form-control selectpicker"  id="grad_page_layout" name="grad_page_layout">
                        <option value="3x2"
                            <?php if (isset($_POST['grad_page_layout']) && $_POST['grad_page_layout'] == '3x2'): ?>
                                selected
                            <?php endif; ?>
                        >
                            Graduates Page Layout: 3 columns by 2 rows
                        </option>
                        <option value="4x3"
                            <?php if (isset($_POST['grad_page_layout']) && $_POST['grad_page_layout'] == '4x3'): ?>
                                selected
                            <?php endif; ?>
                        >
                            Graduates PageLayout: 4 columns by 3 rows
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-3 mt-2">
                <div class="form-floating">                    
                    <select class="form-control selectpicker"  id="grad_profile_layout" name="grad_profile_layout">
                        <option value="rounded"
                            <?php if (isset($_POST['grad_profile_layout']) && $_POST['grad_profile_layout'] == 'rounded'): ?>
                                selected
                            <?php endif; ?>
                        >
                            Profile: Rounded
                        </option>
                        <option value="square"
                            <?php if (isset($_POST['grad_profile_layout']) && $_POST['grad_profile_layout'] == 'square'): ?>
                                selected
                            <?php endif; ?>
                        >
                            Profile: Square
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 mt-2 text-center">
                <input type="hidden" name="save" value="layout" />
                <button class="btn btn-primary py-3 px-5" type="submit">UPDATE</button>
            </div>
        </div>
    </form>

    <p class="text-dark mt-0">
        <small>
            <strong class="text-primary">IMPORTANT!!!</strong> 
            The graduation photos of the graduates must be saved in the folder 
            [<em><?php echo YBOOK_IMG_DIR.'/'.$_GET['batch'].'/graduates' ?></em>].
        </small>
    </p>
    <div class="px-5 ms-xl-4 ">
        <span class="h1 fw-bold mb-0">
            <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
            THE GRADUATES
        </span>
    </div>
    <div class="container-fluid" style="height: 450px; overflow: auto;">                
        <table class="table" >
            <thead>
                <tr>
                    <?php foreach ($_POST['data']['table_headers'] as $header) : ?>
                        <th><?php echo $header ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <?php foreach ($_POST['data']['table_headers'] as $header) : ?>
                        <th><?php echo $header ?></th>
                    <?php endforeach; ?>
                </tr>
            </tfoot>

            <tbody>
                <?php foreach ($_POST['data']['table_data'] as $rows) : ?>
                    <tr>
                        <?php foreach ($_POST['data']['table_headers'] as $header) : ?>
                            <td><?php echo $rows[$header] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</center>
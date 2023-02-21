<div class="px-3 ms-xl-4 ">
            <span class="h4 fw-bold m-0">
                <img class="img-fluid " src="img/bisu_logo.png" width="10%" alt="">
                <?php echo $_POST['title'] ?>
            </span>
        </div>

        <div class="container-fluid">
            <div class="row m-0 mt-2">
                <div class="col-sm-12">
                <?php if (isset($_POST['data']['center'])): ?>
                    <?php foreach($_POST['data']['center'] as $value): ?>
                    <div class="row mt-3">
                        <p class="small text-dark m-0"><strong><?php echo $value['Full_Name'] ?></strong></p>
                        <p class="small text-secondary m-0">
                            <?php echo $value['Award'] ?>
                        </p>
                        <p class="small text-secondary m-0">
                            <?php if (isset($value['Award_Type']) && $value['Award_Type'] != ''): ?>
                                <?php echo ucwords(strtolower($value['Award_Type'])) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
                <div class="col-sm-6 mt-0">
                <?php if (isset($_POST['data']['left'])): ?>
                    <?php foreach($_POST['data']['left'] as $value): ?>
                    <div class="row mt-3" style="text-align:center;">
                        <p class="small text-dark m-0"><strong><?php echo $value['Full_Name'] ?></strong></p>
                        <p class="small text-secondary m-0">
                            <?php echo $value['Award'] ?>
                        </p>
                        <p class="small text-secondary m-0">
                            <?php if (isset($value['Award_Type']) && $value['Award_Type'] != ''): ?>
                                <?php echo ucwords(strtolower($value['Award_Type'])) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
                <div class="col-sm-6 m-0">
                <?php if (isset($_POST['data']['right'])): ?>
                    <?php foreach($_POST['data']['right'] as $value): ?>
                    <div class="row text-right mt-4" style="text-align:center;">
                        <p class="small text-dark m-0"><strong><?php echo $value['Full_Name'] ?></strong></p>
                        <p class="small text-secondary m-0">
                            <?php echo $value['Award'] ?>
                        </p>
                        <p class="small text-secondary m-0">
                            <?php if (isset($value['Award_Type']) && $value['Award_Type'] != ''): ?>
                                <?php echo ucwords(strtolower($value['Award_Type'])) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
                <div class="col-sm-12">
                <?php if (isset($_POST['data']['bottom'])): ?>
                    <?php foreach($_POST['data']['bottom'] as $value): ?>
                    <div class="row mt-3">
                        <p class="small text-dark m-0"><strong><?php echo $value['Full_Name'] ?></strong></p>
                        <p class="small text-secondary m-0">
                            <?php echo $value['Award'] ?>
                        </p>
                        <p class="small text-secondary m-0">
                            <?php if (isset($value['Award_Type']) && $value['Award_Type'] != ''): ?>
                                <?php echo ucwords(strtolower($value['Award_Type'])) ?>
                            <?php endif; ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
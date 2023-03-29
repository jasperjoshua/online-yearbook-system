

                
                <ul class="nav nav-pills nav-fill flex-column col-2 ml-4" style="display: inline-block; text-align: justify;" id="myTab" role="tablist">
                <li class="nav-item dropdown " style="disaply: block;">
                        <a class="nav-link 
                            <?php if ($_POST['active'] == 'image'): ?>
                                active
                            <?php endif; ?>
                            dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Background Images
                        </a>
                        <div id="bg_images-select" class="dropdown-menu">
                            <?php foreach ($_POST['bg_images'] as $img_type => $images): ?>
                                <?php foreach ($images as $type => $img_title): ?>
                                    <a class="dropdown-item 
                                        <?php if (isset($_POST['image_type']) && $_POST['image_type'] == $type): ?>
                                            selected
                                        <?php endif; ?>
                                        " href="#<?php echo $type ?>-pane" id="<?php echo $type ?>"
                                        data-bs-toggle="tab" role="tab" aria-selected="false" aria-controls="<?php echo $type ?>-pane">
                                        <?php echo $img_type.' '.$img_title ?>  
                                    </a>
                                <?php endforeach; ?>
                                <?php if ($img_type == 'Common'): ?>
                                    <div class="dropdown-divider"></div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <?php foreach ($_POST['sections'] as $type => $page_type): ?>
                    <li class="nav-item text-center" role="presentation" style="disaply: block;">
                        <button class="nav-link 
                            <?php if ($_POST['active'] == $type): ?>
                                active
                            <?php endif; ?>
                            " data-bs-toggle="tab" type="button" role="tab" aria-selected="false" 
                            id="<?php echo $type ?>" data-bs-target="#<?php echo $type ?>-pane" aria-controls="<?php echo $type ?>-pane" >
                            <?php echo $_POST[$type]['title'] ?>                                               
                        </button>
                    </li>
                    <?php endforeach; ?>
                    
                </ul>
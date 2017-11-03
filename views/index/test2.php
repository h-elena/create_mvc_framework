<div class="body-content">
    <h1><?php echo $params['title']?></h1>
    <div class="row">
        <?php if(!empty($params['errors'])){
            if(is_array($params['errors'])){
                $error = implode('<br>', $params['errors']);
            }
            else {
                $error = $params['errors'];
            }?>
            <div class="col-md-10">
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p><?php echo $error?></p>
                </div>
            </div>
        <?php }?>
        <div class="col-md-10">
            <p><?php echo $params['tree']?></p>
        </div>
        <div class="col-md-10">
            <p><?php
                echo '<pre>';
                print_r($params['siblings']);
                echo '</pre>';
                ?></p>
        </div>
    </div>
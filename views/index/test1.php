<div class="body-content">
    <h1><?php echo $params['title']?></h1>
    <div class="row">
        <div>
            <p><?php echo $params['text']?></p>
        </div>
        <div class="col-md">
            <p><?php
                echo '<pre>';
                print_r($params['masTagData']);
                echo '</pre>';
                ?></p>
        </div>
        <div class="col-md">
            <p><?php
                echo '<pre>';
                print_r($params['masTagDesc']);
                echo '</pre>';
                ?></p>
        </div>
</div>
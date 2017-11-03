<div class="body-content">
    <h1><?php echo $params['title']?></h1>
    <div class="row">
        <div>
            <?php if(!empty($params['mas'])){
                $i = 1;?>
                <table class="table table-bordered">
                    <?php foreach ($params['mas'] as $mas){?>
                        <tr>
                            <td><?php echo $i++;?>.</td>
                            <?php foreach ($mas as $subMas){?>
                                <td><?php echo $subMas?></td>
                            <?php }?>
                        </tr>
                    <?php }?>
                </table>
            <?php } ?>
        </div>

    </div>
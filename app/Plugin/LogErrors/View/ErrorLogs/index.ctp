<?php echo $this->Html->link('Resolved',
    array('controller' => 'ErrorLogs', 'action' => 'index', 1)); ?>

<?php echo $this->Html->link('UnResolved',
    array('controller' => 'ErrorLogs', 'action' => 'index', 0)); ?>
<table border="1">
<?php
if(!empty($errors)){
//    echo '<pre>';
//    print_r($errors);
?>
   <tr><th></th><th>Error</th><th>date</th></tr>
<?php
    foreach($errors as $error){
        ?>
        <tr>
            <form id='<?php echo 'error'.$error['ErrorLog']['id'];?>' class="eachError">
            <td><input type="checkbox" <?php if($error['ErrorLog']['is_resolved']== 1){echo 'checked';}?> ></td>
            <td><?php echo $this->Html->link($error['ErrorLog']['error_message'],
                array('controller' => 'ErrorLogs', 'action' => 'view', $error['ErrorLog']['id'])); ?></td>
            <td><?php echo $error['ErrorLog']['created']?></td>
        </form>
        </tr>
        <?php
    }
}
?>
</table>
<?php echo $this->Paginator->numbers(array('first' => 'First page')); ?>
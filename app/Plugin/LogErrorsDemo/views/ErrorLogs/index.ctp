<table>
<?php
if(!empty($errors)){
    foreach($errors as $error){
        ?>
        <tr>
            <td>
            <td><?php echo $error['error_message']?></td>
            <td><?php echo $error['created']?></td>
         </tr>
        <?php
    }
}
?>
</table>
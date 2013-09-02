<?php if(!empty($users)){
    ?>
    <table>
        <?php foreach($users as $user){ ?>
        <tr>
            <td><a href='<?php echo '/users/view/'.$user['User']['id']; ?>'> <?php echo $user['User']['username'];?> </a></td>
            <td><?php echo $user['User']['role'];?></td>
        </tr>
                <?php } ?>
    </table>
<?php } ?>
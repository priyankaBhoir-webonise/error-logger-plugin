<?php echo $this->Html->link('change_status',
    array('controller' => 'ErrorLogs', 'action' => 'change',$error['ErrorLog']['id']));?>
<table>
    <tr>
        <td><?php echo '<b>'.$error['ErrorLog']['error_message'].'</b>'; ?>
            <br><small> Created at : <?php echo $error['ErrorLog']['created'];?> </small></td>
    </tr>
    <tr>

        <?php
            if($error['ErrorLog']['is_resolved']==1){
                echo '<td style="color: green">Resolved </td>';
            }
            else{
                echo '<td style="color: red">Unresolved </td>';
            }
        ?>
        <td>
            <?php echo $this->Html->link('change status',
            array('plugin'=>'log_errors','controller' => 'ErrorLogs', 'action' => 'change',$error['ErrorLog']['id'])); ?>

        </td>
    </tr>
    <tr>
        <td>Stack:<br><?php echo nl2br($error['ErrorLog']['error_stack']); ?></td>
    </tr>

    <tr>
        <td>
            Session Data:<?php echo nl2br($error['ErrorLog']['session_data']);?>
        </td>
    </tr>

    <tr>
        <td>
            Server Data:<br><?php echo nl2br($error['ErrorLog']['server_data']);?>
        </td>
    </tr>
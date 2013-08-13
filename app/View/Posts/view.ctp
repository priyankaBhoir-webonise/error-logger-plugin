<p><?php echo $this->Html->link("Log out", array('controller'=>'users','action' => 'logout')); ?></p>
<h4>view </h4>
<table>
<tr>
    <td><?php echo '<b>'.$post['Post']['title'].'</b>'; ?>
    <br><?php echo '<small> Created at :'.$post['Post']['created'].'</small>'; ?></td>
</tr>
<tr>
    <td><?php echo $post['Post']['body'] ?></td>
</tr>


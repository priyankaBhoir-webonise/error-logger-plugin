<!-- File: /app/View/Posts/index.ctp
(edit links added) -->
<?php $this->set('title_for_layout','Posts');?>
<p><?php if($this->access->isLoggedin()){ echo $this->Html->link("Log out", array('controller'=>'users','action' => 'logout')); }
         else { echo $this->Html->link("Log in", array('controller'=>'users','action' => 'login')); }?></p>
<p><?php echo $this->Html->link("Add Post", array('action' => 'add')); ?></p>
<?php echo $this->element('searchbox');?>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <?php
        if($this->access->isLoggedin()){
        echo '<th>Action</th>';
        }
        ?>
        <th>Created</th>
    </tr>
    <!-- Here's where we loop through our $posts array, printing out post info -->
    <?php foreach ($posts as $post): ?>
    <tr>
        <td>
            <?php echo $post['Post']['id']; ?>
        </td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],
            array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td>
            <?php
            if($this->access->isLoggedin()){
            echo $this->Form->postLink(
            'Delete',
            array('action' => 'delete', $post['Post']['id']),
            array('confirm' => 'Are you sure?'));

             echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); }?>
        </td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
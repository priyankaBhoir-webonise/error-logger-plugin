<p><?php echo $this->Html->link("Log out", array('controller'=>'users','action' => 'logout')); ?></p>
<h1>Add Post</h1>
<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
//echo $this->Ajax->submit('submit',array('url'=> array('controller'=>'Posts', 'action'=>'add'), 'update' => 'testdiv'));
//echo $this->Form->end();
?>
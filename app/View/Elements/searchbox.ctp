<h3> search </h3>
<div id="searchbox">
<?php
echo $this->Form->create('post',array('action'=>'/find_data'));
echo $this->Form->input('title');
echo $this->Form->end('search');
?>
</div>
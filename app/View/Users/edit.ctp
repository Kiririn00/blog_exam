<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit User'); ?></legend>
	<?php
	
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('role', array(
		    'options' => array('admin' => 'Admin','author' => 'Author'),
		    'empty' => '(choose one)',
		    'value'=> $user['User']['role']
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

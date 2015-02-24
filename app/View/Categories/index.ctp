<?php
echo $this->Html->link('User index',array(
		'controller' => 'Users',
		'action' => 'index' 
));
?>

<span style="padding-left:2em;"></span>

<?php
echo $this->Html->link('Post index',array(
		'controller' => 'Posts',
		'action' => 'index'
));

?>
<br/><br/>
<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Category', array('action' => 'add')); ?></p>

<table>
    <tr>
        <th>Id</th>
	<th>Name</th>
	<th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($categories as $categories): ?>
    <tr>
	<td><?php echo $categories['Category']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
			$categories['Category']['name'],
			array('action' => 'view', $categories['Category']['id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
		    array('action' => 'delete', $categories['Category']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
			'Edit', array('action' => 'edit', $categories['Category']['id'])
                );
            ?>
    	</td>
        <td>
	    <?php echo $categories['Category']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

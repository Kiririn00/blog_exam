<?php
echo $this->Html->link('User index',array(
		'controller' => 'Users',
		'action' => 'index' 
));
?>

<span style="padding-left:2em;"></span>

<?php
echo $this->Html->link('Category index',array(
		'controller' => 'Categories',
		'action' => 'index'
));

?>
<br/><br/>
<h1>Blog posts</h1>
<p><?php echo $this->Html->link('Add Post', array('action' => 'add')); ?></p>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
	<th>Actions</th>
	<th>Category</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->

    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $post['Post']['title'],
                    array('action' => 'view', $post['Post']['id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $post['Post']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $post['Post']['id'])
                );
            ?>
    	</td>
	<td>
		<?php
		$categories_id = $post['Post']['categories_id']-1;
		echo $categories[$categories_id]['Category']['name'];	
		?>

	</td>
        <td>
            <?php echo $post['Post']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>


<table>
	<tr>
		<th>名前</th>
		<th>性別</th>
		<th>年齢</th>
		<th>action</th>
	</tr>

	<?php foreach($posts as $post): ?>
	<tr>
		<td><?php echo $post["Post"]["last_name"]; ?>　<?php echo $post["Post"]["first_name"]; ?></td>
		<td><?php echo $genders[$post["Post"]["gender_id"]]; ?></td>
		<td><?php echo $post["Post"]["old"]; ?></td>
		<td>
			<?php echo $this->Html->link("編集する", array('action' => 'edit', $post['Post']['id'])); ?>
			<?php echo $this->Form->postLink("削除する", array('action' => 'delete', $post['Post']['id']), array('confirm' => 'Are you sure?')); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<?php unset($post); ?>
</table>

<p><?php echo $this->Html->link("新しく追加", array("action" => "add")); ?></p>
<?php echo $this->Form->create("Post"); ?>
<?php echo $this->Form->input("last_name"); ?>
<?php echo $this->Form->input("first_name"); ?>
<?php echo $this->Form->input("gender_id", array("type" => "select", "options" => $genders)); ?>
<?php echo $this->Form->input("old"); ?>
<?php echo $this->Form->end("保存する"); ?>

<p><?php echo $this->Html->link("戻る", array("action" => "index")); ?></p>
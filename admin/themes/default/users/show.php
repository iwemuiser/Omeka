<?php
$userTitle = strip_formatting($user->username);
if ($userTitle != '') {
    $userTitle = ': &quot;' . html_escape($userTitle) . '&quot; ';
} else {
    $userTitle = '';
}
$userTitle = __('User #%s', $user->id) . $userTitle;
echo head(array('title' => $userTitle, 'bodyclass' => 'themes'));
echo flash();
?>

<h1><?php echo $userTitle; ?></h1>

<?php if (is_allowed('Users', 'edit')): ?>
<p id="edit-item" class="edit-button"><?php 
echo link_to($user, 'edit', __('Edit this User'), array('class'=>'edit')); ?></p>   
<?php endif; ?>

<h2><?php echo __('Username'); ?></h2>
<p><?php echo html_escape($user->username); ?></p>
<h2><?php echo __('Real Name'); ?></h2>
<p><?php echo html_escape($user->name); ?></p>
<h2><?php echo __('Email'); ?></h2>
<p><?php echo html_escape($user->email); ?></p>
    
<?php echo foot();?>

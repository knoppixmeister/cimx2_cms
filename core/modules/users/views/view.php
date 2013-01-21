<h2><?php e($user_data['first_name']." ".$user_data['last_name'])?>	Profile</h2>

{tag:helper:gravatar email="<?php e($user_data['email'])?>"}

<h2>Details</h2>

<b>Role:</b> <?php e($user_data['role_name'])?><br/>
<br/>
Registered on: <?php e(date('d-m-Y', $user_data['created_time']))?><br/>
<br/>
Last login: <?php e(date('d-m-Y', $user_data['last_login_time']))?><br/>
<br/>
Last action: <?php e(date('d-m-Y', $user_data['last_action_time']))?>
<?php
function topmenu()
{
  $user_model = new \App\Models\UserModel();
  $loggedUser = session()->get('loggedUser');
  $user_info = $user_model->find($loggedUser);

  //$modules = $user_model->builder('module_user')->builder('modules')->where('user', $user_model->id);
  $modules = $user_model->join('module_user', 'users.id=module_user.user')
    ->join('modules', 'module_user.module=modules.id')
    ->where('users.id', $user_info->id)
    ->findAll();

  $mdata = [
    ["/dashboard", "Dashboard"]
  ];

  foreach($modules as $module) {
      $mdata[] = [$module->module_path, $module->module_name];
  }

  if ( isset($user_info->friendly_name) && $user_info->friendly_name != '') {
      $mdata[] = ['/auth/logout', 'Logout (' . $user_info->friendly_name . ')'];
  } else {
    $mdata[] = ['/auth/logout', 'Logout (' . $user_info->email . ')'];
  }

  return makemenu($mdata);
}

function makemenu($menudata)
{
  $ret = "<ul class=\"list-inline\">";

  foreach($menudata as [$link, $label] ) {
    $ret .= "<li class=\"list-inline-item border border-dark p-3\">";
    $ret .= "<a href=\"" . site_url($link) . "\" >$label</a>";
    $ret .= "</li>";
  }

  $ret .= "</ul>";
  return $ret;
}
 ?>

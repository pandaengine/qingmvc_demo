<?php return array (
  0 => 
  array (
    'POST' => 
    array (
      'post' => 'post',
    ),
    'GET' => 
    array (
      'users' => 'users/index',
      'login' => 
      array (
        0 => 'login',
        1 => 'index',
      ),
    ),
  ),
  1 => 
  array (
    'GET' => 
    array (
      0 => 
      array (
        'regex' => '~^(?|/user/([^/]+)/([0-9]+)|/user/([0-9]+)()()|/user/([^/]+)()()())$~',
        'routeMap' => 
        array (
          3 => 
          array (
            0 => 'handler0',
            1 => 
            array (
              'name' => 'name',
              'id' => 'id',
            ),
          ),
          4 => 
          array (
            0 => 'handler1',
            1 => 
            array (
              'id' => 'id',
            ),
          ),
          5 => 
          array (
            0 => 'handler2',
            1 => 
            array (
              'name' => 'name',
            ),
          ),
        ),
      ),
    ),
  ),
);
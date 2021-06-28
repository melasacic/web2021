<?php

/*Flight::route('POST /users/registration', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->get_user_by_id($id));
});*/

Flight::route('GET /users/@id', function ($id) {
    Flight::json(Flight::userService()->get_user_by_id($id));
});

Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->add_user($data));
});



Flight::route('PUT /users/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::userService()->update_user($id, $data));
});

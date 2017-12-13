<?php

Route::get("/test", "Test\TestController@test");
Route::get("/delete_array", "Test\TestController@deleteArray");
Route::get("/makeStack/{action}", "Test\TestController@makeStack");     //堆栈


?>

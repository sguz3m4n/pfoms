<?php

return [
    [['GET', 'POST'], '/company', ['Controllers\EmployeeController', 'display']],
    [['GET', 'POST'], '/employee', ['Controllers\EmployeeController', 'display']],
    ['GET', 'pfoms/index.php', ['Controllers\Homepage', 'display']],
    ['GET', 'pfoms/', ['Controllers\Homepage', 'display']],
    [['GET', 'POST'], '/login', ['Controllers\Login', 'show']],
    [['GET', 'POST'], '/logout', ['Controllers\Login', 'logout']],
];
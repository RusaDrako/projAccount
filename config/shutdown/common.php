<?php
namespace config\shutdown;

require_once(__DIR__ . '/funcs_shutdown.php');

\register_shutdown_function('\config\shutdown\shutdown_error');

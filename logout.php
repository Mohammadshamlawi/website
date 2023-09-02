<?php

if (session_id()) {
	session_unset();
}

header('Location: index.html');
exit;

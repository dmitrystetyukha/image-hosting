<?php
function checkSessionLife()
{
    if (isset($_SESSION['last_action']) && (time () - $_SESSION['last_action'] > 3600))
    {
        logoutUser ();
    }
}
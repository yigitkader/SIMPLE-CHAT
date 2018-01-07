<?php

//session_start();

function post($q)
{
    if (isset($_POST[$q])) 
    {
        if (!empty($_POST[$q]))
        {
            return filter($_POST[$q]);  
        }
        else return false;
    }
    else return false;
}

function filter($q)
{
	return htmlspecialchars(trim($q));
}

function oturum($q)
{
    return !empty($_SESSION[$q]) ? $_SESSION[$q] : '';  
    
}





 ?>
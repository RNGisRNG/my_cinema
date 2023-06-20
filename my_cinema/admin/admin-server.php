<?php

//variable
$dateEnd = [];
$dateProjection = "";
$movieResult = [];
$justHour = "";
$justDate = "";

//prepare function
function date_end($dateResult)
{
    $dateEnd = explode("T", $dateResult);
    $dateEnd[0] .= " 23:59:59";

    return $dateEnd[0];
}

function date_project($dateResult)
{
    $dateProjection = str_replace("T", " ", $dateResult);
    $dateProjection .= ":00";

    return $dateProjection;
}

function display_just_hour($dateResult)
{
    $justHour = explode(" ", $dateResult);
    $justHour = explode(":", $justHour[1]);
    $justHour = ($justHour[0] .= ":".$justHour[1]);

    echo $justHour;
}

function display_just_date($dateResult)
{
    $justDate = explode("T", $dateResult);

    echo $justDate[0];
}

function null_minute($movieResult)
{
    if($movieResult == NULL)
    {
         echo "";
    }
    else
    {
        echo floor($movieResult/60)."h ".($movieResult%60)."m";
    }
}

function subs_name_value($subs)
{
    switch ($subs)
    {
        case "VIP":
            $subs = 1;
            break;
        case "GOLD":
            $subs = 2;
            break;
        case "Classic":
            $subs = 3;
            break;
        case "Pass Day":
            $subs = 4;
            break;
        default:
            echo "Staninous <3";
    }
    return $subs;
}

function display_success_message()
{
    if(isset($_POST['add_subs_name']))
        echo "Subscription added successfully !";
    elseif(isset($_POST['update_subs_name']))
        echo "Subscription updated successfully !";
    elseif(isset($_POST['delete_subs_user_id']))
        echo "Subscription deleted successfully !";
}

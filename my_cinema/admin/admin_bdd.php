<?php

// Movie
try {
    $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$sqlQuery = "select name 'genre' from genre order by name";
$cinemaStmt = $db->prepare($sqlQuery);
$cinemaStmt->execute();
$genreResult = $cinemaStmt->fetchAll();

try {
    $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$sqlQuery = "select id from room order by number";
$cinemaStmt = $db->prepare($sqlQuery);
$cinemaStmt->execute();
$roomId = $cinemaStmt->fetchAll();

try {
    $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
} catch (Exception $e) {
    die('Error : ' . $e->getMessage());
}

$sqlQuery = "select name from subscription order by price";
$cinemaStmt = $db->prepare($sqlQuery);
$cinemaStmt->execute();
$subsName = $cinemaStmt->fetchAll();

if(isset($_POST['title']) && (isset($_POST['genre']) && !$_POST['genre'] == "" && isset($_POST['distributor'])))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating
        from movie
            inner join distributor on movie.id_distributor = distributor.id
            inner join movie_genre on movie.id = movie_genre.id_movie
            inner join genre on movie_genre.id_genre = genre.id
        where title like '".$_POST['title']."%' and genre.name like '".$_POST['genre']."' and distributor.name like '".$_POST['distributor']."%'
        order by title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}
elseif(isset($_POST['title']) && isset($_POST['genre']) && !$_POST['genre'] == "")
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating
        from movie
            inner join distributor on movie.id_distributor = distributor.id
            inner join movie_genre on movie.id = movie_genre.id_movie
            inner join genre on movie_genre.id_genre = genre.id
        where title like '".$_POST['title']."%' and genre.name like '".$_POST['genre']."'
        order by title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}
elseif(isset($_POST['title']) && isset($_POST['distributor']))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating
        from movie
            inner join distributor on movie.id_distributor = distributor.id
            inner join movie_genre on movie.id = movie_genre.id_movie
            inner join genre on movie_genre.id_genre = genre.id
        where title like '".$_POST['title']."%' and distributor.name like '".$_POST['distributor']."%'
        order by title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}
elseif(isset($_POST['distributor']) && isset($_POST['genre']) && !$_POST['genre'] == "")
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating
        from movie
            inner join distributor on movie.id_distributor = distributor.id
            inner join movie_genre on movie.id = movie_genre.id_movie
            inner join genre on movie_genre.id_genre = genre.id
        where genre.name like '".$_POST['genre']."' and distributor.name like '".$_POST['distributor']."%'
        order by distributor";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}
elseif(isset($_POST['title']))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating 
        from movie 
            inner join distributor on movie.id_distributor = distributor.id 
            inner join movie_genre on movie.id = movie_genre.id_movie 
            inner join genre on movie_genre.id_genre = genre.id
        where title like '".$_POST['title']."%' 
        order by title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}
elseif(isset($_POST['genre']))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating 
        from movie 
            inner join distributor on movie.id_distributor = distributor.id 
            inner join movie_genre on movie.id = movie_genre.id_movie 
            inner join genre on movie_genre.id_genre = genre.id
        where genre.name like '%".$_POST['genre']."%'
        order by title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}
elseif(isset($_POST['distributor']))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, YEAR(release_date) 'release_date', distributor.name 'distributor', rating 
        from movie 
            inner join distributor on movie.id_distributor = distributor.id 
            inner join movie_genre on movie.id = movie_genre.id_movie 
            inner join genre on movie_genre.id_genre = genre.id
        where distributor.name like '".$_POST['distributor']."%'
        order by distributor, title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $movieResult = $cinemaStmt->fetchAll();
}

// Schedule
if(isset($_POST['date_projection']))
{
    $dateEnd = date_end($_POST['date_projection']);
    $dateProjection = date_project($_POST['date_projection']);

    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select movie.id 'id', title, director, genre.name 'genre', duration, date_begin, number, room.name 'roomName'
        from movie
            inner join movie_genre on movie.id = movie_genre.id_movie
            inner join genre on movie_genre.id_genre = genre.id
            inner join movie_schedule on movie.id = movie_schedule.id_movie
            inner join room on movie_schedule.id_room = room.id
        where date_begin between '".$dateProjection."' and '".$dateEnd."'
        order by date_begin, title";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $scheduleResult = $cinemaStmt->fetchAll();
}

if(isset($_POST['movie_id']) && isset($_POST['id_room']) && isset($_POST['schedule_date_begin']))
{
    $scheduleMovie = $_POST['movie_id'];
    $scheduleRoom = $_POST['id_room'];
    $scheduleDateBegin = $_POST['schedule_date_begin'];

    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "insert into movie_schedule (id_movie, id_room, date_begin)
                values ($scheduleMovie, $scheduleRoom, '$scheduleDateBegin')";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
}

// Member
if(isset($_POST['member_name']))
{
    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    $sqlQuery = "select user.id 'id', firstname, lastname, SUBSTR(birthdate, 1, 10) 'birthdate', address, zipcode, city, SUBSTR(country, 1, 2) 'country', email, subscription.name 'subs'
        from user
            inner join membership on user.id = membership.id_user
            inner join subscription on membership.id_subscription = subscription.id
        where firstname like '".$_POST['member_name']."%' or lastname like '".$_POST['member_name']."%'
        order by firstname, lastname";

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
    $memberResult = $cinemaStmt->fetchAll();
}

if((isset($_POST['subs_user_id']) && (isset($_POST['add_subs_name']) || isset($_POST['update_subs_name']))) || isset($_POST['delete_subs_user_id']))
{
    $subsUserId = $_POST['subs_user_id'];
    $subsDateBegin = date('y-m-d h:i:s');

    try {
        $db = new PDO('mysql:host=localhost;dbname=cinema;charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }

    if(isset($_POST['add_subs_name']))
    {
        $addSubsName = $_POST['add_subs_name'];
        $subsId = subs_name_value($addSubsName);

        $sqlQuery = "insert into membership (id_user, id_subscription, date_begin)
                    values ($subsUserId, $subsId, '$subsDateBegin')";
    }
    elseif(isset($_POST['update_subs_name']))
    {
        $updateSubsName = $_POST['update_subs_name'];
        $subsId = subs_name_value($updateSubsName);

        $sqlQuery = "update membership
                    set id_subscription = $subsId, date_begin = '$subsDateBegin'
                    where id_user = $subsUserId";
    }
    elseif(isset($_POST['delete_subs_user_id']))
    {
        $deleteSubsUserId = $_POST['delete_subs_user_id'];

        $sqlQuery = "delete from membership
                    where id_user = $deleteSubsUserId";
    }

    $cinemaStmt = $db->prepare($sqlQuery);
    $cinemaStmt->execute();
}




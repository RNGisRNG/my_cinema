<?php

include_once('./admin-server.php');
include_once('./admin_bdd.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Administrator</title>
    <link href="style.css" rel="stylesheet">
</head>

<body>
<div class="body">
    <header>
        <div class="header_width">
            <h1>Administrator</h1>
            <nav>
                <div>
                    <h3>Movie</h3>
                    <ul>
                        <li><a href="#title_section">Search movie</a></li>
                        <li><a href="#schedule_section">Schedule</a></li>
                    </ul>
                </div>
                <div>
                    <h3>Member</h3>
                    <ul>
                        <li><a href="#member_section">Search by name</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <main>
        <div class="sections">
            <section id="title_section">
                <h2>Movie</h2>
                <div class="form_flex">
                    <h4>Search</h4>
                    <form action="./admin.php" method="post" class="form">
                        <label for="title">Title :</label>
                        <input type="text" name="title" id="title" size="20" maxlength="20">
                        <label for="distributor">Distributor :</label>
                        <input type="text" name="distributor" id="distributor" size="20" maxlength="20">
                        <label for="genre">Genre :</label>
                        <select name="genre" id="genre">
                            <option value=""><?= "None"; ?></option>
                            <?php foreach ($genreResult as $genre) { ?>
                                <option value="<?= $genre['genre']; ?>"><?= $genre['genre']; ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit">Submit</button>
                    </form>
                </div>
                <?php if (isset($_POST['title']) || isset($_POST['genre']) || isset($_POST['distributor'])) { ?>
                    <div class="result_tab">
                        <table>
                            <caption>--- MOVIE RESULT ---</caption>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Director</th>
                                <th>Date</th>
                                <th>Duration</th>
                                <th>Genre</th>
                                <th>Distributor</th>
                                <th>Rating</th>
                            </tr>
                            <?php foreach ($movieResult as $movieValue) { ?>
                                <tr>
                                    <td><?= $movieValue['id']; ?></td>
                                    <td><?= $movieValue['title']; ?></td>
                                    <td><?= $movieValue['director']; ?></td>
                                    <td><?= $movieValue['release_date']; ?></td>
                                    <td class="movie_duration"><?php null_minute($movieValue['duration']); ?></td>
                                    <td><?= $movieValue['genre']; ?></td>
                                    <td><?= $movieValue['distributor']; ?></td>
                                    <td><?= $movieValue['rating']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
            </section>
            <section>
                <div id="schedule_section">
                    <h2>Schedule</h2>
                    <div class="form_flex">
                        <h4>Search</h4>
                        <form action="./admin.php" method="post" id="by_date">
                            <label for="date_projection">Date projection :</label>
                            <input type="datetime-local" id="date_projection" name="date_projection"
                                   min="2018-01-01T00:00" max="2023-12-31T00:00">
                            <button type="submit" form="by_date" value="Submit">Submit</button>
                        </form>
                    </div>
                    <?php if (isset($_POST['date_projection']) || isset($_POST['schedule_title'])) { ?>
                        <div class="result_tab">
                            <table>
                                <caption>--- SCHEDULE RESULT ---</caption>
                                <tr>
                                    <th><?php display_just_date($_POST['date_projection']); ?></th>
                                    <th>Title</th>
                                    <th>Director</th>
                                    <th>Duration</th>
                                    <th>Genre</th>
                                    <th>Room number</th>
                                    <th>Room name</th>
                                </tr>
                                <?php foreach ($scheduleResult as $scheduleValue) { ?>
                                    <tr>
                                        <td><?php display_just_hour($scheduleValue['date_begin']); ?></td>
                                        <td><?= $scheduleValue['title']; ?></td>
                                        <td><?= $scheduleValue['director']; ?></td>
                                        <td class="movie_duration"><?php null_minute($scheduleValue['duration']); ?></td>
                                        <td><?= $scheduleValue['genre']; ?></td>
                                        <td><?= $scheduleValue['number']; ?></td>
                                        <td><?= $scheduleValue['roomName']; ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    <?php } ?>
                    <div class="border_top form_flex">
                        <h4>Add Schedule</h4>
                        <form action="./admin.php" method="post">
                            <label for="movie_id">Movie ID :</label>
                            <input type="number" id="movie_id" name="movie_id" min="1">
                            <label for="id_room">Choose a room :</label>
                            <select name="id_room" id="id_room">
                                <?php foreach ($roomId as $roomIdValue) { ?>
                                    <option value="<?= $roomIdValue['id']; ?>"><?= $roomIdValue['id']; ?></option>
                                <?php } ?>
                            </select>
                            <label for="schedule_date_begin">Date projection :</label>
                            <input type="datetime-local" id="schedule_date_begin" name="schedule_date_begin"
                                   min="2018-01-01T00:00" max="2023-12-31T00:00">
                            <button type="submit" value="Submit">Submit</button>
                        </form>
                    </div>
                    <?php if(isset($_POST['movie_id']) && isset($_POST['id_room']) && isset($_POST['schedule_date_begin']))
                    { ?>
                        <p class="successfully_message">Schedule added successfully !</p>
                    <?php } ?>
                </div>
            </section>
            <section id="member_section">
                <h2>Member</h2>
                <div class="form_flex">
                    <h4>Search</h4>
                    <form action="./admin.php" method="post" id="name_of_member">
                        <label for="member_name">Member's name :</label>
                        <input type="text" name="member_name" id="member_name" size="20" maxlength="20">
                        <button type="submit" form="name_of_member" value="Submit">Submit</button>
                    </form>
                </div>
                <?php if (isset($_POST['member_name'])) { ?>
                    <div class="result_tab">
                        <table>
                            <caption>--- MEMBER RESULT ---</caption>
                            <tr>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Birthdate</th>
                                <th>Address</th>
                                <th>Zipcode</th>
                                <th>City</th>
                                <th>Country</th>
                                <th>Email</th>
                                <th>Subscription</th>
                            </tr>
                            <?php foreach ($memberResult as $memberValue) { ?>
                                <tr>
                                    <td><?= $memberValue['id']; ?></td>
                                    <td><?= $memberValue['firstname']; ?></td>
                                    <td><?= $memberValue['lastname']; ?></td>
                                    <td><?= $memberValue['birthdate']; ?></td>
                                    <td><?= $memberValue['address']; ?></td>
                                    <td><?= $memberValue['zipcode']; ?></td>
                                    <td><?= $memberValue['city']; ?></td>
                                    <td><?= $memberValue['country']; ?></td>
                                    <td><?= $memberValue['email']; ?></td>
                                    <td><?= $memberValue['subs']; ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                <?php } ?>
                <div class="border_top form_flex">
                    <h4>Add Subscription</h4>
                    <form action="./admin.php" method="post">
                        <label for="subs_user_id">User ID :</label>
                        <input type="number" id="subs_user_id" name="subs_user_id" min="1">
                        <label for="add_subs_name">Choose a subscription :</label>
                        <select name="add_subs_name" id="add_subs_name">
                            <?php foreach ($subsName as $subsNameValue) { ?>
                                <option value="<?= $subsNameValue['name']; ?>"><?= $subsNameValue['name']; ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" value="Submit">Submit</button>
                    </form>
                </div>
                <div class="border_top form_flex">
                    <h4>Update Subscription</h4>
                    <form action="./admin.php" method="post">
                        <label for="subs_user_id">User ID :</label>
                        <input type="number" id="subs_user_id" name="subs_user_id" min="1">
                        <label for="update_subs_name">Choose a subscription :</label>
                        <select name="update_subs_name" id="update_subs_name">
                            <?php foreach ($subsName as $subsNameValue) { ?>
                                <option value="<?= $subsNameValue['name']; ?>"><?= $subsNameValue['name']; ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" value="Submit">Submit</button>
                    </form>
                </div>
                <div class="border_top form_flex">
                    <h4>Delete Subscription</h4>
                    <form action="./admin.php" method="post">
                        <label for="delete_subs_user_id">User ID :</label>
                        <input type="number" id="delete_subs_user_id" name="delete_subs_user_id" min="1">
                        <button type="submit" value="Submit">Submit</button>
                    </form>
                </div>
                <p class="successfully_message"><?php display_success_message(); ?></p>
            </section>
        </div>
    </main>
</div>
</body>
</html>
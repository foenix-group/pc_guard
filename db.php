<?php

$host = "localhost";
$username = "root";
$password = "";
$charset = "utf8";
$dbname = "pcguardi_db";

$dsn = "mysql:host=$host;charset=$charset";
$pdoObj = new PDO($dsn, $username, $password);
$pdoObj->setAttribute(PDO::ATTR_ERRMODE,
PDO::ERRMODE_EXCEPTION);

$dbQuery= "CREATE DATABASE IF NOT EXISTS `$dbname`
           DEFAULT CHARACTER SET utf8
           COLLATE utf8_persian_ci;";

$pdoObj->query($dbQuery);
$pdoObj->query("use `$dbname`;");

$usersTbl= "CREATE TABLE IF NOT EXISTS users(
    userID int(11) NOT NULL auto_increment,
    pass varchar(200) NOT NULL,
    fullName varchar(100) NOT NULL,
    age int(10),
    gender varchar(10),
    email varchar(200) UNIQUE,
    fullAddress TEXT,
    phoneNumber varchar(12) NOT NULL,
    nationalCode varchar(11),
    resome varchar(100),
    maritalStatus varchar(20),
    Access varchar(10) NOT NULL DEFAULT 'client',
    request varchar(10) NOT NULL DEFAULT 0,
    imageProfile varchar(100),
    PRIMARY KEY (userID)
    )";
    $results = $pdoObj->query($usersTbl);

$chatTbl= "CREATE TABLE IF NOT EXISTS chat(
     chatID int(11) NOT NULL auto_increment,
     userName varchar(100) NOT NULL,
     chatMessage TEXT,
     chatDate timestamp DEFAULT current_timestamp(),
     imageName varchar(100),
     imageProfile varchar(100),
     userID2 int(11) NOT NULL,
     destination varchar(100) NOT NULL DEFAULT 'employee',
     PRIMARY KEY (chatID),
     FOREIGN KEY (userID2) REFERENCES users (userID) ON DELETE RESTRICT ON UPDATE CASCADE
     )";
     $results = $pdoObj->query($chatTbl);

     $emailMessageTbl= "CREATE TABLE IF NOT EXISTS emailMessage(
        messageID int(11) NOT NULL auto_increment,
        fullName varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        messageText TEXT,
        messageDate DATETIME NOT NULL,
        PRIMARY KEY (messageID)
        )";
        $results = $pdoObj->query($emailMessageTbl);

        $ticketTbl= "CREATE TABLE IF NOT EXISTS buyingTicket(
            ticketID int(11) NOT NULL auto_increment,
            userID int(11) NOT NULL,
            num int(2) NOT NULL,
            title varchar(255) NOT NULL,
            PRIMARY KEY (ticketID),
            FOREIGN KEY (userID) REFERENCES users (userID) ON DELETE RESTRICT ON UPDATE CASCADE
            )";
            $results = $pdoObj->query($ticketTbl);

?>
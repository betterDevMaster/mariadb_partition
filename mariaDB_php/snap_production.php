<?php
$hostname = "localhost";
$username = "root";
$password = "1234"; // your Maria DB's password
$db = "snap_production";

//If you want to create new database, do this
    // Create connection
    $dbconnect = new mysqli($servername, $username, $password);
    // Check connection
    if ($dbconnect->connect_error) {
        die("Connection failed: " . $dbconnect->connect_error);
    }

    // Drop database
    $sql_drop_db = "DROP DATABASE IF EXISTS ".$db;
    if ($dbconnect->query($sql_drop_db) === TRUE) {
        echo "Database droped successfully"."<br>";
    } else {
        echo "Error droping database: " . $dbconnect->error;
    }

    // Create database
    $sql_create_db = "CREATE DATABASE ".$db;
    if ($dbconnect->query($sql_create_db) === TRUE) {
        echo "Database created successfully"."<br>";
    } else {
        echo "Error creating database: " . $dbconnect->error;
    }

    $dbconnect=mysqli_connect($hostname,$username,$password,$db);

    $tbl_names = array('inmate_tablet_audits','tphone_station_audit_logs');
 
    foreach($tbl_names as $tbl_name) {
        generateTableWithPartition($dbconnect, $tbl_name);
    }

// //If you want to use your existing database, do this (Above must be commented)
//     $dbconnect=mysqli_connect($hostname,$username,$password,$db);

//     if ($dbconnect->connect_error) {
//     die("Database connection failed: " . $dbconnect->connect_error);
//     }

//     // $tbl_names = array('audit_trails');
//     $tbl_names = array('audit_trails','cdrs','deposits','recordings','station_stats');

//     foreach($tbl_names as $tbl_name) {
//         generateTableWithPartition($dbconnect, $tbl_name);
//     }




function generateTableWithPartition($dbconnect, $tbl_name) {
// Sql to create table
    // If you want to create new table, like this
        // Sql to drop table
        $sql_create_tbl = "DROP TABLE IF EXISTS ".$tbl_name;
        if(!mysqli_query($dbconnect, $sql_create_tbl)) {
            die('Could not delete database: ' . mysql_error());
        }

        // Sql to create new table with partitions, indexing value is id, the nubmers are quere value
        $sql_create_tbl =
            "CREATE TABLE ".$tbl_name." (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY
            ) ENGINE=InnoDB
            PARTITION BY RANGE (id) (
                PARTITION ".$tbl_name."_p000000157 VALUES LESS THAN (1),
                PARTITION ".$tbl_name."_p000000158 VALUES LESS THAN (2),
                PARTITION ".$tbl_name."_p000000159 VALUES LESS THAN (3),
                PARTITION ".$tbl_name."_p000000160 VALUES LESS THAN (4),
                PARTITION ".$tbl_name."_p000000161 VALUES LESS THAN (5),
                PARTITION ".$tbl_name."_p000000162 VALUES LESS THAN (6),
                PARTITION ".$tbl_name."_p000000163 VALUES LESS THAN (7),
                PARTITION ".$tbl_name."_p000000164 VALUES LESS THAN (8),
                PARTITION ".$tbl_name."_p000000165 VALUES LESS THAN (9),
                PARTITION ".$tbl_name."_p000000166 VALUES LESS THAN (10),
                PARTITION ".$tbl_name."_p000000167 VALUES LESS THAN (11),
                PARTITION ".$tbl_name."_p000000168 VALUES LESS THAN (12),
                PARTITION ".$tbl_name."_p000000169 VALUES LESS THAN (13),
                PARTITION ".$tbl_name."_p000000170 VALUES LESS THAN (14),
                PARTITION ".$tbl_name."_p000000171 VALUES LESS THAN (15),
                PARTITION ".$tbl_name."_p000000172 VALUES LESS THAN (16),
                PARTITION ".$tbl_name."_p000000173 VALUES LESS THAN (17),
                PARTITION ".$tbl_name."_p000000174 VALUES LESS THAN (18),
                PARTITION ".$tbl_name."_p000000175 VALUES LESS THAN (19),
                PARTITION ".$tbl_name."_p000000176 VALUES LESS THAN (20),
                PARTITION ".$tbl_name."_p000000177 VALUES LESS THAN (21),
                PARTITION ".$tbl_name."_p000000178 VALUES LESS THAN (22),
                PARTITION ".$tbl_name."_p000000179 VALUES LESS THAN (23),
                PARTITION ".$tbl_name."_p000000180 VALUES LESS THAN (24),
                PARTITION ".$tbl_name."_p000000181 VALUES LESS THAN (MAXVALUE)
            )";
        if (!mysqli_query($dbconnect, $sql_create_tbl)) {
            echo "Error creating table: " . $dbconnect->error;
        } else {
            echo $tbl_name."succeeded"."<br>";
        }

// // Sql to alter table
//     // If the table is existing and you don't like to drop it, like this (And above command must be commented)
//         // Sql to set the primary key(neccessary)
//         $sql_alter_tbl =
//             "ALTER TABLE ".$tbl_name." DROP PRIMARY KEY, ADD PRIMARY KEY (id)";
//         if (!mysqli_query($dbconnect, $sql_alter_tbl)) {
//             echo "Error altering table: " . $dbconnect->error;
//         } else {
//             echo $tbl_name."primary_succeeded"."<br>";
//         }

//         // Sql to set the partitions
//         $sql_alter_tbl =
//             "ALTER TABLE ".$tbl_name."
//             PARTITION BY RANGE (id) (
//                 PARTITION ".$tbl_name."_p000000157 VALUES LESS THAN (1),
//                 PARTITION ".$tbl_name."_p000000158 VALUES LESS THAN (2),
//                 PARTITION ".$tbl_name."_p000000159 VALUES LESS THAN (3),
//                 PARTITION ".$tbl_name."_p000000160 VALUES LESS THAN (4),
//                 PARTITION ".$tbl_name."_p000000161 VALUES LESS THAN (5),
//                 PARTITION ".$tbl_name."_p000000162 VALUES LESS THAN (6),
//                 PARTITION ".$tbl_name."_p000000163 VALUES LESS THAN (7),
//                 PARTITION ".$tbl_name."_p000000164 VALUES LESS THAN (8),
//                 PARTITION ".$tbl_name."_p000000165 VALUES LESS THAN (9),
//                 PARTITION ".$tbl_name."_p000000166 VALUES LESS THAN (10),
//                 PARTITION ".$tbl_name."_p000000167 VALUES LESS THAN (11),
//                 PARTITION ".$tbl_name."_p000000168 VALUES LESS THAN (12),
//                 PARTITION ".$tbl_name."_p000000169 VALUES LESS THAN (13),
//                 PARTITION ".$tbl_name."_p000000170 VALUES LESS THAN (14),
//                 PARTITION ".$tbl_name."_p000000171 VALUES LESS THAN (15),
//                 PARTITION ".$tbl_name."_p000000172 VALUES LESS THAN (16),
//                 PARTITION ".$tbl_name."_p000000173 VALUES LESS THAN (17),
//                 PARTITION ".$tbl_name."_p000000174 VALUES LESS THAN (18),
//                 PARTITION ".$tbl_name."_p000000175 VALUES LESS THAN (19),
//                 PARTITION ".$tbl_name."_p000000176 VALUES LESS THAN (20),
//                 PARTITION ".$tbl_name."_p000000177 VALUES LESS THAN (21),
//                 PARTITION ".$tbl_name."_p000000178 VALUES LESS THAN (22),
//                 PARTITION ".$tbl_name."_p000000179 VALUES LESS THAN (23),
//                 PARTITION ".$tbl_name."_p000000180 VALUES LESS THAN (24),
//                 PARTITION ".$tbl_name."_p000000181 VALUES LESS THAN (MAXVALUE)
//             )";    
//         if (!mysqli_query($dbconnect, $sql_alter_tbl)) {
//             echo "Error altering table: " . $dbconnect->error;
//         } else {
//             echo $tbl_name."partition_succeeded"."<br>";
//         }

//         //If You need to add more partitions after that. 
//         //You don't have to specify the partition scheme again. You can just add the partition and its constraints.
//         // Sql to set the partitions
//         $sql_alter_tbl =
//             "ALTER TABLE ".$tbl_name."
//             REORGANIZE PARTITION ".$tbl_name."_p000000181 INTO (
//                 PARTITION ".$tbl_name."_p000000181 VALUES LESS THAN (25),
//                 PARTITION ".$tbl_name."_p000000182 VALUES LESS THAN (26),
//                 PARTITION ".$tbl_name."_p000000183 VALUES LESS THAN (27),
//                 PARTITION ".$tbl_name."_p000000184 VALUES LESS THAN (28),
//                 PARTITION ".$tbl_name."_p000000185 VALUES LESS THAN (29),
//                 PARTITION ".$tbl_name."_p000000186 VALUES LESS THAN (30),
//                 PARTITION ".$tbl_name."_p000000187 VALUES LESS THAN (MAXVALUE)
//             )";    
//         if (!mysqli_query($dbconnect, $sql_alter_tbl)) {
//             echo "Error altering table: " . $dbconnect->error;
//         } else {
//             echo $tbl_name."partition_add_succeeded"."<br>";
//         }
}



$dbconnect->close();
?>
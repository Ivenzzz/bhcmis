<?php

function getTotalResidents($conn) {
    $sql = "SELECT COUNT(*) AS total_residents FROM residents";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total_residents']; 
    } else {
        return 0;
    }
}


function getTotalHouseholds($conn) {
    $sql = "SELECT COUNT(*) AS total_households FROM household";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $data = mysqli_fetch_assoc($result);   
        return $data['total_households'];
    } else {
        return 0;
    }
}


function getTotalPregnancies($conn) {
    $sql = "SELECT COUNT(*) AS total_pregnancies FROM pregnancy";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total_pregnancies'];
    } else {
        return 0;
    }
}

function getTotalFamilies($conn) {
    $sql = "SELECT COUNT(*) AS total_families FROM families";
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_families']; 
    } else {
        return false;
    }
}

?>

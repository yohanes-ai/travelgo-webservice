<?php

include "connection.php";

$id = $_GET['id'];
$deletePackage = "DELETE FROM m_package WHERE id = '".$id."' ";
$saveDeletePackage = $conn->query($deletePackage);

$deletePackagePhoto = "DELETE FROM m_package_photo WHERE packageID = '".$id."' ";
$saveDeletePackagePhoto = $conn->query($deletePackagePhoto);

$deleteTourPack = "DELETE FROM m_tourpack WHERE package_id = '".$id."' ";
$saveDeleteTourPack = $conn->query($deleteTourPack);

header('Location: ../admin/package.php');

?>
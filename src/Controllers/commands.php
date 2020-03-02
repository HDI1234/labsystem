<?php

//GET
//
//get all students
function getAllStudents($db)
{
    $sql = 'SELECT * FROM Student ORDER BY id';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get student by id
function getStudent($db, $StudentId){
$sql = 'SELECT * FROM Student WHERE id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $StudentId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get student by gender
function getStudentGender($db, $StudentGender)
{
$sql = 'SELECT * FROM Student WHERE gender LIKE :gender';
$stmt = $db->prepare ($sql);
$id = $StudentGender;
$stmt->bindParam(':gender', $id, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getStudentColor($db, $StudentColor)
{
$sql = 'SELECT * FROM Student WHERE fav_color LIKE :fav_color';
$stmt = $db->prepare ($sql);
$id = $StudentColor;
$stmt->bindParam(':fav_color', $id, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//POST
//
//create student
function createStudent($db,$form_data){
    $sql = 'INSERT INTO Student (`name`, `email`, `gender`, `fav_color`, `future_job`) VALUES (:name, :email, :gender, :fav_color, :future_job)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':name', $form_data['name']);
    $stmt->bindParam(':email', $form_data['email']);
    $stmt->bindParam(':gender', $form_data['gender']);
    $stmt->bindParam(':fav_color', $form_data['fav_color']);
    $stmt->bindParam(':future_job', $form_data['future_job']);
    $stmt->execute();
    return $db->lastInsertID(); //Insert last number 
}

//DELETE
//delete student
function deleteStudent($db, $StudentId)
{
$sql = 'DELETE FROM Student WHERE id = :id'; 
$stmt = $db->prepare ($sql);
$id = (int) $StudentId;
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
}

//Delete student by gender
function deleteStudentGender($db, $StudentGender)
{
$sql = 'DELETE FROM Student WHERE gender = :gender'; 
$stmt = $db->prepare ($sql);
$id = $StudentGender;
$stmt->bindParam(':gender', $id, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//Delete student by fav_color
function deleteStudentColor($db, $StudentColor)
{
$sql = 'DELETE FROM Student WHERE fav_color = :fav_color'; 
$stmt = $db->prepare ($sql);
$id = $StudentColor;
$stmt->bindParam(':fav_color', $id, PDO::PARAM_STR);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//PUT
//
//Edit Student
function editStudent($db, $form_data, $StudentId)
{
$sql = 'UPDATE Student SET name = :name, email = :email, gender = :gender, fav_color = :fav_color, future_job = :future_job WHERE id = :id';
$stmt = $db->prepare ($sql);
$id = (int) $StudentId;
$stmt->bindParam(':name', $form_data['name']);
$stmt->bindParam(':email', $form_data['email']);
$stmt->bindParam(':gender', $form_data['gender']);
$stmt->bindParam(':fav_color', $form_data['fav_color']);
$stmt->bindParam(':future_job', $form_data['future_job']);
$stmt->bindParam(':id', $StudentId, PDO::PARAM_INT);
$stmt->execute();

$sql = 'SELECT * FROM Student WHERE id = :id';
$stmt = $db->prepare ($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
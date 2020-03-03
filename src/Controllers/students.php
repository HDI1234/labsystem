<?php

use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include productsProc.php file
include __DIR__ . '/commands.php';

//read table products
$app->get('/students', function (Request $request, Response $response, array $arg){
  $data = getAllStudents($this->db);
  return $this->response->withJson(array("data successfully fetched" => $data), 200);
});

//request table products by condition
$app->get('/students/[{id}]', function ($request, $response, $args){
    $labId = $args['id'];
   if (!is_numeric($labId)) {
      return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
  $data = getStudent($this->db,$labId);
  if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 404);
 }
   return $this->response->withJson(array('data' => $data), 200);
});

$app->get('/students/gender/[{gender}]', function ($request, $response, $args){
  $gender = $args['gender'];
$data = getStudentGender($this->db,$gender);
if (empty($data)) {
  return $this->response->withJson(array('error' => 'no data'), 404);
}
 return $this->response->withJson(array('data' => $data), 200);
});

$app->get('/students/color/[{color}]', function ($request, $response, $args){
  $color = $args['color'];
$data = getStudentColor($this->db,$color);
if (empty($data)) {
  return $this->response->withJson(array('error' => 'no data'), 404);
}
 return $this->response->withJson(array('data' => $data), 200);
});

$app->post('/student', function ($request, $response, $args) {
  $form_data = $request->getParsedBody();
  $data = createStudent($this->db, $form_data);
  if ($data <= 0) {
    return $this->response->withJson(array('error' => 'Failed to Create'), 500);
  }
  return $this->response->withJson(array('add data' => 'Successfully created'), 200);
});

$app->delete('/student/[{id}]', function ($request, $response, $args){
  $labId = $args['id'];
 if (!is_numeric($labId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
 }
$data = deleteStudent($this->db,$labId);
if (empty($data)) {
  return $this->response->withJson(array('data' => 'Deleted'), 200);
}
 return $this->response->withJson(array('Error' => "Not deleted yet"), 404);
});

$app->delete('/student/gender/[{gender}]', function ($request, $response, $args){
  $labId = $args['gender'];
$data = deleteStudentGender($this->db,$labId);
if (empty($data)) {
  return $this->response->withJson(array('data' => 'Deleted'), 200);
}
 return $this->response->withJson(array('Error' => "Not deleted yet"), 404);
});

$app->delete('/student/color/[{color}]', function ($request, $response, $args){
  $labId = $args['color'];
$data = deleteStudentColor($this->db,$labId);
if (empty($data)) {
  return $this->response->withJson(array('data' => 'Deleted'), 200);
}
 return $this->response->withJson(array('Error' => "Not deleted yet"), 404);
});


$app->put('/student/[{id}]', function ($request, $response, $args){
  $labId = $args['id'];
  $form_data = $request->getParsedBody();
 if (!is_numeric($labId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
 }
$data = editStudent($this->db, $form_data, $labId);
 return $this->response->withJson(array('data' => $data ), 200);
});









<?php

require_once 'model/ToDoGateway.php';
require_once 'model/ValidationException.php';


class TodoService {
    
    private $todoGateway= NULL;
    
    private function openDb() {
        if (!mysql_connect("127.0.0.1", "root")) {
            throw new Exception("Connection to the database server failed!");
        }
        if (!mysql_select_db("crud")) {
            throw new Exception("No mvc-crud database found on database server.");
        }
    }
    
    private function closeDb() {
        mysql_close();
    }
  
    public function __construct() {
        $this->todoGateway = new TodoGateway();
    }
    
    public function getAllTodos($order) {
        try {
            $this->openDb();
            $res = $this->todoGateway->selectAll($order);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function getTodo($id) {
        try {
            $this->openDb();
            $res = $this->todoGateway->selectById($id);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
       return $this->ToDoGateway->find($id);
    }
    
    private function validateTodoParams( $name, $status ) {
        $errors = array();
        if ( !isset($name) || empty($name) ) {
            $errors[] = 'Name is required';
        }
        if ( empty($errors) ) {
            return;
        }
        throw new ValidationException($errors);
    }
    
    public function createNewTodo( $name, $status) {
        try {
            $this->openDb();
            $this->validateTodoParams($name, $status);
            $res = $this->todoGateway->insert($name, $status);
            $this->closeDb();
            return $res;
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
    
    public function deleteTodo($id) {
        try {
            $this->openDb();
            $res = $this->todoGateway->delete($id);
            $this->closeDb();
        } catch (Exception $e) {
            $this->closeDb();
            throw $e;
        }
    }
   
}

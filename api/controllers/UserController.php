<?php
  class UserController {
    private User $userModel;
    public function __construct(Database $db) {
      $this->userModel = new User($db);
    }

    public function index() : void {
      $users = $this->userModel->getAll();
      if ($users) {
        echo json_encode($users);
      } else {
        echo json_encode(array('message' => 'not found'));
      }
    }
    public function show(array $param) : void {
      $user = $this->userModel->find($param['id']);
      if ($user) {
        echo json_encode($user);
      } else {
        echo json_encode(array('message' => 'not found'));
      }
    }
    public function create() : void {
      parse_str(file_get_contents('php://input'),  $requestData);
      $userExisted = $this->userModel->existed($requestData['email'], $requestData['phone']);

      if ($userExisted) {
        echo json_encode(array('message' => 'user existed'));
      } else {
        $this->userModel->create($requestData);
        $requestData['message'] = 'Created successfully';
        echo json_encode($requestData);
      }
    }
  }
?>
<?php
  class AddressController {
    private Address $addressModel;
    public function __construct(Database $db) {
      $this->addressModel = new Address($db);
    }

    public function index() : void {
      $addresses= $this->addressModel->getAll();
      if ($addresses) {
        echo json_encode($addresses);
      } else {
        echo json_encode(array('message' => 'not found'));
      }
    }
  }
<? php
  class Customer {
    $customerID;
    $customerName;
    $database;

    function __construct($customerID, $database) {
      $this->customerID = $customerID;
      $this->database = $database;

      $sql = file_get_contents('sql/getCustomer.sql');
    	$params = array(
    		'customerid' => $customerID
    	);
    	$statement = $database->prepare($sql);
    	$statement->execute($params);
    	$customers = $statement->fetchAll(PDO::FETCH_ASSOC);

    	$customer = $customers[0];
      $name = $customer['customerName'];
      $this->customerName = $name
      $this->customerName = $customerName;
    }

  }
?>

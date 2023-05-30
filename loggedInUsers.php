<?php
// Function to count the number of logged-in users
use Aws\DynamoDb\DynamoDbClient;

// Set up the DynamoDB client with your AWS credentials and configuration
$client = new DynamoDbClient([
    'region' => 'us-east-1',
    'version' => 'latest',
    'credentials' => [
        'key' => 'YOUR_AWS_ACCESS_KEY',
        'secret' => 'YOUR_AWS_SECRET_ACCESS_KEY',
    ],
]);

// Perform a scan operation to retrieve the logged-in users
$params = [
    'TableName' => 'GuestBook',
    'FilterExpression' => 'LoggedIn = :loggedIn',
    'ExpressionAttributeValues' => [
        ':loggedIn' => ['BOOL' => true],
    ],
];

$result = $client->scan($params);

$items = $result['Items'];

foreach ($items as $item) {
    $email = $item['Email']['S'];
    $loginTime = $item['LoginTime']['S'];

    echo "Email: " . $email . "<br>";
    echo "Login Time: " . $loginTime . "<br>";
    echo "<br>";
}


?>


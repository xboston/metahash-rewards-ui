<?php declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use MetahashPro\Rewards;

// Set timezone to match Metahash.
date_default_timezone_set('UTC');
// Allow enough memory to complete transactions.
ini_set('memory_limit', '1024M');


// Add any addresses that get paid different percentages from default percentage.
$superAddresses = [
    '0x00fa2a5279f8f0fd2f0f9d3280ad70403f01f9d62f52373833' => 99, // Pays 99% to specified address.
];
// Set ui information.
$nodeInfo = [
    'name' => 'Daisy || metahashpro.com || EU || 95% Daily',
];
// Set node information.
$nodes = [
    'address'        => '0x00d5b768fee94349103e2f69484dff207a3bbb2a5077defd6e', // Node address.
    'private_key'    => '', // Node private Key.
    'data'           => '', // Data sent with transaction.
    'percentage'     => 95, // Default percentage paid to delegators.
    'superAddresses' => $superAddresses,
];

$rewards = new Rewards();
$rewards->debug = true; // no payments
$payees = $rewards->getPayees($nodes);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $nodeInfo['name'] ?> - Metahash Rewards UI</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/assets/css/normalize.css">
    <link rel="stylesheet" href="/assets/css/skeleton.css">
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column" style="margin-top: 25%">
            <h3>Node: <a href="https://metawat.ch/address/<?php echo $nodes['address'] ?>" target="_blank"><?php echo $nodeInfo['name'] ?></a></h3>
            <table class="u-full-width">
                <thead>
                <tr>
                    <th>Address</th>
                    <th>Delegated</th>
                    <th>System Reward</th>
                    <th>Due (bonus from node)</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($payees as $delegator) : ?>
                    <tr>
                        <td><a href="https://metawat.ch/address/<?php echo $delegator['address'] ?>"
                               target="_blank"><?php echo $delegator['address'] ?></a></td>
                        <td><?php echo $delegator['delegated'] / 1e6 ?></td>
                        <td><?php echo $delegator['reward'] / 1e6 ?></td>
                        <td><?php echo $delegator['due'] / 1e6 ?></td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
